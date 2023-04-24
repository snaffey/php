<?php


class AssociacaoModel extends MainModel{
    public function __construct($info = null){
        parent::__construct($info);
        $this->tableName = "associacao";
    }

    public function getAssociacaoInfo($id){
        $assocInfo = $this->db->select()->from($this->tableName)->where("id=:id")->runQuery([':id'=>$id]);
        if (isset($assocInfo[0])) {
            $assocInfo[0]->socios = $this->db->select()->from('socio')->where("associacaoId=:id")->runQuery([':id' => $id]);
            return $assocInfo[0];
        }
        return false;
    }

    public function getAll(){
        return $this->db->select()->from($this->tableName)->runQuery();
    }

    public function getCaminhoFotos($assocId){
        return $this->db->select(['caminho'])
            ->from('imagensAssociacao')
            ->where('associacaoId=:associacaoId')
            ->runQuery([':associacaoId'=>$assocId]);
    }

    public function userIsOnAssociacao($id){
        $result = $this->db->select(['id'])->from('socio')->where("id=:id and associacaoId=:associacaoId")->runQuery([':id'=>$this->info->id, ':associacaoId'=>$id]);
        return isset($result[0]);
    }

    public function userIsOnSameAssociacao($userId){
        $result = $this->db->select(['id'])->from('socio')->where("id=:id and associacaoId=(select associacaoId from socio where id=:userId)")->runQuery([':id'=>$this->info->id, ':userId'=>$userId]);
        return isset($result[0]);
    }

    public function insert($nome, $morada, $telefone, $nContribuinte){
        $this->db->insert('associacao')
            ->values([':nome', ':morada', ':telefone', ':nContribuinte'], ['nome', 'morada', 'telefone', 'nContribuinte'])
            ->runQuery([':nome'=>$nome, ':morada'=>$morada, ':telefone'=>$telefone, ':nContribuinte'=>$nContribuinte]);
        return $this->db->select(['id'])
            ->from('associacao')
            ->orderBy('id', 'DESC')
            ->limit(1)
            ->runQuery()[0]->id;
    }

    public function insertImage($image, $assocId){
        $this->db->insert('imagensAssociacao')
            ->values([':caminho', ':associacaoId'], ['caminho', 'associacaoId'])
            ->runQuery([':caminho'=>$image, ':associacaoId'=>$assocId]);
    }

    public function update($id, $nome, $morada, $telefone, $nContribuinte){
        $this->db->update('associacao')
            ->set(['nome=:nome', 'morada=:morada', 'telefone=:telefone', 'nContribuinte=:nContribuinte'])
            ->where('id=:id')
            ->runQuery([':id'=>$id, ':nome'=>$nome, ':morada'=>$morada, ':telefone'=>$telefone, ':nContribuinte'=>$nContribuinte]);
    }

    public function delete($id){
        $this->db->delete('associacao')
            ->where('id=:id')
            ->runQuery([':id'=>$id]);
        $this->deleteImgs($id);
        $this->deleteAssocSocios($id);
        $this->deleteAssocNoticias($id);
        $this->deleteAssocEventos($id);
    }

    public function deleteImgs($assocId){
        $caminhos = $this->db->select(['caminho'])
            ->from('imagensAssociacao')
            ->where('associacaoId=:associacaoId')
            ->runQuery([':associacaoId'=>$assocId]);
        $this->db->delete('imagensAssociacao')
            ->where('associacaoId=:associacaoId')
            ->runQuery([':associacaoId'=>$assocId]);
        iterate($caminhos, function ($el){
            $path = $el->caminho;
            $img = explode('/', $path);
            $img = end($img);
            $path = UP_ABSPATH.'/associacoes/'.$img;
            if (file_exists($path))
                unlink($path);
        });
    }

    public function deleteAssocSocios($assocId){
        $result = $this->db->select(['id'])
            ->from('socio')
            ->where('associacaoId=:associacaoId')
            ->runQuery([':associacaoId'=>$assocId]);
        iterate($result, function ($el){
           $this->db->delete('quotas')
               ->where('socioId=:socioId')
               ->runQuery([':socioId'=>$el->id]);
        });
        $this->db->delete('socio')
            ->where('associacaoId=:associacaoId')
            ->runQuery([':associacaoId'=>$assocId]);
    }

    public function deleteAssocNoticias($assocId){
        $result = $this->db->select(['id'])
            ->from('noticias')
            ->where('associacaoId=:associacaoId')
            ->runQuery([':associacaoId'=>$assocId]);
        iterate($result, function ($el){
            $this->db->delete('noticiasGostos')
                ->where('noticiaId=:noticiaId')
                ->runQuery([':noticiaId'=>$el->id]);
        });
        $this->db->delete('noticias')
            ->where('associacaoId=:associacaoId')
            ->runQuery([':associacaoId'=>$assocId]);
    }

    public function deleteAssocEventos($assocId){
        $result = $this->db->select(['id'])
            ->from('eventos')
            ->where('associacaoId=:associacaoId')
            ->runQuery([':associacaoId'=>$assocId]);
        iterate($result, function ($el){
            $this->db->delete('eventoInscricoes')
                ->where('eventoId=:eventoId')
                ->runQuery([':eventoId'=>$el->id]);
        });
        $this->db->delete('eventos')
            ->where('associacaoId=:associacaoId')
            ->runQuery([':associacaoId'=>$assocId]);
    }

    public function socioExists($socioId){
        $socio = $this->db->select(['id'])
            ->from('socio')
            ->where('id=:id')
            ->runQuery([':id'=>$socioId]);
        return isset($socio[0]);
    }

    public function deleteSocio($socioId){
        $assocId = $this->db->select(['associacaoId'])
            ->from('socio')
            ->where('id=:id')
            ->runQuery([':id'=>$socioId])[0]->associacaoId;
        $this->db->delete('socio')
            ->where('id=:id')
            ->runQuery([':id'=>$socioId]);
        return $assocId;
    }
}