<?php 
require_once 'pensamento.php';

class ConexaoDAO {
    private $conexao;

    public function __construct($conexao) {
        $this->conexao = $conexao;
    }

    public function usuarioExisteBDD($conexao, $usuario){
        // Pesquisa o usuário no BDD
        $query = "SELECT usuario FROM usuarios WHERE usuario = \"" . $usuario . "\" ";
        $result = mysqli_query($conexao->get_connection(), $query);

        // Quantidade de resultados da busca no BDD
        // Nesse caso, se tiver 1 resultado, quer dizer que o usuário já existe no BDD
        $numRows = mysqli_num_rows($result); 

        if ($numRows >= 1) { return true; }
        else { return false; }
    }

    public function insereRegistroUsuario($conexao, $nome, $usuario, $senha){
        // Insere as informações do formulário no BDD
        $query = "INSERT INTO usuarios (nome, usuario, senha) VALUES (\"" . $nome . "\",\"" . $usuario . "\",\"" . $senha .  "\")";
        $result = mysqli_query($conexao->get_connection(), $query);
    }

    public function insereRegistroPensamento($conexao, $pensamento, $categoria, $usuario){
        // Insere as informações do formulário no BDD
        $query = "INSERT INTO pensamentos (pensamento, criado_em, categorias_id,usuarios_id) VALUES (\"" . $pensamento . "\",NOW(),\"" . $categoria . "\",(SELECT id FROM usuarios WHERE usuario=\"" . $usuario . "\"))";
        $result = mysqli_query($conexao->get_connection(), $query);
    }

    public function usuarioSenhaExistemBDD($conexao, $usuario, $senha){
        // Pesquisa o usuário e senha no BDD
        $query = "SELECT nome FROM usuarios WHERE usuario = \"" . $usuario . "\" AND senha = \"" . $senha . "\" ";
        $result = mysqli_query($conexao->get_connection(), $query);

        // Quantidade de resultados da busca no BDD
        // Nesse caso, se tiver 1 resultado, quer dizer que o usuário e a senha existem no BDD
        $numRows = mysqli_num_rows($result); 
        if ($numRows >= 1) { return true; }
        else { return false; }
    }

    public function getUsuario ($conexao, $usuario, $senha) {
        
        // Pesquisa o usuário e senha no BDD
        $query = "SELECT nome, usuario, senha FROM usuarios WHERE usuario = \"" . $usuario . "\" AND senha = \"" . $senha . "\" ";
        $result = mysqli_query($conexao->get_connection(), $query);

        $row = mysqli_fetch_array($result);
        return $row; 
    }

    public function getPensamentos ($conexao, $usuario) {
        // Lista de pensamentos que serão retornados
        $pensamentos = [];

        // Pesquisa os pensamentos filtrando pelo nome do usuário
        $query = 
        "SELECT pensamento, criado_em, c.tipo ,u.nome FROM pensamentos
        INNER JOIN categorias c ON c.id = categorias_id
        JOIN usuarios u ON u.id = usuarios_id
        WHERE u.usuario = \"" . $usuario .  "\";
        ";  

        $result = mysqli_query($conexao->get_connection(), $query);
        $numPensamentos = mysqli_num_rows($result);

        for ($i = 0; $i < $numPensamentos; ++$i){
            $row = mysqli_fetch_array($result);
            //var_dump($row);
            $novo_pensamento = new Pensamentos(
                $row['pensamento'],
                $row['criado_em'],
                $row['tipo'],
                $row['nome']
            );
            $pensamentos[] = $novo_pensamento;
        }
        return $pensamentos;
    }
}

?>