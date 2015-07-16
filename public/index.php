<?php

require_once __DIR__ . "/../bootstrap.php";

use Symfony\Component\HttpFoundation\JsonResponse;

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