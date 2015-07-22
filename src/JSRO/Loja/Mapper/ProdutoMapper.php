<?php

namespace JSRO\Loja\Mapper;

use InvalidArgumentException;

class ProdutoMapper
{

    private $connection;

    public function __construct(\PDO $pdo)
    {
        $this->connection = $pdo;
    }

    public function carregarProduto(array $produto, $id = null)
    {
        if($id) {
            $stmt = $this->connection->prepare("Update produtos set nome=:nome, valor=:valor, descricao=:descricao where id={$id}");
        } else {
            $stmt = $this->connection->prepare("Insert into produtos (nome, valor, descricao) VALUES(:nome, :valor, :descricao)");
        }
        $stmt->bindParam("nome", $produto["nome"]);
        $stmt->bindParam("valor", $produto["valor"]);
        $stmt->bindParam("descricao", $produto["descricao"]);

        if ( !$stmt->execute() ){
            throw new InvalidArgumentException("O produto não foi carregado com sucesso.");
        }

        if($id) {
            $res = $id;
        } else {
            $res = $this->connection->lastInsertId();
        }
        return $res;
    }

    public function select($id = null)
    {
        if (!$id) {
            $produtos = $this->connection->query("Select * from produtos");
            return $produtos;
        }

        $stmt = $this->connection->prepare("Select * from produtos where id=:id");
        $stmt->bindParam("id", $id);

        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function deleteProduto($id)
    {
        $stmt = $this->connection->prepare("Delete from produtos where id={$id}");
        $stmt->bindParam("id", $id);
        $stmt->execute();

        return true;
    }

}