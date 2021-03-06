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

    public function getClientesDesc()
    {
        $dql = "SELECT c FROM Code\Sistema\Entity\Cliente c ORDER BY c.nome DESC";

        return $this
            ->getEntityManager()
            ->createQuery($dql)
            ->getResult()
        ;
    }
}