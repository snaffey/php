<?

include_once './AgregadoUtentes.php';
include_once './IteratorListaUtentesCalheta.php';
class UtentesCalheta implements AgregadoUtentes {
	protected $utentes;
	public function __construct() {
		
	}
	public function criarIterator() {
		return new IteratorListaUtentesCalheta($this->utentes);
	}
}
?>
	