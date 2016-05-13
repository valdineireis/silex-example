<?php

namespace Code\Sistema\Mapper;

use Code\Sistema\Entity\Cliente;

class ClienteMapper
{
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
        return [
            'nome' => 'Cliente X',
            'email' => 'email@clientex.com'
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