<?
class ImovelItem {
	protected $nome;
    public function __construct($nome) {
        $this->nome = $nome;
    }
	public function _toString(){
		return $this->nome;
	}
}
interface IIterator {
    function hasNext(); // retorna boolean
    function next(); // retorna um objeto
}
class ImovelIterator implements IIterator {
	protected $itens = array();
	protected $posicao = 0;
	public function __construct($itens) {
        $this->itens = $itens;
    }
	public function next() {
	/*$imv = $this->itens[$this->posicao];
	$this->posicao++;
	return $imv;*/
		 return $this->itens[$this->posicao++];
	}
	public function hasNext() {
		 if ($this->posicao >= count($this->itens) || $this->itens[$this->posicao] == null) { 
			return false;
		 }else
			return true;
	}
}
// Main
$imoveisItens = array();
$imoveisItens[] = new ImovelItem("Imovel 1");
$imoveisItens[] = new ImovelItem("Imovel 2");
$imovelIterator = new ImovelIterator($imoveisItens);
while ($imovelIterator->hasNext()) {
	echo "<br />".$imovelIterator->next()->_toString();
}
?>
	