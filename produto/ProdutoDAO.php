<?php
    require_once __DIR__ . "/../modelo/ConnectionFactory.php";
    require_once __DIR__ . "/Produto.php";

    class ProdutoDAO{
        private $con;

        public function __construct(){
            $this->con = ConnectionFactory::getConnection();
        }

        public function listar(){
            try{
                $stmt = $this->con->query("SELECT p.*, c.nome AS categoriaNome
                FROM produtos p
                JOIN categorias c ON p.categoria_id = c.id");
                $linhas = $stmt->fetchAll(PDO::FETCH_ASSOC);

                $lista = array();

                foreach($linhas as $linha){
                    $p = new Produto();
                    $p->setCategoriaNome($linha["nome"]);
                    $p->setNome($linha["nome"]);
                    $p->setDescricao($linha["descricao"]);
                    $p->setPreco($linha["preco"]);
                    $p->setPrecoPromocional($linha["preco_promocional"]);
                    $p->setImagem($linha["imagem"]);
                    $p->setNovo($linha["novo"]);
                    $p->setAtivo($linha["ativo"]);
                    $p->setEstoque($linha["estoque"]);
                    $lista[] = $p;
                }
                return $lista;
            }catch(PDOException $ex){
                echo "Erro ao listar contatos: " . $ex->getMessage();
                return array();
            }
        }
    }
?>