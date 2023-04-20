<?

abstract class MainModel extends Pager{
    public $form_data;
    public $form_msg;
    public $form_confirma;
    public $db;
    public $controller;
    public $parametros;
    public $userdata;

    public function upload_imagem() {
        // Verifica se o ficheiro da imagem existe
        if (empty($_FILES[$this->table_image]))
            return;
        // Configura os dados da imagem
        $imagem = $_FILES[$this->table_image];
        // Nome e extensão
        $nome_imagem = strtolower($imagem['name']);
        $ext_imagem = explode('.', $nome_imagem);
        $ext_imagem = end($ext_imagem);
        $nome_imagem = preg_replace('/[^a-zA-Z0-9]/' , '', $nome_imagem);
        $nome_imagem .=  '_' . mt_rand() . '.' . $ext_imagem;
        // Tipo, nome temporário, erro e tamanho
        $tipo_imagem = $imagem['type'];
        $tmp_imagem = $imagem['tmp_name'];
        $erro_imagem = $imagem['error'];
        $tamanho_imagem = $imagem['size'];

        // Os img types permitidos
        $permitir_tipos = array(
            'image/bmp',
            'image/x-windows-bmp',
            'image/gif',
            'image/jpeg',
            'image/pjpeg',
            'image/png',
        );
        // Verifica se o mimetype enviado é permitido
        if (!in_array($tipo_imagem, $permitir_tipos)) {
            // Retorna uma mensagem
            $this->form_msg = '<p class="error">deve enviar uma imagem nos formatos bmp,Gif,jpeg e png.</p>';
            return;
        }
        // Tenta mover o ficheiro enviado
        if (!move_uploaded_file($tmp_imagem, UP_ABSPATH . '/' . $nome_imagem)) {
            // Retorna uma mensagem
            $this->form_msg = '<p class="error">Erro ao enviar imagem.</p>';
            return;
        }
        // Retorna o nome da imagem
        return $nome_imagem;
    }// upload_imagem

    public function list_my_table() {
        // Configura as variáveis que vamos utilizar
        $query_limit = null;
        // Configura a página a ser exibida
        /*
            $pagina = !empty($this->parametros[1]) ? $this->parametros[1] : 1;
            // A páginação inicia do 0
            $pagina--;
            // Configura o número de posts por página
            $posts_por_pagina = $this->posts_por_pagina;
            // O offset dos posts da consulta
            $offset = $pagina * $posts_por_pagina;
        */
        // Configura o número de posts por página
        $posts_por_pagina = $this->posts_por_pagina;
        // Esta propriedade foi configurada no modelo paraprevenir limite ou paginação na administração.
        if (empty($this->sem_limite))
            // Configura o limite da consulta
		    $query_limit = " LIMIT $posts_por_pagina ";
        //retorna a uma array associativo que 
        return $this->findQuery($query_limit)->fetchAll();
    }

    //class abstrata que pega a query de cada modelo específico
    abstract public function findQuery($query_limit = null);
    
    public function apaga_table() {
        if(!is_numeric(chk_array($this->parametros, 0)))
            return;
        if (chk_array($this->parametros, 1) != 'del')
            return;
        // O segundo parâmetro deverá ser um ID numérico
        if(!is_numeric(chk_array($this->parametros, 2)))
            return;
        
        $id = chk_array($this->parametros, 0);
        // Para excluir, o terceiro parâmetro deverá ser "confirma"
        if (chk_array($this->parametros, 3) != 'confirma') {
            // Configura uma mensagem de confirmação para o user
            $mensagem = '<p class="alert">Tem certeza que deseja apagar a table?</p>';
            $mensagem .= '<p><a href="'.$_SERVER['REQUEST_URI'].'/confirma/">Sim</a> | ';
            $mensagem .= '<a href="'.$this->uri.$id.'">Não</a></p>';
            // Retorna a mensagem e não excluir
            return $mensagem;
        }
        $fetch = $this->findQuery(null)->fetchAll();
        if($fetch > 0){
            // Executa a consulta
            $this->db->delete($this->table, $this->table_id, $this->tableId);
            $this->goto_page($this->uri.$id);
        }else
            return;
    }
    public function insere_table() {
        if ('POST' != $_SERVER['REQUEST_METHOD'] || empty($_POST['insere_table']) || $_FILES[$this->table_image]['size'] == 0)
            return;
        if (!is_numeric(chk_array($this->parametros, 0)))
            return;
        if (chk_array($this->parametros, 1) == 'edit')
            return;
        if (is_numeric(chk_array($this->parametros, 2)))
            return;
        $id = chk_array($this->parametros, 0);
        foreach ($_POST as $key => $value) {
            if($key != 'assoc_id')
                // Sem campos em branco
                if (empty($value)) {
                    // Configura a mensagem
                    $this->form_msg = '<p class="form_error">There are empty fields. Data has not been sent.</p>';
                    return;
                }
        }
        // Tenta enviar a imagem
        $imagem = $this->upload_imagem();
        unset($_POST['insere_table']);
        // Insere a imagem em $_POST
        $_POST[$this->table_image] = $imagem;
        $_POST['assoc_id'] = $id;
        // Insere os dados na base de dados
        $query = $this->db->insert($this->table, $_POST);
        // Verifica a consulta
        if ($query){
            // Retorna uma mensagem
            $this->form_msg = '<p class="success">'.$this->table.' atualizada com sucesso!</p>';
            $this->goto_page($this->uri.$id);
            return;
        }
        $this->form_msg = '<p class="error">Erro ao enviar dados!</p>';
    }
    
    public function obtem_table() {
        //verifica se o primeiro ]e um numero (id da assoc)
        if (!is_numeric(chk_array($this->parametros, 0)))
            return;
        // Verifica se o primeiro parâmetro é "edit"
        if (chk_array($this->parametros, 1) != 'edit') {
            return;
        }
        $id = chk_array($this->parametros, 0);
        $this->form_msg = '<p class="alert">A atualizar</p>';
        // Verifica se o segundo parâmetro é um número
        if (!is_numeric(chk_array($this->parametros, 2)))
            return;
        // Configura o ID da table
        $tableId = chk_array($this->parametros, 2);
        if ('POST' == $_SERVER['REQUEST_METHOD'] && !empty($_POST['insere_table'])) {
            // Remove o campo insere_table para não gerar problemas com o PDO
            unset($_POST['insere_table']);
            // Tenta enviar a imagem
            $imagem = $this->upload_imagem();
            // Verifica se a imagem foi enviada
            if ($imagem) {
                // Adiciona a imagem no $_POST
                $_POST[$this->table_image] = $imagem;
            }
            $_POST['assoc_id'] = $id;
            // Atualiza os dados
            print_r($_POST);
            $query = $this->db->update($this->table, $this->table_id, $tableId, $_POST);
            // Verifica a consulta
            if ($query) {
                // Retorna uma mensagem
                $this->form_msg = '<p class="success">'.$this->table.' atualizado com sucesso!</p>';
                //Refresh
                //$this->goto_page($this->uri.$id);
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
        print_r($this->form_data);
    }// obtem_table
}// MainModel

?>