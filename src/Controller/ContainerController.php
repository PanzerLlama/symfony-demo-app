<?php
/**
 * Created by PhpStorm.
 * User: Lech Buszczynski <lecho@phatcat.eu>
 * Date: 1/19/19
 * Time: 5:03 PM
 */

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Inventory\ContainerId;
use App\Entity\Inventory\Container;
use App\Entity\Inventory\Item;
use App\Entity\User\User;
use App\Http\Responder;
use App\Http\RespondTemplate;
use App\Repository\ContainerRepository;
use Doctrine\ORM\EntityManagerInterface;
use MsgPhp\Domain\Factory\EntityAwareFactoryInterface;
use MsgPhp\User\Infra\Doctrine\Repository\UserRepository;
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


        $repository = $entityManager->getRepository(User::class);


        foreach ($repository->findAll() as $e) {
            //$entityManager->remove($container);
            echo $e->getContainers()->count();
        }

        exit;

        $repository = new ContainerRepository(Container::class, $entityManager);


        foreach ($repository->findAll() as $container) {
            //$entityManager->remove($container);
           var_dump($container->getUser());
        }

        exit;
        $entityManager->flush();

        $container = new Container(new ContainerId(), 'Heavy Treasure Chest');

        $container->addItem(new Item('373 golden coins'));
        $container->addItem(new Item('Golden chalice'));
        $container->addItem(new Item('21 golden rings'));
        $container->addItem(new Item('7 large rubys'));

        $repository->save($container);

        dd($container);

        return $responder->respond(new RespondTemplate('container.html.twig'));
    }
}