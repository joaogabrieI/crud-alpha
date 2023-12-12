<?php

namespace Crud\Alpha\Model;

class Admin
{
    protected int $id;
    private string $nome;
    private string $email;
    private string $password;
    private int $active;
    
    public function __construct($id, $nome, $email, $password){
        $this->id = $id;
        $this->nome = $nome;
        $this->email = $email;
        $this->password = $password;
        $this->active = 1;
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function getName() : string
    {
        return $this->nome;
    }

    public function getEmail() : string
    {
        return $this->email;
    }

    public function getPassword() : string
    {
        return $this->password;
    }

    public function getActive() : int
    {
        return $this->active;
    }
}
