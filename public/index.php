<?php

require_once __DIR__.'/../bootstrap.php';

use Code\Sistema\Service\ClienteService;
use Code\Sistema\Service\InteresseService;

use Symfony\Component\HttpFoundation\Request;

$app['clienteService'] = function() use ($em) {
    $clienteService = new ClienteService($em);
    return $clienteService;

};

$app['interesseService'] = function() use ($em) {
    $interesseService = new InteresseService($em);
    return $interesseService;

};

// GET  /api/clientes - Listar todos os clientes
// GET  /api/clientes/1 - Listar apenas um cliente passando o ID por parâmetro
// POST /api/clientes - Insere um novo cliente
// PUT  /api/clientes/1
// DELETE /api/clientes/1

$app->get("/api/clientes", function() use ($app) {

    $dados = $app['clienteService']->fetchAll();
    return $app->json($dados);

});

$app->get("/api/clientes/{id}", function($id) use ($app) {

    $dados = $app['clienteService']->find($id);
    return $app->json($dados);

});

$app->post("/api/clientes", function(Request $request) use ($app) {

    $dados['nome'] = $request->get('nome');
    $dados['email'] = $request->get('email');
    $dados['rg'] = $request->get('rg');
    $dados['cpf'] = $request->get('cpf');
    $dados['interesse'] = $request->get('interesse');

    $result = $app['clienteService']->insert($dados);

    $data['id'] = $result->getId();
    $data['nome'] = $result->getNome();
    $data['email'] = $result->getEmail();
    $data['rg'] = $result->getProfile()->getRg();
    $data['cpf'] = $result->getProfile()->getCpf();

    return $app->json($data);

});

$app->post("/api/interesses", function(Request $request) use ($app) {

    $dados['nome'] = $request->get('nome');

    $result = $app['interesseService']->insert($dados);

    $data['id'] = $result->getId();
    $data['nome'] = $result->getNome();

    return $app->json($data);

});

$app->put("/api/clientes/{id}", function($id, Request $request) use ($app) {

    $data['nome'] = $request->get('nome');
    $data['email'] = $request->get('email');

    $dados = $app['clienteService']->update($id, $data);
    return $app->json($dados);

});

$app->delete("/api/clientes/{id}", function($id) use ($app) {

    $dados = $app['clienteService']->delete($id);
    return $app->json($dados);

});


$app->get("/", function() use ($app) {

    return $app['twig']->render('index.twig', []);

})->bind("index");

$app->get("/ola/{nome}", function($nome) use ($app) {

    return $app['twig']->render('ola.twig', ['nome'=>$nome]);

});

$app->get("/clientes", function() use ($app) {

    $dados = $app['clienteService']->fetchAll();

    return $app['twig']->render('clientes.twig', ['clientes'=>$dados]);

})->bind("clientes");

$app->get("/cliente", function() use ($app) {

    $data['nome'] = "Cliente";
    $data['email'] = "email@cliente.com";

    $result = $app['clienteService']->insert($data);

    return $app->json($result);
});

$app->run();