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
use App\Repository\ContainerRepository;
use Doctrine\ORM\EntityManagerInterface;
use MsgPhp\Domain\Factory\EntityAwareFactoryInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ContainerController
{
    /**
     * @Route("/container", name="container")
     * @return Response
     */
    public function container(Responder $responder, EntityAwareFactoryInterface $factory, EntityManagerInterface $entityManager): Response
    {

        \App\Doctrine\ContainerIdType::setClass(\App\Entity\ContainerId::class);
        \App\Doctrine\ContainerIdType::setDataType(\Doctrine\DBAL\Types\Type::INTEGER);
        \Doctrine\DBAL\Types\Type::addType(\App\Doctrine\ContainerIdType::NAME, \App\Doctrine\ContainerIdType::class);

        $container = new Container( new ContainerId(), 'Heavy Treasure Chest');

        $repository = new ContainerRepository(Container::class, $entityManager);

        $repository->save($container);

        dd($container);

        return $responder->respond(new RespondTemplate('container.html.twig'));
    }
}