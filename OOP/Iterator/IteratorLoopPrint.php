<?
include './IteratorInterno.php';
class IteradorLoopPrint extends IteratorInterno {
	// new IteradorLoopPrint(IteratorInterface)
	public function __construct($it) {
		$this->it = $it;
	}
	protected function operation($u) {
		echo $u->nome.'<br />';
	}
}
?>
	