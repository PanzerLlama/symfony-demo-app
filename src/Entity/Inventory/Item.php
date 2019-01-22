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
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Item
{
    use ContainerField;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="item_id", length=191)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $description;

    public function __construct(string $description)
    {
        $this->id           = new ItemId();
        $this->description  = $description;
    }
}