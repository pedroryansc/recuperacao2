<?php
    require_once("../autoload.php");

    abstract class Exemplar extends Database{
        private $id;
        private $titulo;
        private $resumo;
        private $avaliacao;
        private $autores;
        public function __construct($id, $titulo, $resumo, $avaliacao, $autores){
            
        }
    }
?>