<?php

class Usuario {
    private $id;
    private $nome;
    private $login;
    private $senha;

    public function __construct($id, $nome, $login, $senha) {
        $this->id = $id;
        $this->nome = $nome;
        $this->login = $login;
        $this->senha = $senha;
    }

    public function get_id() {
        return $this->id;
    }

    public function get_nome() {
        return $this->nome;
    }

    public function get_login()
    {
        return $this->login;
    }

    public function get_senha()
    {
        return $this->senha;
    }
}


?>