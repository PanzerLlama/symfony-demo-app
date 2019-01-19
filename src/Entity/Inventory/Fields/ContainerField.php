<?php
/**
 * Created by PhpStorm.
 * User: Lech Buszczynski <lecho@phatcat.eu>
 * Date: 1/7/19
 * Time: 9:04 PM
 */

declare(strict_types=1);

namespace App\Entity\Inventory\Fields;

use App\Entity\ContainerIdInterface;
use App\Entity\Inventory\Container;


trait ContainerField
{
    /**
     * @var Container
     */
    private $container;

    /**
     * @return Container
     */
    public function getContainer(): Container
    {
        return $this->container;
    }

    public function getContainerId(): ContainerIdInterface
    {
        return $this->container->getId();
    }
}