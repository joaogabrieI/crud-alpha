<?php

namespace Crud\Alpha\Model;

class Produto {
    private int $id;
    private string $nome;
    private string $descricao;
    private float $preco;
    private int $desconto;
    private Categoria $categoria;
    private int $quantidade;
    private int $ativo;
    private Imagem $imagem;

    public function __construct(int $id, string $nome, string $descricao, float $preco, int $desconto, Categoria $categoria, int $quantidade, Imagem $imagem)
    {
        $this->$id = $id;
        $this->$nome = $nome;
        $this->$descricao = $descricao;
        $this->$preco = $preco;
        $this->$desconto = $desconto;
        $this->$categoria = $categoria;
        $this->quantidade = $quantidade;
        $this->imagem = $imagem;
        $this->ativo = 1;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getDescricao(): string
    {
        return $this->descricao;
    }

    public function getPreco(): float
    {
        return $this->preco;
    }

    public function getDesconto(): int
    {
        return $this->desconto;
    }

    public function getCategoria(): Categoria
    {
        return $this->categoria;
    }

    public function getQuantidade(): int
    {
        return $this->quantidade;
    }

    public function getAtivo(): int
    {
        return $this->ativo;
    }
}