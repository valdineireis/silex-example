<?php

namespace Code\Sistema\Entity;

use Doctrine\ORM\EntityRepository;

class ClienteRepositoty extends EntityRepository
{
    public function getClientesOrdenados()
    {
        return $this
            ->createQueryBuilder("c")
            ->orderBy("c.nome", "asc")
            ->getQuery()
            ->getResult();
    }
}