<?php


/**
 * Class UserModel
 * @author Rafael Velosa
 */
class UserModel extends MainModel{
    public function __construct($info = null){
        parent::__construct($info);
        $this->tableName = "socio";
    }

    public function getUserInfo($id = null){
        if (!isset($this->info->id) && $id === null)
            return null;
        if ($id !== null)
            return $this->db->getUserInfo($id);
        return $this->db->getUserInfo($this->info->id);
    }

    public function getUserAssociacao($id){
        if (!LoginCore::isSuperAdmin($id)) {
            $result = $this->db->select()
                ->from('associacao')
                ->where("id=(select associacaoId from socio where id=:id)")
                ->runQuery([":id" => $id]);
            if (isset($result[0]))
                return $result[0];
            return false;
        }
        $result = $this->db->select()
            ->from('associacao')
            ->runQuery();
        if (count($result) > 0)
            return $result;
        return false;
    }

    function getUserEventos($userId){
        $result = $this->db->select(['eventos.*'])->from('eventos inner join eventoInscricoes')->on('eventoInscricoes.eventoId=eventos.id and eventoInscricoes.socioId=:socioId')->runQuery([':socioId'=>$userId]);
        return $result;
    }

    function getUserNoticiasGostadas($userId){
        $result = $this->db->select(['noticias.*'])
            ->from('noticias inner join noticiasGostos')
            ->on('noticiasGostos.noticiaId=noticias.id and noticiasGostos.socioId=:socioId')
            ->runQuery([':socioId'=>$userId]);
        return $result;
    }

    function getUserQuotas($userId){
        $result = $this->db->select(['quotas.*'])
            ->from('quotas')
            ->where('socioId=:socioId and status=\'active\'')
            ->runQuery([':socioId'=>$userId]);
        return $result;
    }

    public function getAll(){
        $result = $this->db->select([$this->tableName.'.*', 'associacao.nome as associacaoNome'])
            ->from($this->tableName.' join associacao')
            ->on('socio.associacaoId = associacao.id')
            ->runQuery();
        for ($i=0;$i<count($result);$i++){
            $result[$i]->permissions = unserialize($result[$i]->permissions);
        }
        return $result;
    }

    public function getAssociacaoInfo($assocId=null){
        $result = $this->db->select()
            ->from('associacao')
            ->where('id=:id')
            ->runQuery([':id'=>$this->info->associacaoId]);
        if ($assocId === null)
            $result = $this->db->select()
                ->from('associacao')
                ->where('id=:id')
                ->runQuery([':id'=>$assocId]);
        if (isset($result[0])){
            $result[0]->socios = $this->getSociosAssocs($assocId);
            return $result;
        }
    }

    public function getSociosAssocs($assocId){
        return $this->db->select()
            ->from('socios')
            ->where('asssocId=:asssocId')
            ->runQuery([':asssocId'=>$assocId]);
    }

    public function getUser($id=null, $username=null){
        if ($username !== null)
            return $this->db->select()
                ->from('socio')
                ->where('username=:username')
                ->limit(1)->runQuery([':username'=>$username]);
        if ($id !== null)
            return $this->db->select()->from('socio')->where('id=:id')->limit(1)->runQuery([':id'=>$id]);
        return $this->db->select()->from('socio')->where('id=:id')->limit(1)->runQuery([':id'=>$this->info->id]);
    }

    public function insert($username, $hashedPassword, $email, $nome, $assocId, $permissions=['Any']){
        $this->db->insert('socio')
                 ->values([':username', ':password', ':nome', ':email', ':permissions', ':associacaoId'], ['username','password','nome','email','permissions','associacaoId'])
                 ->runQuery([':username'=>$username, ':password'=>$hashedPassword,':permissions'=>$permissions, ':nome'=>$nome, ':email'=>$email, ':associacaoId'=>$assocId]);
    }

    public function updateUsername($username){
        if (!isset($this->info->id))
            return false;
        $this->db->update('socio')
                 ->set(['username=:username'])
                 ->where('id=:id')
                 ->runQuery([':id'=>$this->info->id, ':username'=>$username]);
        return true;
    }

    public function updatePassword($newPasswordHash){
        if (!isset($this->info->id))
            return false;
        $this->db->update('socio')
                 ->set(['password=:password'])
                 ->where('id=:id')
                 ->runQuery([':id'=>$this->info->id, ':password'=>$newPasswordHash]);
        return true;
    }

    public function updateNome($nome){
        if (!isset($this->info->id))
            return false;
        $this->db->update('socio')
                 ->set(['nome=:nome'])
                 ->where('id=:id')
                 ->runQuery([':id'=>$this->info->id, ':nome'=>$nome]);
        return true;
    }

    public function updateEmail($email){
        if (!isset($this->info->id))
            return false;
        $this->db->update('socio')
                 ->set(['email=:email'])
                 ->where('id=:id')
                 ->runQuery([':id'=>$this->info->id, ':email'=>$email]);
        return true;
    }

    public function usernameExists($username): bool{
        $result = $this->db->select(['id'])
                       ->from('socio')
                       ->where('username=:username')
                       ->runQuery([':username'=>$username]);
        if (isset($result[0]))
            return true;
        return false;
    }

    public function getAllQuotas($active = true){
        $query = $this->db->select(['quotas.*', 'socio.username as nome'])
            ->from('quotas inner join socio')
            ->on('quotas.socioId=socio.id');
        if ($active)
            $query->where('status=\'active\'');
        return $query->runQuery();
    }

    public function getAllEventos($all = false){
        $query = $this->db->select(['eventos.*','associacao.nome'])
                          ->from('eventos inner join associacao')
                          ->on('eventos.associacaoId=associacao.id');
        if (!$all)
            $query->where('eventos.data > NOW()');
        return $query->runQuery();
    }

    public function getAllNoticias(){
        return $this->db->select(['noticias.*','associacao.nome'])
                        ->from('noticias inner join associacao')
                        ->on('noticias.associacaoId=associacao.id')
                        ->runQuery();
    }

    public function isAcociatedToQuota($quotaId, $userId=null){
        $result = $this->db->select(['id'])
                   ->from('quotas')
                   ->where('id=:id and socioId=:userId')
                   ->runQuery([':id'=>$quotaId, ':userId'=>$userId ?? $this->info->id]);
        return isset($result[0]);
    }

    public function updateQuotaStatus($id, $inactive = true){
        if ($inactive)
            $this->db->update('quotas')
                ->set(['status=\'inactive\''])
                ->where('id=:id')
                ->runQuery([':id'=>$id]);
        else
            $this->db->update('quotas')
                ->set(['status=\'active\''])
                ->where('id=:id')
                ->runQuery([':id'=>$id]);
    }

    public function updatePerms($permissions, $id=null){
        if (!isset($this->info->id) && $id === null)
            return false;
        $this->db->update('socio')
            ->set(['permissions=:permissions'])
            ->where('id=:id')
            ->runQuery([':id'=>($id===null)?$this->info->id:$id, ':permissions'=>$permissions]);
        return true;

    }

    public function getAllAssociacoes(){
        return $this->db->select()
            ->from('associacao')
            ->runQuery();
    }

    public function getAllSociosByAssoc(){
        $result = $this->db->select(['id', 'nome'])
            ->from('associacao')
            ->runQuery();
        $assocs = iterate($result, function ($el) use (&$assocs){
            $socios = $this->db->select()
                ->from('socio')
                ->where('associacaoId=:associacaoId')
                ->runQuery([':associacaoId'=>$el->id]);
            return ["assocNome"=>$el->nome,"socios"=>$socios];
        });
        return $assocs;
    }

    public function getAllEventosByAssoc(){
        $result = $this->db->select(['id', 'nome'])
            ->from('associacao')
            ->runQuery();
        $assocs = iterate($result, function ($el) use (&$assocs){
            $eventos = $this->db->select(['eventos.*','associacao.nome'])
                ->from('eventos inner join associacao')
                ->on('eventos.associacaoId=associacao.id')
                ->where('eventos.data > NOW() and associacaoId=:associacaoId')
                ->runQuery([':associacaoId'=>$el->id]);
            return ["assocNome"=>$el->nome,"eventos"=>$eventos];
        });
        return $assocs;

    }

    public function getTotalNoticias($superAdm, $adm){
        if ($superAdm)
            return $this->db->select(['count(*) as total'])
                ->from('noticias')
                ->runQuery()[0]->total;
        else if ($adm)
            return $this->db->select(['count(*) as total'])
                ->from('noticias')
                ->where('associacaoId=:associacaoId')
                ->runQuery([':associacaoId'=>$this->info->associacaoId])[0]->total;
        return $this->db->select(['count(*) as total'])
            ->from('noticiasGostos')
            ->where('socioId=:userId')
            ->runQuery([':userId'=>$this->info->id])[0]->total;
    }
    public function getTotalEventos($superAdm, $adm){
        if ($superAdm)
            return $this->db->select(['count(*) as total'])
                ->from('eventos')
                ->runQuery()[0]->total;
        else if ($adm) {
            return $this->db->select(['count(*) as total'])
                ->from('eventos')
                ->where('associacaoId=:associacaoId')
                ->runQuery([':associacaoId' => $this->info->associacaoId])[0]->total;
        }
        return $this->db->select(['count(*) as total'])
            ->from('noticiasGostos')
            ->where('socioId=:userId')
            ->runQuery([':userId'=>$this->info->id])[0]->total;
    }
    public function getTotalQuotas($superAdm, $adm){
        if ($superAdm)
            return $this->db->select(['count(*) as total'])
                ->from('quotas')
                ->where('status=\'active\'')
                ->runQuery()[0]->total;
        else if ($adm)
            return $this->db->select(['count(*) as total'])
                ->from('quotas inner join socio inner join associacao')
                ->on('quotas.socioId=socio.id and socio.associacaoId=associacao.id')
                ->where('associacao.id=:associacaoId and status=\'active\'')
                ->runQuery([':associacaoId'=>$this->info->associacaoId])[0]->total;
        return $this->db->select(['count(*) as total'])
            ->from('quotas')
            ->where('socioId=:userId and status=\'active\'')
            ->runQuery([':userId'=>$this->info->id])[0]->total;
    }

    public function getEmail($socioId){
        return $this->db->select(['email'])
            ->from('socio')
            ->where('id=:id')
            ->runQuery([':id'=>$socioId])[0]->email;
    }

    public function addQuotasAll(){
        // faz o inner join para ignorar users tipo o super admin como não pertence a nenhuma associacao valida
        $today = date('Y-m-d');
        $dateT = (new DateTime("+1 month"))->format("Y-m-d");
        $socios = $this->db->select(['socio.id as id'])
            ->from($this->tableName.' join associacao')
            ->on('socio.associacaoId = associacao.id')
            ->runQuery();
        $result = true;
        iterate($socios, function ($el) use ($dateT, $today, &$result) {
           $result = $this->db->select()
               ->from('quotas')
               ->where('socioId=:socioId and dataComeco=:dataComeco and dataTermino=:dataTermino')
               ->runQuery([':socioId'=>$el->id, ':dataComeco'=>$today, ':dataTermino'=>$dateT]);
           $result = !isset($result[0]);
           if ($result)
               $this->db->insert('quotas')
                   ->values([':socioId', ':dataComeco', ':dataTermino', ':preco', '"active"'], ['socioId', 'dataComeco', 'dataTermino', 'preco', 'status'])
                   ->runQuery([':socioId'=>$el->id, ':dataComeco'=>$today, ':dataTermino'=>$dateT, ':preco'=>100]);
        });
        return $result;
    }
}