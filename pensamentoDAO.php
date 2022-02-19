<?php
    include "pensamento.php";
    class PensamentoDAO {

        private $conexao;

        public function __construct($conexao) {
            $this->conexao = $conexao;
        }

        public function get_all() {
            $pensamentos = [];
            
            $res = mysqli_query($this->conexao, "SELECT * FROM pensamentos");
            $num_pensamentos = mysqli_num_rows($res);
            for ($i=0; $i < $num_pensamentos; $i++) { 
                $row = mysqli_fetch_array($res);
                $new_pensamentos = new Pensamento(
                    $row['id'],
                    $row['pensamento'],
                    $row['created_at'],
                    $row['categoria_id'],
                    $row['usuario_id']
                );

                // empilhar usuário na lista
                $pensamentos[] = $new_pensamentos;
            }
            return $pensamentos;
        }

        public function get_categoria_nome($pensamento_id){
            $res = mysqli_query($this->conexao,"SELECT nome
                                                FROM categorias 
                                                JOIN pensamentos ON categorias.id = pensamentos.categoria_id
                                                WHERE pensamentos.id = $pensamento_id
            ");
            $nome = mysqli_fetch_assoc($res);
            return $nome;
        }

        public function get_pensamentos($usuario_id){
            $pensamentos = [];
            
            $res = mysqli_query($this->conexao, "SELECT * FROM pensamentos WHERE usuario_id = $usuario_id");
            $num_pensamentos = mysqli_num_rows($res);
            for ($i=0; $i < $num_pensamentos; $i++) { 
                $row = mysqli_fetch_array($res);
                $new_pensamentos = new Pensamento(
                    $row['id'],
                    $row['pensamento'],
                    $row['created_at'],
                    $row['categoria_id'],
                    $row['usuario_id']
                );

                // empilhar usuário na lista
                $pensamentos[] = $new_pensamentos;
            }
            return $pensamentos;
        }   
    }
?>