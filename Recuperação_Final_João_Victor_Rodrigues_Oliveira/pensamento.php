<?php

class Pensamento {
    private $id;
    private $pensamento;
    private $criado_em;
    private $categorias_id;
    private $usuarios_id;

    public function __construct($id, $pensamento, $criado_em, $categorias_id, $usuarios_id) {
        $this->id = $id;
        $this->pensamento = $pensamento;
        $this->criado_em = $criado_em;
        $this->categorias_id = $categorias_id;
        $this->usuarios_id = $usuarios_id;
    }

    public function get_id() {
        return $this->id;
    }

    public function get_pensamento() {
        return $this->pensamento;
    }

    public function get_criado_em() {
        return $this->criado_em;
    }
    
    public function get_categoria() {
        return $this->categorias_id;
    }

    public function get_usuarios_id() {
        return $this->usuarios_id;
    }
}
?>