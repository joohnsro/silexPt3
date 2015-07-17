<?php

namespace JSRO\Loja\Mapper;

class ProdutoMapper
{

    public function select()
    {
        return [
            array(
                'id' => 1,
                'nome' => 'Tênis',
                'descricao' => 'Tênis para prática de esportes.',
                'valor' => '199,90'
            ),
            array(
                'id' => 2,
                'nome' => 'Sapatênis',
                'descricao' => 'Tênis para uso no trabalho.',
                'valor' => '109,90'
            ),
        ];
    }

} 