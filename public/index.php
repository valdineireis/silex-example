<?php

require_once __DIR__.'/../bootstrap.php';

use Code\Sistema\Service\ClienteService;
use Code\Sistema\Entity\Cliente;
use Code\Sistema\Mapper\ClienteMapper;

$app['clienteService'] = function() {

    $clienteEntity = new Cliente();
    $clienteMapper = new ClienteMapper();

    $clienteService = new ClienteService($clienteEntity, $clienteMapper);
    return $clienteService;

};

$app->get("/", function() use ($app) {

    return $app['twig']->render('index.twig', []);

});

$app->get("/ola/{nome}", function($nome) use ($app) {

    return $app['twig']->render('ola.twig', ['nome'=>$nome]);

});

$app->get("/clientes", function() use ($app) {

    $dados = $app['clienteService']->fetchAll();

    return $app['twig']->render('clientes.twig', ['clientes'=>$dados]);

});

$app->get("/cliente", function() use ($app) {

    $data['nome'] = "Cliente";
    $data['email'] = "email@cliente.com";

    $result = $app['clienteService']->insert($data);

    return $app->json($result);
});

$app->run();