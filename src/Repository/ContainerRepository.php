<?php
/**
 * Created by PhpStorm.
 * User: Lech Buszczynski <lecho@phatcat.eu>
 * Date: 1/22/19
 * Time: 12:09 PM
 */

namespace App\Repository;

use MsgPhp\Domain\Infra\Doctrine\DomainEntityRepositoryTrait;

class ContainerRepository
{
    use DomainEntityRepositoryTrait {
        doFind as public find;
        doExists as public exists;
        doSave as public save;
    }

    public function findAll()
    {
        $qb = $this->createQueryBuilder('c');

        return $qb->getQuery()->getResult();
    }
}