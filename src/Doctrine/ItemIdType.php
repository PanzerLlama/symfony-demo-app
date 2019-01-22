<?php
/**
 * Created by PhpStorm.
 * User: Lech Buszczynski <lecho@phatcat.eu>
 * Date: 1/19/19
 * Time: 5:43 PM
 */

namespace App\Doctrine;

use MsgPhp\Domain\Infra\Doctrine\DomainIdType;

class ItemIdType extends DomainIdType
{
    public const NAME = 'item_id';
}