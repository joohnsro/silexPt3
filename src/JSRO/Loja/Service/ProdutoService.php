<?php

namespace JSRO\Loja\Service;

use JSRO\Loja\Entity\Produto;
use JSRO\Loja\Mapper\ProdutoMapper;

class ProdutoService
{

    private $produtoEntity;
    private $produtoMapper;

    public function __construct(Produto $produto, ProdutoMapper $produtoMapper)
    {
        $this->produtoEntity = $produto;
        $this->produtoMapper = $produtoMapper;
    }

    public function getProdutos($id)
    {
        return $this->produtoMapper->select($id);
    }

    public function carregarProduto(array $data, $id)
    {
        return $this->produtoMapper->carregarProduto($data, $id);
    }

    public function deleteProduto($id)
    {
        return $this->produtoMapper->deleteProduto($id);
    }

} 