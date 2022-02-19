<?php
    include "categoria.php";
    session_start();
    class CategoriaDAO {

        private $conexao;

        public function __construct($conexao) {
            $this->conexao = $conexao;
        }

        public function get_all() {
            $categorias = [];
            
            $res = mysqli_query($this->conexao, "SELECT * FROM categorias");
            $num_categorias = mysqli_num_rows($res);
            for ($i=0; $i < $num_categorias; $i++) { 
                $row = mysqli_fetch_array($res);
                $new_categoria = new Categoria(
                    $row['id'],
                    $row["nome"]
                );

                // empilhar usuário na lista
                $categorias[] = $new_categoria;
            }
            return $categorias;
        }
    }
?>