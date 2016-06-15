<?php

namespace Code\Sistema\Service;

use Code\Sistema\Entity\Interesse;
use Doctrine\ORM\EntityManager;

class InteresseService
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function insert(array $data)
    {
        $interesse = new Interesse();
        $interesse->setNome($data['nome']);

        $this->em->persist($interesse);
        $this->em->flush();

        return $interesse;
    }
}