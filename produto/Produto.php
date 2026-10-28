<?php
    class Produto{
        private $id;
        private $categoriaNome;
        private $nome;
        private $descricao;
        private $preco;
        private $precoPromocional;
        private $imagem;
        private $novo;
        private $ativo;
        private $estoque;

        public function getId() {return $this->id;}
        public function setId($id) {$this->id = $id;}

        public function getCategoriaNome() {return $this->id;}
        public function setCategoriaNome($categoriaNome) {$this->categoriaNome = $categoriaNome;}

        public function getNome() {return $this->nome;}
        public function setNome($nome) {$this->nome = $nome;}

        public function getDescricao() {return $this->descricao;}
        public function setDescricao($descricao) {$this->descricao = $descricao;}

        public function getPreco() {return $this->preco;}
        public function setPreco($preco) {$this->preco = $preco;}

        public function getPrecoPromocional() {return $this->precoPromocional;}
        public function setPrecoPromocional($precoPromocional) {$this->precoPromocional = $precoPromocional;}

        public function getImagem() {return $this->imagem;}
        public function setImagem($imagem) {$this->imagem = $imagem;}

        public function getNovo() {return $this->novo;}
        public function setNovo($novo) {$this->novo = $novo;}

        public function getAtivo() {return $this->ativo;}
        public function setAtivo($ativo) {$this->ativo = $ativo;}

        public function getEstoque() {return $this->estoque;}
        public function setEstoque($estoque) {$this->estoque = $estoque;}
    }
?>