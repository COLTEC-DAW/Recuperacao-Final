<?php
    include "usuario.php";
    session_start();
    class UsuarioDAO {

        private $conexao;

        public function __construct($conexao) {
            $this->conexao = $conexao;
        }


        public function add($new_user) {
            $query = "INSERT INTO usuarios (nome, login, senha) VALUES ('"
                . $new_user->get_nome() 
                . "','" 
                . $new_user->get_login() 
                . "','" 
                . $new_user->get_senha() 
                . "')";
                mysqli_query($this->conexao, $query) or die(mysqli_error($this->conexao));

                setcookie("message", "Usuário criado com Sucesso");
            return header("Location: index.php");
        }

        public function get_all() {
            $users = [];
            
            $res = mysqli_query($this->conexao, "SELECT * FROM usuarios");
            $num_users = mysqli_num_rows($res);
            for ($i=0; $i < $num_users; $i++) { 
                $row = mysqli_fetch_array($res);
                $new_user = new Usuario(
                    $row['id'],
                    $row["nome"],
                    $row["login"],
                    $row["senha"]
                );

                // empilhar usuário na lista
                $users[] = $new_user;
            }
            return $users;
        }

        public function novoPensamento($new_pensamento) {
            $query = "INSERT INTO pensamentos (pensamento, created_at, categoria_id, usuario_id) VALUES ('"
                . $new_pensamento->get_pensamento() 
                . "','" 
                . $new_pensamento->get_data_criacao() 
                . "','" 
                . $new_pensamento->get_categoria_id() 
                . "','" 
                . $new_pensamento->get_usuario_id() 
                . "')";
                mysqli_query($this->conexao, $query) or die(mysqli_error($this->conexao));

                setcookie("message", "Pensamento criado com Sucesso");
            return header("Location: index.php");
        }
    }
?>