<?
abstract class MainAssociacao extends Pager{
    public $form_data;
    public $form_msg;
    public $form_enter;
    public $form_confirma;
    public $db;
    public $controller;
    public $parametros;
    public $userdata;

    //class abstrata que pega a query de cada modelo específico
    abstract public function findQuery($query_limit = null);

    public function list_my_table() {
        // Configura as variáveis que vamos utilizar
        $query_limit = null;
        // Configura o número de posts por página
        $posts_por_pagina = $this->posts_por_pagina;
        // Esta propriedade foi configurada no modelo para prevenir limite ou paginação na administração.
        if (empty($this->sem_limite))
            // Configura o limite da consulta
		    $query_limit = " LIMIT $posts_por_pagina ";
        //retorna a uma array associativo que 
        return $this->findQuery($query_limit)->fetchAll();
    }

    public function apaga_table() {
        if (chk_array($this->parametros, 0) != 'del')
            return;
        // O segundo parâmetro deverá ser um ID numérico
        if(!is_numeric(chk_array($this->parametros, 1)))
            return;
        // Para excluir, o terceiro parâmetro deverá ser "confirma"
        if (chk_array($this->parametros, 2) != 'confirma') {
            // Configura uma mensagem de confirmação para o user
            $mensagem = '<p class="alert">Tem certeza que deseja apagar a associacao? Write "Confrim"</p>';
            $mensagem .= '<form method="post">';
            $mensagem .= '<input type="text" placeholder="Confirm" name="confirm_txt"/> <br>';
            //$mensagem .= '<p><a href="'.$_SERVER['REQUEST_URI'].'/confirma/">Sim</a> | ';
            $mensagem .= '<input type="submit" value="Sim" name="confirm"/>';
            //$mensagem .= '<a href="'.$this->uri.'">Não</a></p>';
            $mensagem .= '<input type="submit" value="Nao" name="confirm"/>';
            $mensagem .= '</form>';
            // Retorna a mensagem e não excluir
            if(!empty($_POST) && $_POST['confirm'] == "Sim" && $_POST['confirm_txt'] == "Confirm")
                $this->goto_page($_SERVER['REQUEST_URI'].'/confirma/');
            else if(!empty($_POST) && $_POST['confirm'] != "Sim")
                $this->goto_page($this->uri);
            else if(!empty($_POST) && $_POST['confirm_txt'] != "Confirm")
                $this->form_msg = '<p class="error">Write Confirm</p>';
            return $mensagem;
        }
        $fetch = $this->findQuery(null)->fetchAll();
        if($fetch > 0){
            // Executa a consulta
            $this->db->delete($this->table, $this->table_id, $this->tableId);
            $this->db->delete('assoc_socios', $this->table_id, $this->tableId);
            $this->goto_page($this->uri);
        }else
            return;
    }
    
    public function obtem_table() {
        // Verifica se o primeiro parâmetro é "edit"
        if (chk_array($this->parametros, 0) != 'edit') {
            return;
        }
        $this->form_msg = '<p class="alert">A atualizar</p>';
        // Verifica se o segundo parâmetro é um número
        if (!is_numeric(chk_array($this->parametros, 1)))
            return;
        // Configura o ID da table
        $tableId = chk_array($this->parametros, 1);
        if ('POST' == $_SERVER['REQUEST_METHOD'] && !empty($_POST['insere_table'])) {
            // Remove o campo insere_table para não gerar problemas com o PDO
            unset($_POST['insere_table']);
            // Atualiza os dados
            $query = $this->db->update($this->table, $this->table_id, $tableId, $_POST);
            // Verifica a consulta
            if ($query) {
                // Retorna uma mensagem
                $this->form_msg = '<p class="success">'.$this->table.' atualizado com sucesso!</p>';
                //Refresh
                $this->goto_page($this->uri);
            }
        }
        // Faz a consulta para obter o valor
        $query = $this->db->query('SELECT * FROM '.$this->table.' WHERE '.$this->table_id.' = ? LIMIT 1', array($tableId));
        // Obtém os dados
        $fetch_data = $query->fetch();
        // Se os dados estiverem nulos, não faz nada
        if (empty($fetch_data)) {
            return;
        }
        // Configura os dados do formulário
        $this->form_data = $fetch_data;
    }// obtem_table
}
?>