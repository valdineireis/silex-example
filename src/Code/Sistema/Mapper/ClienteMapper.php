<?php

namespace Code\Sistema\Mapper;

use Code\Sistema\Entity\Cliente;

class ClienteMapper
{
    public function insert(Cliente $cliente)
    {
        return [
            'nome' => 'Cliente X',
            'email' => 'email@clientex.com'
        ];
    }

    public function fetchAll()
    {
        $dados[0]['nome'] = "Cliente 01";
        $dados[0]['email'] = "email@cliente01.com";

        $dados[1]['nome'] = "Cliente 02";
        $dados[1]['email'] = "email@cliente02.com";

        return $dados;
    }
}