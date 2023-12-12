<?php

namespace Crud\Alpha\Model;

class Admin
{
    protected int $id;
    private string $nome;
    private string $email;
    private string $senha;
    private int $ativo;
    
    public function __construct($id, $nome, $email, $senha){
        $this->id = $id;
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
        $this->ativo = 1;
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function getNome() : string
    {
        return $this->nome;
    }

    public function getEmail() : string
    {
        return $this->email;
    }

    public function getSenha() : string
    {
        return $this->senha;
    }

    public function getAtivo() : int
    {
        return $this->ativo;
    }
}
