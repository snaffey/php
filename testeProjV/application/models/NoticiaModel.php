<?php


class NoticiaModel extends MainModel{
    public function __construct($info = null){
        parent::__construct($info);
        $this->tableName = 'noticias';
    }
    public function getAssociacaoId(){
        return $this->db->select(['associacaoId'])->from('socio')->where("id=:id")->limit(1)->runQuery([':id'=>$this->info->id])[0]->associacaoId;
    }

    public function getAll(){
        return $this->db->select()->from('associacao')->runQuery();
    }

    public function getNoticia($id){
        $result = $this->db->select()->from($this->tableName)->where("id=:id")->limit(1)->runQuery([':id'=>$id]);
        if (isset($result[0]))
            return $result[0];
        return false;
    }

    public function delete($id){
        $path = $this->db->select(['caminhoImg'])->from($this->tableName)->where('id=:id')->limit(1)->runQuery([':id'=>$id])[0]->caminhoImg;
        $this->db->delete($this->tableName)->where("id=:id")->runQuery([':id'=>$id]);
        $img = explode('/', $path);
        $img = end($img);
        $path = UP_ABSPATH.'/noticias/'.$img;
        if (file_exists($path))
            unlink($path);
    }

    public function getLatestId(){
        return $this->db->select(['id'])->from('noticias')->orderBy('id', "desc")->limit(1)->runQuery()[0]->id;
    }

    public function insert($titulo, $conteudo, $path, $assocId){
        $this->db->insert('noticias')->values([':titulo', ':conteudo', ':caminhoImg', ':associacaoId'], ['titulo', 'conteudo', 'caminhoImg', 'associacaoId'])->runQuery([':titulo'=>$titulo, ':conteudo'=>$conteudo, ':caminhoImg'=>$path, ':associacaoId'=>$assocId]);
    }

    public function update($id, $titulo, $conteudo, $path=null){
        if ($path !== null)
            $this->db->update('noticias')->set(['titulo=:titulo', 'conteudo=:conteudo', 'caminhoImg=:caminhoImg'])->where("id=:id")->runQuery([':id'=>$id, ':titulo' => $titulo, ':conteudo' => $conteudo, ':caminhoImg' => $path]);
        else
            $this->db->update('noticias')->set(['titulo=:titulo', 'conteudo=:conteudo'])->where('id=:id')->runQuery([':id'=>$id, ':titulo' => $titulo, ':conteudo' => $conteudo]);
    }

    public function userIsOnNoticiaAssociacao($id){
        $result = $this->db->select(['id'])->from($this->tableName)->where("associacaoId=:associacaoId and id=:id")->runQuery([':associacaoId'=>$this->info->associacaoId, ':id'=>$id]);
        return isset($result[0]);
    }

    public function getAllByAssociacao($associacaoId){
        return $this->db->select()
            ->from('noticias')
            ->where('associacaoId=:associacaoId')
            ->runQuery([':associacaoId'=>$associacaoId]);
    }
    public function userIsOnAssociacao($id){
        $result = $this->db->select(['id'])->from('socio')->where("id=:id and associacaoId=:associacaoId")->runQuery([':id'=>$this->info->id, ':associacaoId'=>$id]);
        return isset($result[0]);
    }
}