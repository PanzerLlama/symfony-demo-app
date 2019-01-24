<?php
/**
 * Created by PhpStorm.
 * User: Lech Buszczynski <lecho@phatcat.eu>
 * Date: 1/24/19
 * Time: 10:17 AM
 */

namespace App\Event;

use App\Entity\Inventory\Container;
use MsgPhp\Domain\Event\DomainEventInterface;

class UserContainerAddedEvent implements DomainEventInterface
{
    /** @var Container */
    public $container;

    final public function __construct(Container $container)
    {
        $this->container = $container;
    }
}