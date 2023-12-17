<?php

namespace Alpha\Domain\Model;

class User
{
    protected int $id;
    private string $name;
    private string $email;
    private string $password;
    private int $active;
    
    public function __construct($id, $name, $email, $password, $active){
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->active = $active;
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function getName() : string
    {
        return $this->name;
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

    public static function loggedIn()
    {
        if (!isset($_SESSION['usuario'])) {
            header('Location: ../../../view/login.php');
            exit();
        } else {
            return $_SESSION['usuario'];
        }
    }

    
}