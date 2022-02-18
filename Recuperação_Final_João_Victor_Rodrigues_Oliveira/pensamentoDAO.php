<?php 
    include "pensamento.php";

    class PensamentoDAO {
        private $conexao;

        public function __construct($conexao) {
            $this->conexao = $conexao;
        }

        public function add($novo_pensamento) {
            $query = "INSERT INTO pensamentos VALUES (" .
                "{$novo_pensamento->get_id()}, " .
                "\"{$novo_pensamento->get_pensamento()}\"," .
                "\"{$novo_pensamento->get_criado_em()}\", " .
                "\"{$novo_pensamento->get_categoria()}\", " .
                "\"{$novo_pensamento->get_usuarios_id()}\" " .
            ")";

            return mysqli_query($this->conexao, $query);
        }

        public function get_all() {
            $pensamentos = [];
            
            $res = mysqli_query($this->conexao, "SELECT p.id id, p.pensamento pens, p.criado_em criado, c.nome categ, u.login l FROM pensamentos p
            JOIN usuarios u ON u.id = p.usuarios_id
            JOIN categorias c ON c.id = p.categorias_id");

            $num_pens = mysqli_num_rows($res);

            for ($i=0; $i < $num_pens; $i++){
                $coluna = mysqli_fetch_array($res);
                $pensamento = new Pensamento(
                    $coluna["id"],
                    $coluna["pens"],
                    $coluna["criado"],
                    $coluna["categ"],
                    $coluna["l"],
                );
                $pensamentos[] = $pensamento;
            }
            return $pensamentos;
        }

        public function get_all_from_user($loginAtual){
            $pensamentos = [];
            
            $res = mysqli_query($this->conexao, "SELECT p.id id, p.pensamento pens, p.criado_em criado, c.nome categ, u.login l FROM pensamentos p
            JOIN usuarios u ON u.id = p.usuarios_id
            JOIN categorias c ON c.id = p.categorias_id
            WHERE u.login = " . "\"{$loginAtual}\"");

            $num_pens = mysqli_num_rows($res);

            for ($i=0; $i < $num_pens; $i++){
                $coluna = mysqli_fetch_array($res);
                $pensamento = new Pensamento(
                    $coluna["id"],
                    $coluna["pens"],
                    $coluna["criado"],
                    $coluna["categ"],
                    $coluna["l"],
                );
                $pensamentos[] = $pensamento;
            }
            return $pensamentos;
        }
    }
?>