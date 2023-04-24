<?php


class AssociacaoHandler extends PageHandler{

    public int $id;

    public function __construct(){
        $this->model = $this->loadModel('AssociacaoModel');
    }

    public function index(){
        gotoPage($_GET['path']);
    }

    public function criar(){
        $userId = LoginCore::getUserId();
        if ($userId == false){
            gotoPage('login/?error=af&next='.gotoPage($_GET['path']));
            return;
        }
        if (!LoginCore::isSuperAdmin($userId)){
            gotoPage('?error=af');
            return;
        }
        if (!isset($_POST['nome']) || empty($_POST['nome'])){
            gotoPage('associacao/criar/?error=enf');
            return;
        }
        $nome = $_POST['nome'];
        if (!isset($_POST['morada']) || empty($_POST['morada'])){
            gotoPage('associacao/criar/?error=fe');
            return;
        }
        $morada = $_POST['morada'];
        if (!isset($_POST['nTelefone']) || empty($_POST['nTelefone'])){
            gotoPage('associacao/criar/?error=enf');
            return;
        }
        $nTelefone = $_POST['nTelefone'];
        if (!isset($_POST['nContribuinte']) || empty($_POST['nContribuinte'])){
            gotoPage('associacao/criar/?error=enf');
            return;
        }
        $nContribuinte = $_POST['nContribuinte'];

        if (!isset($_FILES['imgs'])) {
            gotoPage($_GET['path'] . '?error=efi');
            return;
        }
        $caminhos = [];
        $imagens = $_FILES['imgs'];
        $total = count($imagens['name']);
        if ($total == 0){
            gotoPage($_GET['path'] . '?error=efi');
            return;
        }
        for ($i = 0; $i<$total ; $i++){
            if (!str_contains($imagens['type'][$i], 'image/')){
                gotoPage($_GET['path'] . '?error=iit');
                return;
            }
            if ($imagens['size'][$i] > MAXFILESIZE){
                gotoPage($_GET['path'] . '?error=iis');
                return;
            }
            do{
                $newName = md5(mt_rand(1,50000000000)).'.'.str_replace("image/", '', $imagens['type'][$i]);
                $dir = UP_URI . "/associacoes/";
                $absDir = ABSPATH . "/public/uploads/associacoes/";
                $path = $dir.$newName;
                $absPath = $absDir.$newName;
                $caminhos[] = $path;
            }while(file_exists($path));
            if(move_uploaded_file($imagens['tmp_name'][$i], $absPath) === false){
                gotoPage('500');
                return;
            }
        }
        $this->id = $this->model->insert($nome, $morada, $nTelefone, $nContribuinte);
        iterate($caminhos, function ($path){
            $id = $this->id;
            $this->model->insertImage($path, $id);
        });
        gotoPage('associacao/' . $this->id) . '?success=4';
    }

    public function editar(){
        $parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : [];
        if (!isset($parametros[0])){
            gotoPage('404');
            return;
        }
        $id = $parametros[0];
        $userId = LoginCore::getUserId();
        if ($userId == false){
            gotoPage('login/?error=af&next='.gotoPage($_GET['path']));
            return;
        }
        if (!LoginCore::isSuperAdmin($userId)){
            gotoPage('?error=af');
            return;
        }
        if (!isset($_POST['nome']) || empty($_POST['nome'])){
            gotoPage('associacao/editar/'.$id.'/?error=enf');
            return;
        }
        $nome = $_POST['nome'];
        if (!isset($_POST['morada']) || empty($_POST['morada'])){
            gotoPage('associacao/editar/'.$id.'/?error=fe');
            return;
        }
        $morada = $_POST['morada'];
        if (!isset($_POST['nTelefone']) || empty($_POST['nTelefone'])){
            gotoPage('associacao/editar/'.$id.'/?error=enf');
            return;
        }
        $nTelefone = $_POST['nTelefone'];
        if (!isset($_POST['nContribuinte']) || empty($_POST['nContribuinte'])){
            gotoPage('associacao/editar/'.$id.'/?error=enf');
            return;
        }
        $nContribuinte = $_POST['nContribuinte'];
        $imgs = true;
        if (!isset($_FILES['imgs'])) {
            $imgs = false;
        }
        $caminhos = [];
        if ($imgs){
            $imagens = $_FILES['imgs'];
            $total = count($imagens['name']);
            if ($total > 0 && $imagens['name'][$total-1] != ""){
                var_dump($total);
                for ($i = 0; $i<$total ; $i++){
                    if (!str_contains($imagens['type'][$i], 'image/')){
                        gotoPage($_GET['path'] . '?error=iit');
                        return;
                    }
                    if ($imagens['size'][$i] > MAXFILESIZE){
                        gotoPage($_GET['path'] . '?error=iis');
                        return;
                    }
                    do{
                        $newName = md5(mt_rand(1,50000000000)).'.'.str_replace("image/", '', $imagens['type'][$i]);
                        $dir = UP_URI . "/associacoes/";
                        $absDir = ABSPATH . "/public/uploads/associacoes/";
                        $path = $dir.$newName;
                        $absPath = $absDir.$newName;
                    }while(file_exists($path));
                    $caminhos[] = $path;
                    if(move_uploaded_file($imagens['tmp_name'][$i], $absPath) === false){
                        gotoPage('500');
                        return;
                    }
                }
            }
        }
        $this->model->update($id, $nome, $morada, $nTelefone, $nContribuinte);
        iterate($caminhos, function ($path) use ($id) {
            $this->model->insertImage($path, $id);
        });
        gotoPage('associacao/' . $id . '/?success=5');
    }
}