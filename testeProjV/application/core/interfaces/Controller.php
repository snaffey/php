<?php


/**
 * Interface Controller
 * @author Rafael Velosa
 */
interface Controller{

    /**
     * Carega um modelo
     * @param $modelName
     * @return mixed
     */
    public function loadModel($modelName);
}