<?php
    require_once("../autoload.php");

    class Revista extends Exemplar{
        private $volume;
        private $quant_avaliacoes;
        public function __construct($id, $titulo, $resumo, $avaliacao, $autores, $volume, $quant_avaliacoes){
            parent::__construct($id, $titulo, $resumo, $avaliacao, $autores);
            $this->setVolume($volume);
            $this->setQuantAvaliacoes($quant_avaliacoes);
        }

        public function setVolume($volume){
            if($volume <> 0)
                $this->volume = $volume;
            else
                throw new Exception("Insira o volume, por favor.");
        }
        public function setQuantAvaliacoes($quant_avaliacoes){
            if($quant_avaliacoes <> 0)
                $this->quant_avaliacoes = $quant_avaliacoes;
            else
                throw new Exception("Insira a quantidade de avaliações, por favor.");
        }
        
        public function getVolume(){ return $this->volume; }
        public function getQuantAvaliacoes(){ return $this->quant_avaliacoes; }

        public function insere(){
            $sql = "INSERT INTO revista (titulo, resumo, avaliacao, autores, volume, quant_avaliacoes)
                    VALUES (:titulo, :resumo, :avaliacao, :autores, :volume, :quant_avaliacoes)";
            $par = array(":titulo"=>$this->getTitulo(), ":resumo"=>$this->getResumo(), ":avaliacao"=>$this->getAvaliacao(),
                        ":autores"=>$this->getAutores(), ":volume"=>$this->getVolume(), ":quant_avaliacoes"=>$this->getQuantAvaliacoes());
            return parent::executaComando($sql, $par);
        }

        public static function listar($tipo = 0, $info = ""){
            $sql = "SELECT * FROM revista";
            if($tipo > 0 && $info <> ""){
                switch($tipo){
                    case(1): $sql .= " WHERE idrevista = :info"; break;
                    case(2): $sql .= " WHERE titulo = :info"; $info = "%".$info."%"; break;
                    case(3): $sql .= " WHERE resumo = :info"; $info = "%".$info."%"; break;
                    case(4): $sql .= " WHERE avaliacao = :info"; $info = "%".$info."%"; break;
                    case(5): $sql .= " WHERE autores = :info"; $info = "%".$info."%"; break;
                    case(6): $sql .= " WHERE volume = :info"; $info = "%".$info."%"; break;
                    case(7): $sql .= " WHERE quant_avaliacoes = :info"; $info = "%".$info."%"; break;
                }
                $par = array(":info"=>$info);
            } else
                $par = array();
            return parent::buscar($sql, $par);
        }

        public function editar(){
            $sql = "UPDATE revista
                    SET titulo = :titulo, resumo = :resumo, avaliacao = :avaliacao,
                        autores = :autores, volume = :volume, quant_avaliacoes = :quant_avaliacoes
                    WHERE idrevista = :id";
            $par = array(":titulo"=>$this->getTitulo(), ":resumo"=>$this->getResumo(), ":avaliacao"=>$this->getAvaliacao(), ":autores"=>$this->getAutores(),
                        ":volume"=>$this->getVolume(), ":quant_avaliacoes"=>$this->getQuantAvaliacoes(), ":id"=>$this->getId());
            return parent::executaComando($sql, $par);
        }

        public function excluir(){
            $sql = "DELETE FROM revista WHERE idrevista = :id";
            $par = array(":id"=>$this->getId());
            return parent::executaComando($sql, $par);
        }
    }
?>