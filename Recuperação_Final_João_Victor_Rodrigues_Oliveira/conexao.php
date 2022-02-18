<?php 
class Conexao {

    private $host = "localhost";
    private $login = "root";
    private $senha = "";
    private $database = "meuqueridodiario";


    public function get_connection() {
        return mysqli_connect($this->host, $this->login, $this->senha, $this->database);
    }
}
?>