<?php
/**
 * Created by PhpStorm.
 * User: Lech Buszczynski <lecho@phatcat.eu>
 * Date: 1/19/19
 * Time: 5:03 PM
 */

declare(strict_types=1);

namespace App\Controller;

use App\Entity\ContainerId;
use App\Entity\Inventory\Container;
use App\Http\Responder;
use App\Http\RespondTemplate;
use MsgPhp\Domain\Factory\EntityAwareFactoryInterface;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ContainerController
{
    /**
     * @Route("/container", name="container")
     * @return Response
     */
    public function container(Responder $responder, EntityAwareFactoryInterface $factory): Response
    {

        \App\Doctrine\ContainerIdType::setClass(\App\Entity\ContainerId::class);
        \App\Doctrine\ContainerIdType::setDataType(\Doctrine\DBAL\Types\Type::INTEGER);
        \Doctrine\DBAL\Types\Type::addType(\App\Doctrine\ContainerIdType::NAME, \App\Doctrine\ContainerIdType::class);
        //$id = new ContainerId('1');


        echo 'id:'.$factory->nextIdentifier(\MsgPhp\Eav\Entity\AttributeValue::class).'<br>';
        echo 'id:'.$factory->nextIdentifier(Container::class).'<br>';
        exit;

        $container = $factory->create(Container::class, ['id' => new ContainerId(1)]);

        //echo get_class($container);

        dd($container);


        return $responder->respond(new RespondTemplate('container.html.twig'));
    }
}