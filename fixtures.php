<?php

require_once "bootstrap.php";


use JSRO\Database\Connection;
use JSRO\Loja\Mapper\ProdutoMapper;

$connection = new Connection();
$produtoMapper = new ProdutoMapper($connection->getPdo());

$connection->getPdo()
    ->query("Create table if not exists produtos (
        id INT(11) auto_increment primary key,
        nome varchar(255) not null,
        descricao varchar(255) not null,
        valor varchar(20) not null
    );");

$produtos = [
    array(
        'nome' => 'Tênis',
        'descricao' => 'Tênis para prática de esportes.',
        'valor' => '199,90'
    ),
    array(
        'nome' => 'Sapatênis',
        'descricao' => 'Tênis para uso no trabalho.',
        'valor' => '109,90'
    ),
];

foreach ($produtos as $produto) {
    $produtoMapper->insert($produto);
}
