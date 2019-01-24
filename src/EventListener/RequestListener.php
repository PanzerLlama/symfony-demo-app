<?php
/**
 * Created by PhpStorm.
 * User: Lech Buszczynski <lecho@phatcat.eu>
 * Date: 1/22/19
 * Time: 5:18 PM
 */

namespace App\EventListener;

use Symfony\Component\Console\Event\ConsoleCommandEvent;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class RequestListener
{
    /**
     * @param GetResponseEvent $event
     * @throws \Doctrine\DBAL\DBALException
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        if (!$event->isMasterRequest()) {
            return;
        }
        $this->registerDoctrineTypes();
    }

    /**
     * @param ConsoleCommandEvent $event
     * @throws \Doctrine\DBAL\DBALException
     */
    public function onConsoleCommand(ConsoleCommandEvent $event)
    {
        $this->registerDoctrineTypes();
    }

    /**
     * @throws \Doctrine\DBAL\DBALException
     */
    private function registerDoctrineTypes(): void
    {
        \App\Doctrine\ContainerIdType::setClass(\App\Entity\Inventory\ContainerId::class);
        \App\Doctrine\ContainerIdType::setDataType(\Doctrine\DBAL\Types\Type::INTEGER);
        \Doctrine\DBAL\Types\Type::addType(\App\Doctrine\ContainerIdType::NAME, \App\Doctrine\ContainerIdType::class);
        \App\Doctrine\ItemIdType::setClass(\App\Entity\Inventory\ItemId::class);
        \App\Doctrine\ItemIdType::setDataType(\Doctrine\DBAL\Types\Type::INTEGER);
        \Doctrine\DBAL\Types\Type::addType(\App\Doctrine\ItemIdType::NAME, \App\Doctrine\ItemIdType::class);
    }
}