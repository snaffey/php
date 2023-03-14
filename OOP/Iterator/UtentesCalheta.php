<?

include_once './AgregadoUtentes.php';
include_once './IteratorListaUtentesCalheta.php';
class UtentesCalheta implements AgregadoUtentes {
	protected $utentes;
	public function __construct() {
		$this->utentes = array();
        $this->utentes[] = new Utente("Utente 1 Calheta");
		$this->utentes[] = new Utente("Utente 2 Calheta");
		$this->utentes[] = new Utente("Utente 3 Calheta");
		$this->utentes[] = new Utente("Utente 4 Calheta");
	}
	public function criarIterator() {
		return new IteratorListaUtentesCalheta($this->utentes);
	}
}
?>
	