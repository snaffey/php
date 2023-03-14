<?
include './UtentesCalheta.php';
include './Utente.php';
include_once './IteratorListaUtentesCalheta.php';
include_once './IteratorLoopPrint.php';

 $utenteCalheta = new UtentesCalheta();
 $it = new IteratorLoopPrint($utenteCalheta->criarIterator());
    $it->loopList();
?>
	