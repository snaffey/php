<?php


class QuotaHandler extends PageHandler{

    public function __construct(){
        $this->model = $this->loadModel('UserModel');
    }

    public function index(){
        gotoPage($_GET['path']);
    }

    public function pagar(){
        $parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : [];
        $userId = LoginCore::getUserId();
        if ($userId == false){
            gotoPage('login/?error=af&next='.gotoPage($_GET['path']));
            return;
        }

        if (!isset($_POST['quotaId']) || empty($_POST['quotaId'])){
            gotoPage('500/');
            return;
        }
        $id = $_POST['quotaId'];
        if (!$this->model->isAcociatedToQuota($id) && !LoginCore::isSuperAdmin($userId)){
            gotoPage('404/');
            return;
        }
        $this->model->updateQuotaStatus($id, inactive: true);
        if (isset($_POST['nextPage']) && $_POST['nextPage'] != "") {
            $prefix = (str_contains($_POST['nextPage'], '?'))?'&':'?';
            gotoPage($_POST['nextPage'].$prefix.'success=7');
            return;
        }
        gotoPage('pessoal/?success=7');
    }
}