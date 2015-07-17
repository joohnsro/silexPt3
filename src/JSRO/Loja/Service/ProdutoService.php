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

    public function showTable()
    {
        $produtos = $this->produtoMapper->select();

        $html = "<table>";
        $html .= "<thead><th>ID</th><th>NOME</th><th>DESCRIÇÃO</th><th>VALOR</th></thead>";
        $html .= "<tbody>";
        foreach ($produtos as $produto) {
            $html .= "<tr><td>{$produto['id']}</td><td>{$produto['nome']}</td><td>{$produto['descricao']}</td><td>{$produto['valor']}</td></tr>";
        }
        $html .= "</tbody>";
        $html .= "</table>";

        return $html;
    }

} 