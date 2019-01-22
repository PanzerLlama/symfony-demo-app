<?php
/**
 * Created by PhpStorm.
 * User: Lech Buszczynski <lecho@phatcat.eu>
 * Date: 1/7/19
 * Time: 9:04 PM
 */

declare(strict_types=1);

namespace App\Entity\Inventory\Fields;

use App\Entity\Inventory\ContainerIdInterface;
use App\Entity\Inventory\Container;
use Doctrine\ORM\Mapping as ORM;

trait ContainerField
{
    /**
     * @var Container
     * @ORM\ManyToOne(targetEntity="App\Entity\Inventory\Container", inversedBy="items")
     */
    private $container;

    /**
     * @return Container
     */
    public function getContainer(): Container
    {
        return $this->container;
    }

    /**
     * @param Container $container
     * @return ContainerField
     */
    public function setContainer(Container $container): self
    {
        $this->container = $container;
        return $this;
    }

    public function getContainerId(): ContainerIdInterface
    {
        return $this->container->getId();
    }
}