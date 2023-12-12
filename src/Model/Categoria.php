<?php

namespace Crud\Alpha\Model;

class Categoria
{
    protected int $id;
    private string $nome;
    private string $descricao;
    private int $ativo;

    public function __construct(int $id, string $nome, string $descricao)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->descricao = $descricao;
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

    public function getAtivo(): int
    {
        return $this->ativo;
    }
}
