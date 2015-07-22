<?php

require_once __DIR__ . "/../bootstrap.php";

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use JSRO\Loja\Entity\Produto;
use JSRO\Loja\Mapper\ProdutoMapper;
use JSRO\Loja\Service\ProdutoService;
use JSRO\Database\Connection;

$app['produtoService'] = function (){
    $connection = new Connection();
    $produtoEntity = new Produto();
    $produtoMapper = new ProdutoMapper($connection->getPdo());
    $produtoService = new ProdutoService($produtoEntity, $produtoMapper);
    return $produtoService;
};

$app->get('/produtos', function() use ($app) {
    return $app['twig']->render('produtos.twig', ['produtos'=>$app['produtoService']->getProdutos()]);
})->bind('produtos');

$app->post('/produtos/add', function(Request $request) use ($app) {
    $data = $request->request->all();
    $produto = $app['produtoService']->carregarProduto($data);
    return $app->redirect($app['url_generator']->generate('produto', ['id' => $produto]));
});

$app->get('/produtos/add', function() use ($app) {
    return $app['twig']->render('produto.twig', [
        'produto'=>[
            'id' => '',
            'nome' => '',
            'descricao' => '',
            'valor' => ''
        ]
    ]);
})->bind('adicionar');

$app->post('/produtos/{id}', function($id, Request $request) use ($app) {
    $data = $request->request->all();
    $produto = $app['produtoService']->carregarProduto($data, $id);
    return $app->redirect($app['url_generator']->generate('produto', ['id' => $produto]));
});

$app->get('/produtos/{id}', function($id) use ($app) {
    $produto = $app['produtoService']->getProdutos($id);
    return $app['twig']->render('produto.twig', ['produto'=>$produto]);
})->bind('produto');

$app->get('/produtos/{id}/delete', function($id) use ($app) {
    $app['produtoService']->deleteProduto($id);
    return $app->redirect($app['url_generator']->generate('produtos'));
})->bind('delete');

$app->get("/clientes", function () {

    $clientes = array(
        1 => array(
            "nome"  => "Jonathan",
            "email" => "jonathan@jonathan.com",
            "cpf"   => "123.456.789.01"
        ),
        2 => array(
            "nome"  => "Carlos",
            "email" => "carlos@carlos.com",
            "cpf"   => "234.567.890-12"
        ),
        3 => array(
            "nome"  => "Industria XPTO Ltda.",
            "email" => "industria@insdustria.com",
            "cnpj"   => "12.345.678/0001-23"
        ),
        4 => array(
            "nome"  => "Comércio XYZ",
            "email" => "comercio@comercio.com",
            "cnpj"   => "34.567.890/0001.45"
        ),
    );

    return new JsonResponse($clientes);

});

$app->run();