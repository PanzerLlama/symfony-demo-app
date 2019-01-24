<?php
/**
 * Created by PhpStorm.
 * User: Lech Buszczynski <lecho@phatcat.eu>
 * Date: 1/23/19
 * Time: 5:48 PM
 */

namespace App\Command\Handler;

use App\Command\UserAddContainerCommand;
use App\Entity\Inventory\Container;
use App\Entity\Inventory\ContainerId;
use App\Entity\User\User;
use App\Event\UserContainerAddedEvent;
use MsgPhp\Domain\Command\EventSourcingCommandHandlerTrait;
use MsgPhp\Domain\Event\DomainEventHandlerInterface;
use MsgPhp\Domain\Event\DomainEventInterface;
use MsgPhp\Domain\Factory\EntityAwareFactoryInterface;
use MsgPhp\User\Repository\UserRepositoryInterface;

class UserAddContainerHandler
{
    use EventSourcingCommandHandlerTrait;

    /**
     * @var EntityAwareFactoryInterface
     */
    private $factory;

    /** @var UserRepositoryInterface */
    private $repository;

    public function __construct(EntityAwareFactoryInterface $factory, UserRepositoryInterface $repository)
    {
        $this->factory = $factory;
        $this->repository = $repository;
    }

    public function __invoke(UserAddContainerCommand $command): void
    {
        $this->handle($command, function (User $user): void {
            $this->repository->save($user);
        });
    }

    protected function getDomainEvent(UserAddContainerCommand $command): DomainEventInterface
    {
        return new UserContainerAddedEvent(new Container(new ContainerId(), $command->user, $command->context['name']));
    }

    protected function getDomainEventHandler(UserAddContainerCommand $command): DomainEventHandlerInterface
    {
        return $command->user;
    }
}