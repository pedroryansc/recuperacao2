<?php
    require_once("../autoload.php");

    class Livro extends Exemplar{
        private $ano_publicacao;
        public function __construct($id, $titulo, $resumo, $avaliacao, $autores, $ano_publicacao){
            parent::__construct($id, $titulo, $resumo, $avaliacao, $autores);
            $this->setAnoPublicacao($ano_publicacao);
        }

        public function setAnoPublicacao($ano_publicacao){
            if($ano_publicacao <> 0)
                $this->ano_publicacao = $ano_publicacao;
            else
                throw new Exception("Insira o ano de publicação, por favor.");
        }

        public function getAnoPublicacao(){ return $this->ano_publicacao; }

        public function insere(){
            $sql = "INSERT INTO livro (titulo, resumo, avaliacao, autores, ano_publicacao)
                    VALUES (:titulo, :resumo, :avaliacao, :autores, :ano_publicacao)";
            $par = array(":titulo"=>$this->getTitulo(), ":resumo"=>$this->getResumo(), ":avaliacao"=>$this->getAvaliacao(),
                        ":autores"=>$this->getAutores(), ":ano_publicacao"=>$this->getAnoPublicacao());
            return parent::executaComando($sql, $par);
        }

        public static function listar($tipo = 0, $info = ""){
            $sql = "SELECT * FROM livro";
            if($tipo > 0 && $info <> ""){
                switch($tipo){
                    case(1): $sql .= " WHERE idlivro = :info"; break;
                    case(2): $sql .= " WHERE titulo LIKE :info"; $info = "%".$info."%"; break;
                    case(3): $sql .= " WHERE resumo LIKE :info"; $info = "%".$info."%"; break;
                    case(4): $sql .= " WHERE avaliacao LIKE :info"; $info = "%".$info."%"; break;
                    case(5): $sql .= " WHERE autores LIKE :info"; $info = "%".$info."%"; break;
                    case(6): $sql .= " WHERE ano_publicacao LIKE :info"; $info = "%".$info."%"; break;
                }
                $par = array(":info"=>$info);
            } else
                $par = array();
            return parent::buscar($sql, $par);
        }

        public function editar(){
            $sql = "UPDATE livro
                    SET titulo = :titulo, resumo = :resumo, avaliacao = :avaliacao,
                        autores = :autores, ano_publicacao = :ano_publicacao
                    WHERE idlivro = :id";
            $par = array(":titulo"=>$this->getTitulo(), ":resumo"=>$this->getResumo(), ":avaliacao"=>$this->getAvaliacao(),
                        ":autores"=>$this->getAutores(), ":ano_publicacao"=>$this->getAnoPublicacao(), "id"=>$this->getId());
            return parent::executaComando($sql, $par);
        }

        public function excluir(){
            $sql = "DELETE FROM livro WHERE idlivro = :id";
            $par = array(":id"=>$this->getId());
            return parent::executaComando($sql, $par);
        }

        public function __toString(){
            return parent::__toString().
                        "<tr>
                            <td> Ano de publicação: </td> <td>".$this->getAnoPublicacao()."</td>
                        </tr>
                    </table>";
        }

        public function avaliar($id, $nota){
            $vetor = self::listar(1, $id);
            $novaAvaliacao = ($vetor[0]["avaliacao"] + $nota) / 2;
            $sql = "UPDATE livro SET avaliacao = :novaAvaliacao WHERE idlivro = :id";
            $par = array(":novaAvaliacao"=>$novaAvaliacao, ":id"=>$id);
            return parent::executaComando($sql, $par);
        }
    }
?>