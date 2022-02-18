<?php
    include "usuario.php";

    class UsuarioDAO {
        private $conexao;

        public function __construct($conexao) {
            $this->conexao = $conexao;
        }

        public function add($novo_usuario) {
            $consulta = "INSERT INTO usuarios VALUES (" .
                "{$novo_usuario->get_id()}, " .
                "\"{$novo_usuario->get_nome()}\"," .
                "\"{$novo_usuario->get_login()}\", " .
                "\"{$novo_usuario->get_senha()}\"" .
            ")";

            return mysqli_query($this->conexao, $consulta);
        }

        public function login($login, $senha){
            $res = mysqli_query($this->conexao, "SELECT * FROM usuarios WHERE login = " . "\"{$login}\" AND senha = " . "\"{$senha}\"");
            $row = mysqli_fetch_array($res);
            
            if (!$row) return null;
            else{
                $user = new Usuario(
                    $row["id"],
                    $row["nome"],
                    $row["login"],
                    $row["senha"]
                );
                return $user;
            }
        }

        public function get_all() {
            $usuarios = [];
            
            $res = mysqli_query($this->conexao, "SELECT * FROM usuarios");
            $num_usuarios = mysqli_num_rows($res);
            for ($i=0; $i < $num_usuarios; $i++) { 
                $row = mysqli_fetch_array($res);
                $novo_usuario = new Usuario(
                    $row["id"],
                    $row["nome"],
                    $row["login"],
                    $row["senha"]
                );

                $usuarios[] = $novo_usuario;
            }
            return $usuarios;
        }
    }
?>