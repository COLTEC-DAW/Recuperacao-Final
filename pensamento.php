<?php

class Pensamento {
    private $id;
    private $pensamento;
    private $created_at;
    private $categoria_id;
    private $usuario_id;

    public function __construct($id,$pensamento,$created_at, $categoria_id, $usuario_id) {
        $this->id = $id;
        $this->pensamento = $pensamento;
        $this->created_at = $created_at;
        $this->categoria_id = $categoria_id;
        $this->usuario_id = $usuario_id;
    }


    public function get_id() {
        return $this->id;
    }

    public function get_pensamento() {
        return $this->pensamento;
    }

    public function get_data_criacao() {
        return $this->created_at;
    }

    public function get_categoria_id() {
        return $this->categoria_id;
    }

    public function get_usuario_id() {
        return $this->usuario_id;
    }
    
}


?>