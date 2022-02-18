<?php

    class User{
        private int $id;
        private string $nome;
        private string $login;

        function __construct($id, $nome, $login){
            $this->id = $id;
            $this->nome = $nome;
            $this->login = $login;
        }

        function getId(){return $this->id;}
        function getName(){return $this->nome;}
        function getLogin(){return $this->login;}
    }

    class Pensamento{
        private string $content;
        private string $creation_date;
        private string $category;

        function __construct($content, $creation_date, $category){
            $this->content = $content;
            $this->creation_date = $creation_date;
            $this->category = $category;
        }

        public function echoPensamento(){
            echo "<p>$this->category | $this->creation_date<br>
            $this->content</p>";
        }
    }
?>