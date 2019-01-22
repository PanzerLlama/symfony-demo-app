<?php
/**
 * Created by PhpStorm.
 * User: Lech Buszczynski <lecho@phatcat.eu>
 * Date: 1/7/19
 * Time: 9:00 PM
 */

namespace App\Entity\Inventory\Fields;


use App\Entity\Inventory\Item;
use MsgPhp\Domain\DomainCollectionInterface;
use MsgPhp\Domain\Factory\DomainCollectionFactory;
use Doctrine\ORM\Mapping as ORM;

trait ItemsField
{
    /**
     * @var iterable|Item[]
     * @ORM\OneToMany(targetEntity="App\Entity\Inventory\Item", mappedBy="container", cascade={"persist", "remove"})
     */
    private $items = [];

    /**
     * @return DomainCollectionInterface|Item[]
     */
    public function getItems(): DomainCollectionInterface
    {
        return $this->items instanceof DomainCollectionInterface ? $this->items : DomainCollectionFactory::create($this->items);
    }

    /**
     * @param Item $item
     * @return ItemsField
     */
    public function addItem(Item $item): self
    {
        if ($this->getItems()->contains($item) === false) {
            $item->setContainer($this);
            $this->items[] = $item;
        }
        return $this;
    }
}