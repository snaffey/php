<?php

//$this vs self

/*
this refere-se ao objeto (instância) atual.
self refere-se à classe atual.

Nota: self::metodo() -> chama um método estático
Descobrir o nome da classe atual: get_class($this)
*/

class Animal
{
    public function teste()
    {
        echo "\$this é instancia de" . get_class($this) . "<br />";
        self::fala();
        echo "this->fala<br />";
        $this->fala();
    }

    public function fala()
    {
        echo "Ola <br />";
    }
}

class Gato extends Animal
{
    public function fala()
    {
        echo "Miau <br />";
    }
}

class Cachorro extends Animal
{
    public function fala()
    {
        echo "Au Au <br />";
    }
}

//this e self correspondem ao mesmo
$animal = new Animal();
$animal->teste();

// this (Gato) e self (Animal)
$gato = new Gato();
$gato->teste();

// this (Cachorro) e self (Animal)
$cachorro = new Cachorro();
$cachorro->teste();
