<?php
include './IteratorInterno.php';

class IteratorLoopPrint extends IteratorInterno {
    public function __construct($it) {
        $this->it = $it;
    }

    protected function operation($utente) {
        echo $utente->nome . '<br>';
    }
}

?>