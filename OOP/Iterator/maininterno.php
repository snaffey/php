<?php
include './UtentesCalheta.php';
include './Utente.php';
include_once './IteratorListaUtentesCalheta.php';
include_once './IteratorLoopPrint.php';

/* Solução Iterator com pedido de Cliente(Interno) O cliente(codigo de pedido)não necessita preocupar-se
com o ciclo de vida do Iterator, apenas indica a operação que pretende ver realizada.
Usamos uma classe abstrata que implementa o método de percorrer o conjunto e realiza a operação com o conjunto. (IteratorInterno)
 Usamos uma subclasse do IteratorInterno para sobescrever a operação desejada.
 O IteratorInterno chama o método loopList() que se responsabiliza por executar as operações com esse conjunto de dados.
 */
$utenteCalheta = new UtentesCalheta();
/*$itC = $utenteCalheta->criarIterator();
for ($itC; !$itC->isDone();$itC->next()){
    $utente = $itC->currentItem()->nome;
    echo '<br />'.$utente;
}*/
$it = new IteradorLoopPrint($utenteCalheta->criarIterator());
$it->loopList();
?>
	