<?php

require_once __DIR__.'/../bootstrap.php';

use Symfony\Component\HttpFoundation\Response;

use Code\Sistema\Service\ClienteService;
use Code\Sistema\Entity\Cliente;
use Code\Sistema\Mapper\ClienteMapper;

$response = new Response();

$app['clienteService'] = function() {

    $clienteEntity = new Cliente();
    $clienteMapper = new ClienteMapper();

    $clienteService = new ClienteService($clienteEntity, $clienteMapper);
    return $clienteService;

};

$app->get("/", function() use ($response) {

    $response->setContent("Ola mundo!");
    return $response;

});

$app->get("/ola/{nome}", function($nome) {

    return "Ola {$nome}";

});

$app->get("/cliente", function() use ($app) {

    $data['nome'] = "Cliente";
    $data['email'] = "email@cliente.com";

    $result = $app['clienteService']->insert($data);

    return $app->json($result);
});

$app->run();