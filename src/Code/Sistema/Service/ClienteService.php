<?php

namespace Code\Sistema\Service;

use Code\Sistema\Entity\Cliente as ClienteEntity;
use Code\Sistema\Entity\ClienteProfile as ClienteProfile;
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

        if (isset($data['rg']) and isset($data['cpf'])) {
            $clienteProfile = new ClienteProfile();
            $clienteProfile->setCpf($data['cpf']);
            $clienteProfile->setRg($data['rg']);
            $this->em->persist($clienteProfile);

            // faz o relacionamento
            $clienteEntity->setProfile($clienteProfile);
        }

        if (count($data['interesse'])) {
            $interesses = explode(",", $data['interesse']);

            foreach ($interesses as $rowInteresse) {
                $interesseEntity = $this->em->getReference("Code\Sistema\Entity\Interesse", $rowInteresse);
                $clienteEntity->addInteresse($interesseEntity);
            }
        }

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

        $ex = $repository->findBy(array('nome'=>'Valdinei', 'email'=>'teste@mail.com'));
        //$ex = $repository->findByNome('Valdinei');

        return $repository->find($id);
    }
    
    public function delete($id) 
    {
        $cliente = $this->em->getReference("Code\Sistema\Entity\Cliente", $id);
        $this->em->remove($cliente);
        return true;
    }
}