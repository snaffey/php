<?php


/**
 * Class MainModel
 * @author Rafael Velosa
 */
class MainModel{

    /**
     * Guarda um objeto da base de dados
     * @var Db
     */
    protected Db $db;

    /**
     * Guarda o nome da tabela da base de dados
     * @var
     */
    protected $tableName;

    /**
     * Guarda informação da aplicação
     * @var
     */
    protected $info;

    /**
     * MainModel constructor.
     * @param $info
     */
    public function __construct($info){
        $this->db = new Db;
        $this->info = $info;
    }
}
