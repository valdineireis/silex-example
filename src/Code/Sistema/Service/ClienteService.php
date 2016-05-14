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
        $repository = $this->em->getRepository("Code\Sistema\Entity\Cliente");
        $result = $repository->getClientesOrdenados();

        return $result;
    }

    public function update($id, array $array)
    {
        $cliente = $this->em->getReference("Code\Sistema\Entity\Cliente", $id);

        $cliente->setNome($array['nome']);
        $cliente->setEmail($array['email']);

        $this->em->persist($cliente);
        $this->em->flush();

        return $cliente;
    }

    public function find($id)
    {
        $repository = $this->em->getRepository("Code\Sistema\Entity\Cliente");
        return $repository->find($id);
    }
    
    public function delete($id) 
    {
        $cliente = $this->em->getReference("Code\Sistema\Entity\Cliente", $id);
        $this->em->remove($cliente);
        return true;
    }
}