<?php


/**
 * Interface IIterator
 * @author Rafael Velosa
 */
interface IIterator{
    /**
     * Retorna a proxima pos de array
     * @return mixed
     */
    public function next();

    /**
     * Retorna true se houver uma proxima pos
     * @return mixed
     */
    public function hasNext();

    /**
     * Reseta o contador e volta
     * @return mixed
     */
    public function reset();
}