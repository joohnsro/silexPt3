<?php

namespace JSRO\Loja\Mapper;

use JSRO\Loja\Entity\Produto;
use Psr\Log\InvalidArgumentException;

class ProdutoMapper
{

    private $connection;

    public function __construct(\PDO $pdo)
    {
        $this->connection = $pdo;
    }

    public function insert(array $produto)
    {
        $stmt = $this->connection->prepare("Insert into produtos (nome, valor, descricao) VALUES(:nome, :valor, :descricao)");
        $stmt->bindValue("nome", $produto["nome"]);
        $stmt->bindValue("valor", $produto["valor"]);
        $stmt->bindValue("descricao", $produto["descricao"]);

        if ( !$stmt->execute() ){
            throw new InvalidArgumentException("O produto não foi inserido.");
        }

        return $produto;
    }

    public function select()
    {
        $produtos = $this->connection->query("Select * from produtos");
        return $produtos;
    }

    public function update(array $produto)
    {
        $stmt = $this->connection->prepare("Update produtos set nome=:nome, valor=:valor, descricao=:descricao where id=:id");
        $stmt->bindValue("id", $produto["id"]);
        $stmt->bindValue("nome", $produto["nome"]);
        $stmt->bindValue("valor", $produto["valor"]);
        $stmt->bindValue("descricao", $produto["descricao"]);

        if ( !$stmt->execute() ){
            throw new InvalidArgumentException("O produto não foi atualizado.");
        }

        return $produto;
    }

    public function fixture()
    {
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
            $this->insert($produto);
        }
    }

} 