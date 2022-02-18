<?php

class Pensamentos {
    private $pensamento;
    private $criado_em;
    private $categoria;
    private $usuario;
    
    public function __construct ($pensamento,$criado_em,$categoria,$usuario) {
        $this->pensamento = $pensamento;
        $this->criado_em = $criado_em;
        $this->categoria = $categoria;
        $this->usuario = $usuario;
    }
    
    public function get_pensamento() {
        return $this->pensamento;
    }
    public function get_criado_em() {
        return $this->criado_em;
    }
    public function get_categoria() {
        return $this->categoria;
    }
    public function get_usuario() {
        return $this->usuario;
    }

}
?>