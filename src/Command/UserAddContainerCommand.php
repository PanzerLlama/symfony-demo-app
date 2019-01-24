<?php
/**
 * Created by PhpStorm.
 * User: Lech Buszczynski <lecho@phatcat.eu>
 * Date: 1/23/19
 * Time: 5:15 PM
 */

declare(strict_types=1);

namespace App\Command;

use App\Entity\User\User;

class UserAddContainerCommand
{
    public $user;
    public $context;

    final public function __construct(User $user, array $context)
    {
        $this->user = $user;
        $this->context = $context;
    }
}