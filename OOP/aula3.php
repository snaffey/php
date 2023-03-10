<?php

/* Acontece quando um objeto precisa de outro objeto para completar uma tarefa */

class Produtos{
    public $nome;
    public $valor;

    //Construtor pelo nome da classe(método)
    public function Produtos(){
        $this->nome = "Produto";
        $this->valor = 0;
    }

    public function __construct($nome = null, $valor = null){
        $this->nome = $nome;
        $this->valor = $valor;
    }

    public function __destruct(){
        echo "Objeto destruido";
    }
}

    // Cria carrinho de compras
    class CarrinhoCompras{
        public $produtos;

        public function adiciona(Produtos $produto){
            $this->produtos[] = $produto;   
        }

        public function exibe(){
            foreach($this->produtos as $produto){
                echo $produto->nome . " - " . $produto->valor . "<br>";
            }
        }
    }

    $produto1 = new Produtos("Produto 1", 10);
    $produto2 = new Produtos("Produto 2", 20);
    $produto3 = new Produtos("Produto 3", 30);

    $carrinho = new CarrinhoCompras();
    $carrinho->adiciona($produto1);
    $carrinho->adiciona($produto2);
    $carrinho->adiciona($produto3);

    $carrinho->exibe();



?>