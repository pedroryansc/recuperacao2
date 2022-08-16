<?php
    require_once("../autoload.php");

    abstract class Exemplar extends Database{
        private $id;
        private $titulo;
        private $resumo;
        private $avaliacao;
        private $autores;
        public function __construct($id, $titulo, $resumo, $avaliacao, $autores){
            $this->setId($id);
            $this->setTitulo($titulo);
            $this->setResumo($resumo);
            $this->setAvaliacao($avaliacao);
            $this->setAutores($autores);
        }

        public function setId($id){
            $this->id = $id;
        }
        public function setTitulo($titulo){
            if($titulo <> "")
                $this->titulo = $titulo;
            else
                throw new Exception("Insira o título, por favor.");
        }
        public function setResumo($resumo){
            if($resumo <> "")
                $this->resumo = $resumo;
            else
                throw new Exception("Insira o resumo, por favor.");
        }
        public function setAvaliacao($avaliacao){
            if($avaliacao <> 0)
                $this->avaliacao = $avaliacao;
            else
                throw new Exception("Insira a avaliação, por favor.");
        }
        public function setAutores($autores){
            if($autores <> "")
                $this->autores = $autores;
            else
                throw new Exception("Insira o(s) autor(es), por favor.");
        }

        public function getId(){ return $this->id; }
        public function getTitulo(){ return $this->titulo; }
        public function getResumo(){ return $this->resumo; }
        public function getAvaliacao(){ return $this->avaliacao; }
        public function getAutores(){ return $this->autores; }

        public abstract function insere();
        public abstract static function listar($tipo = 0, $info = "");
        public abstract function editar();
        public abstract function excluir();
    }
?>