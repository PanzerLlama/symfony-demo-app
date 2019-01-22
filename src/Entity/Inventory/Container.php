<?php
/**
 * Created by PhpStorm.
 * User: Lech Buszczynski <lecho@phatcat.eu>
 * Date: 1/7/19
 * Time: 8:46 PM
 */

declare(strict_types=1);

namespace App\Entity\Inventory;

use App\Entity\ContainerIdInterface;
use App\Entity\Inventory\Fields\ItemField;
use MsgPhp\Domain\Entity\Features\CanBeEnabled;
use MsgPhp\Domain\Entity\Fields\CreatedAtField;
use MsgPhp\Domain\Event\DomainEventHandlerInterface;
use MsgPhp\Domain\Event\DomainEventHandlerTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Container implements DomainEventHandlerInterface
{
    use CreatedAtField;
    use CanBeEnabled;
    //use ItemField;
    use DomainEventHandlerTrait;

    /**
     * @var ContainerIdInterface|null
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="container_id", length=191)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $name;

    public function __construct(ContainerIdInterface $id, $name)
    {
        $this->id = $id;
        $this->name= $name;
        $this->createdAt = new \DateTimeImmutable();
    }

    /**
     * @return ContainerIdInterface
     */
    public function getId(): ContainerIdInterface
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Container
     */
    public function setName(string $name): Container
    {
        $this->name = $name;
        return $this;
    }
}