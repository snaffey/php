<?
// $this vs self
/* $this refere-se ao objeto (instância) atual.
 self refere-se à classe. 
 NOTA: self para aceder a membros estáticos
 Sintaxe: self::metodo()
 $this->metodo()-> chama o metodo() da classe usada para instanciar o objeto
 Descobrir que classe é usamos get_class($this)
 */
 class Animal {
	 public function teste() {
		 echo "\$this é instância de " . get_class($this) . "<br />";
		 echo "self::fala<br />";
		 self::fala();
		 echo "this->fala<br />";
		 $this->fala();
	 }
	 public function fala() {
		 echo "Oi<br />";
	 }
 }
 
 class Gato extends Animal{
	 public function fala() {
		 echo "Miau!!!<br />";
	 }
 }
  class Cao extends Animal{
	 public function fala() {
		 echo "Auuuuu!!!<br />";
	 }
 }
 // this e self correspondem ao mesmo
 $animal = new Animal();
 $animal->teste();
 
  // this(Gato) e self(Animal)
 $gato = new Gato();
 $gato->teste();
 
  // this(Cao) e self(Animal)
 $cao = new Cao();
 $cao->teste();
?>
	