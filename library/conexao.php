<?php 

require_once 'conexaoDAO.php';

class Conexao {
    
    private $host = "localhost";
    private $login = "root";
    private $senha = "";
    private $database = "daw";
    
    public function get_connection() {
        return mysqli_connect($this->host, $this->login, $this->senha, $this->database);
    }

    public function close_connection(){
        return  mysqli_close($this->get_connection());
    }
    
}

$conexao = new Conexao();
$conexaoDAO = new ConexaoDAO($conexao);

?>