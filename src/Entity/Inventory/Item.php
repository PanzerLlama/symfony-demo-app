<?php
/**
 * Created by PhpStorm.
 * User: Lech Buszczynski <lecho@phatcat.eu>
 * Date: 1/7/19
 * Time: 9:03 PM
 */

declare(strict_types=1);

namespace App\Entity\Inventory;

use App\Entity\Inventory\Fields\ContainerField;
use App\Entity\ItemIdInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Item
{
    use ContainerField;

    /**
     * @ORM\Id()
     * @ORM\Column(type="msgphp_attribute_value_id", length=191)
     */
    private $id;

    public function __construct(ItemIdInterface $id, Container $container)
    {
        $this->id           = $id;
        $this->container    = $container;
    }
}

/*
 *  *      @AssociationOverride(name="address",
 *          joinColumns=@JoinColumn(
 *              name="adminaddress_id", referencedColumnName="id"
 *          )
 *      )
 */
/*
* @ORM\AssociationOverride(name="device",
 *      joinColumns=@ORM\JoinColumn(
 *           name="device_id", referencedColumnName="id"
    *      )
 * )
 *
 */