<?php
include_once './IteratorInterface.php';

abstract class IteratorInterno {
    protected $it;
    public function loopList(){
        for ($this->it->first(); $this->it->isDone(); $this->it->next()){
            $this->operation($this->it->currentItem());
        }
    }

    abstract protected function operation($utente);
}


?>