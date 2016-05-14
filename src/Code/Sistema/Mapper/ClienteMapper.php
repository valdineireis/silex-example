<?php

namespace Code\Sistema\Mapper;

use Code\Sistema\Entity\Cliente;
use Doctrine\ORM\EntityManager;

class ClienteMapper
{

    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    private $dados = [
        0 => [
            'id' => 0,
            'nome' => 'Cliente xpto',
            'email' => 'email@cliente_xpto.com'
        ],
        1 => [
            'id' => 1,
            'nome' => 'Cliente 01',
            'email' => 'email@cliente01.com'
        ]
    ];

    public function insert(Cliente $cliente)
    {
        $this->em->persist($cliente);
        $this->em->flush();

        return [
            'success' => true,
            'id' => $cliente->getId(),
            'nome' => $cliente->getNome(),
            'email' => $cliente->getEmail()
        ];
    }

    public function update($id, array $array)
    {
        return [
            'success' => true
        ];
    }

    public function find($id)
    {
        return $this->dados[$id];
    }

    public function fetchAll()
    {
        return $this->dados;
    }
}