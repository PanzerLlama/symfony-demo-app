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

trait ItemField
{
    /**
     * @var iterable|Item[]
     */
    private $items = [];

    /**
     * @return DomainCollectionInterface|Item[]
     */
    public function getItems(): DomainCollectionInterface
    {
        return $this->items instanceof DomainCollectionInterface ? $this->items : DomainCollectionFactory::create($this->items);
    }
}