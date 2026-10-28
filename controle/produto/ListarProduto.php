<?php
    require_once __DIR__ . "/../../produto/ProdutoDAO.php";

    class ListarProduto{
        public function __construct(){
            $dao = new ProdutoDAO();
            $lista = $dao->listar();

            require __DIR__ . "/../../index.php";
        }
    }
?>