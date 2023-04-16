<?php


class NoticiaHandler extends PageHandler{
    public function __construct(){
        $this->model = $this->loadModel('NoticiaModel');
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
        if (!isset($_POST['titulo']) || empty($_POST['titulo'])) {
            gotoPage($_GET['path'] . '?error=fe');
            return;
        }
        $titulo = $_POST['titulo'];
        if (!isset($_POST['conteudo']) || empty($_POST['conteudo'])) {
            gotoPage($_GET['path'] . '?error=fe');
            return;
        }
        $conteudo = $_POST['conteudo'];
        if (!isset($_FILES['imagem'])) {
            gotoPage($_GET['path'] . '?error=efi');
            return;
        }
        $imagem = $_FILES['imagem'];
        if (false === strpos($imagem['type'], 'image/')){
            gotoPage($_GET['path'] . '?error=iit');
            return;
        }
        if ($imagem['size'] > MAXFILESIZE){
            gotoPage($_GET['path'] . '?error=iis');
            return;
        }
        do{
            $newName = md5(mt_rand(1,50000000000)).'.'.str_replace("image/", '', $imagem['type']);
            $dir = UP_URI . "/noticias/";
            $absDir = ABSPATH . "/public/uploads/noticias/";
            $path = $dir.$newName;
            $absPath = $absDir.$newName;
        }while(file_exists($path));
        if (!isset($_POST['associacaoId']) || empty($_POST['associacaoId']) || $_POST['associacaoId'] == "None"){
            gotoPage($_GET['path'] . '?error=aie');
            return;
        }
        $assocId = $_POST['associacaoId'];
        $userAssocId = (new Db)->getUserInfo($userId)->associacaoId;
        if ($assocId != $userAssocId && !LoginCore::isSuperAdmin($userId)){
            gotoPage("home/?error=af");
            return;
        }
        if(move_uploaded_file($imagem['tmp_name'], $absPath) === false){
            gotoPage('500');
            return;
        }
        $this->model->insert($titulo, $conteudo, $path, $assocId);
        $id = $this->model->getLatestId();
        gotoPage("noticia/$id?success=4");
    }

    public function editar(){
        $parametros = (func_num_args() >= 1) ? func_get_arg(0) : [];
        $id = $parametros[0];
        if (!isset($_POST['titulo']) || empty($_POST['titulo'])) {
            gotoPage($_GET['path'] . '?error=fe');
            return;
        }
        $titulo = $_POST['titulo'];
        if (!isset($_POST['conteudo']) || empty($_POST['conteudo'])) {
            gotoPage($_GET['path'] . '?error=fe');
            return;
        }
        $conteudo = $_POST['conteudo'];
        $imagem = null;
        if (isset($_FILES['imagem']) && !empty($_FILES['imagem']['name'])) {
            var_dump($_FILES['imagem']);
            $imagem = $_FILES['imagem'];
            if (false === strpos($imagem['type'], 'image/')){
                gotoPage($_GET['path'] . '?error=iit');
                return;
            }
            if ($imagem['size'] > MAXFILESIZE){
                gotoPage($_GET['path'] . '?error=iis');
                return;
            }
            $userId = LoginCore::getUserId();
            if ($userId == false){
                gotoPage('login/?error=af&next='.$_GET['path'].(isset($_POST['nextPage']) ? '?'.$_POST['nextPage'] : ''));
                return;
            }
            if (!$this->model->userIsOnNoticiaAssociacao($parametros[0]) && !LoginCore::isSuperAdmin($userId)){
                gotoPage("home/?error=af");
                return;
            }
            do{
                $newName = md5(mt_rand(1,50000000000)).'.'.str_replace("image/", '', $imagem['type']);
                $dir = UP_URI . "/noticias/";
                $absDir = ABSPATH . "/public/uploads/noticias/";
                $path = $dir.$newName;
                $absPath = $absDir.$newName;
            }while(file_exists($path));
            if(move_uploaded_file($imagem['tmp_name'], $absPath) === false){
                echo $absPath;
                gotoPage('500');
                return;
            }
        }
        if ($imagem !== null) {
            $this->model->update($id, $titulo, $conteudo, $path);
            echo "img";
            gotoPage("noticia/$id?success=5");
            return;
        }
        $this->model->update($id, $titulo, $conteudo);
        gotoPage("noticia/$id?success=5");
    }
}