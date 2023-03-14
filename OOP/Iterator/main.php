<?php
include './UtenteCalheta.php';
include './Utente.php';
include './IteratorListaUtentesCalheta.php';

$utentes = new UtentesCalheta();
$iterador = $utentes->criaIterador();

for ($iterador; !$iterador->isDone(); $iterador->next()) {
    $utente = $iterador->currentItem()->nome;
    echo $utente . " ";
}
?>