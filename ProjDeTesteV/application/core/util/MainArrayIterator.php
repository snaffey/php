<?php


/**
 * Class ArrayIterator
 * @author Rafael Velosa
 */
class MainArrayIterator implements IIterator{

    /**
     * Guarda da pos
     * @var int $pos
     */
    private int $pos = 0;

    /**
     * Guarda a lista para percorrer
     * @var array $list
     */
    private array $list;

    /**
     * MainArrayIterator constructor.
     * @param array $list
     */
    public function __construct(array $list){
        $this->list = $list;
    }

    /**
     * retorna true se houver proximo e false senao houver proximo
     * @return bool
     */
    public function hasNext(){
        return isset($this->list[$this->pos]);
    }

    /**
     * retorna a proxima pos do array
     * @return mixed
     */
    public function next(){
        return $this->list[$this->pos++];
    }

    /**
     * reseta a pos
     * @return mixed|void
     */
    public function reset(){
        $this->pos = 0;
    }
}