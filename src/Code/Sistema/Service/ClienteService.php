<?php

namespace Code\Sistema\Service;

use Code\Sistema\Entity\Cliente as ClienteEntity;
use Doctrine\ORM\EntityManager;

class ClienteService
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function insert(array $data)
    {
        $clienteEntity = new ClienteEntity();
        $clienteEntity->setNome($data['nome']);
        $clienteEntity->setEmail($data['email']);

        $this->em->persist($clienteEntity);
        $this->em->flush();

        return $clienteEntity;
    }

    public function fetchAll()
    {

    }

    public function update($id, array $array)
    {

    }

    public function find($id)
    {

    }
    
    public function delete($id) 
    {
        
    }
}