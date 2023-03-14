<?
include './UtentesCalheta.php';
include './Utente.php';
include_once './IteratorListaUtentesCalheta.php';

/* Solução Iterator com pedido de Cliente(externo)
 O cliente é responsavel por indicar o modo com que os itens serão iterados.
 No exemplo usamos estruturas for para definir a iteração e as operações sobre o conjunto de dados.
 */
 $utenteCalheta = new UtentesCalheta();
 $itC = $utenteCalheta->criarIterator();
 for ($itC; !$itC->isDone();$itC->next()){
	 $utente = $itC->currentItem()->nome;
	 echo '<br />'.$utente;
 }
?>
	