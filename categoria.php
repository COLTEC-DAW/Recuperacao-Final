<?php

class Categoria {
    private $id;
    private $nome;

    public function __construct($id,$nome) {
        $this->id = $id;
        $this->nome = $nome;
    }


    public function get_nome() {
        return $this->nome;
    }

    public function get_id(){
        return $this->id;
    }
}


?>