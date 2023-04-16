<?php

include_once APPLICATIONPATH."/models/UserModel.php";

class UserObserver implements Observer{

    protected int $socioId;
    protected int $subjectId;
    protected array $options;
    protected UserModel $model;

    /**
     * UserObserver constructor.
     * @param int $socioId
     * @param int $subjectId
     */
    public function __construct(int $socioId, int $subjectId){
        $this->socioId = $socioId;
        $this->subjectId = $subjectId;
        $this->model = new UserModel();
        $this->options = [
            "insert-event" => function(){
                $email = $this->model->getEmail($this->socioId);
                // todo guardar na base de dados a versao seralizada da class email com a data de envio calculada
            }
        ];
    }

    public function send($status){
        $this->options[$status]();
    }
}