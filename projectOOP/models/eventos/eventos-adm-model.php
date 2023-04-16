<?php

class eventosAdmModel extends MainModel {

    public $posts_por_pagina = 5;

    public function __construct($controller = null) {
        // Configura o DB (PDO)
        $this->db = $controller->db;

        // Configura o controlador
        $this->controller = $controller;

        // Configura os parâmetros
        $this->parametros = $this->controller->parametros;

        // Configura os dados do user
        $this->userdata = $this->controller->userdata;
    }

    public function listar_eventos() {

        // Configura as variáveis que vamos utilizar
        $id = $where = $query_limit = null;

        // Verifica se um parâmetro foi enviado para carregar uma notícia
        if (is_numeric(chk_array($this->parametros, 0))) {

            // Configura o ID para enviar para a consulta
            $id = array(chk_array($this->parametros, 0));

            // Configura a cláusula where da consulta
            $where = " WHERE idEvento = ? ";
        }

        // Configura a página a ser exibida
        $pagina = !empty($this->parametros[1]) ? $this->parametros[1] : 1;

        // A páginação inicia do 0
        $pagina--;

        // Configura o número de posts por página
        $posts_por_pagina = $this->posts_por_pagina;

        // O offset dos posts da consulta
        $offset = $pagina * $posts_por_pagina;

        /*
          Esta propriedade foi configurada no noticias-adm-model.php para
          prevenir limite ou paginação na administração.
         */
        if (empty($this->sem_limite)) {

		// Configura o limite da consulta
		 $query_limit = " LIMIT $offset,$posts_por_pagina ";
        }

        // Faz a consulta
        $query = $this->db->query(
                'SELECT * FROM eventos ' . $where . ' ORDER BY idEvento DESC' . $query_limit, $id
        );

        // Retorna
        return $query->fetchAll();
    }// listar_eventos

    public function obtem_eventos() {
        // Verifica se o primeiro parâmetro é "edit"
        if (chk_array($this->parametros, 0) != 'edit') {
            return;
        }

        // Verifica se o segundo parâmetro é um número
        if (!is_numeric(chk_array($this->parametros, 1))) {
            return;
        }

        // Configura o ID da evento
        $evento_id = chk_array($this->parametros, 1);

        /*
          Verifica se algo foi enviado e se vem do form que tem o campo
          insere_evento.

          Se verdadeiro, atualiza os dados conforme a requisição.
         */
		 // if 1
        if ('POST' == $_SERVER['REQUEST_METHOD'] && !empty($_POST['insere_evento'])) {

            // Remove o campo insere_evento para não gerar problemas com o PDO
            unset($_POST['insere_evento']);

            // Verifica se a data foi enviada
            $data = chk_array($_POST, 'dataExec');

            /*
              Inverte a data para os formatos dd-mm-aaaa hh:mm:ss
              ou aaaa-mm-dd hh:mm:ss
             */
            $nova_data = $this->inverte_data($data);

            // Adiciona a data no $_POST		
            $_POST['dataExec'] = $nova_data;

            // Tenta enviar a imagem
            $imagem = $this->upload_imagem();

            // Verifica se a imagem foi enviada
            if ($imagem) {
                // Adiciona a imagem no $_POST
                $_POST['imagem'] = $imagem;
            }

            // Atualiza os dados
            $query = $this->db->update('eventos', 'idEvento', $evento_id, $_POST);

	// Verifica a consulta
	if ($query) {
		// Retorna uma mensagem
		$this->form_msg = '<p class="success">evento atualizado com sucesso!</p>';
	}
        }// // end if 1
        // Faz a consulta para obter o valor
        $query = $this->db->query(
                'SELECT * FROM eventos WHERE idEvento = ? LIMIT 1', array($evento_id)
        );
        // Obtém os dados
        $fetch_data = $query->fetch();
        // Se os dados estiverem nulos, não faz nada
        if (empty($fetch_data)) {
            return;
        }
        // Configura os dados do formulário
        $this->form_data = $fetch_data;
    }// obtem_evento

    public function insere_evento() {
        /*
          Verifica se algo foi passado e se vem do form que tem o campo
          insere_evento.
         */
        if ('POST' != $_SERVER['REQUEST_METHOD'] || empty($_POST['insere_evento'])) {
            return;
        }

        /*
          Para evitar conflitos apenas inserimos valores se o parâmetro edit
          não estiver configurado.
         */
        if (chk_array($this->parametros, 0) == 'edit') {
            return;
        }

        if (is_numeric(chk_array($this->parametros, 1))) {
            return;
        }

        // Tenta enviar a imagem
        $imagem = $this->upload_imagem();
        // Verifica se a imagem foi enviada
        /* if (!$imagem) {
          return;
          } */
        // Remove o campo insere_notica para não gerar problema com o PDO
        unset($_POST['insere_evento']);
        // Insere a imagem em $_POST
        $_POST['imagem'] = $imagem;
        // Configura a data
        $data = chk_array($_POST, 'dataExec');
        $nova_data = $this->inverte_data($data);

        // Adiciona a data no POST
        $_POST['dataExec'] = $nova_data;

        // Insere os dados na base de dados
        $query = $this->db->insert('eventos', $_POST);

        // Verifica a consulta
        if ($query) {

            // Retorna uma mensagem
            $this->form_msg = '<p class="success">evento atualizada com sucesso!</p>';
            return;
        }
        $this->form_msg = '<p class="error">Erro ao enviar dados!</p>';
    }

// insere_noticia

    public function apaga_evento() {

        // O parâmetro del deverá ser enviado
        if (chk_array($this->parametros, 0) != 'del') {
            return;
        }

        // O segundo parâmetro deverá ser um ID numérico
        if (!is_numeric(chk_array($this->parametros, 1))) {
            return;
        }

        // Para excluir, o terceiro parâmetro deverá ser "confirma"
        if (chk_array($this->parametros, 2) != 'confirma') {

            // Configura uma mensagem de confirmação para o user
            $mensagem = '<p class="alert">Tem certeza que deseja apagar o evento?</p>';
            $mensagem .= '<p><a href="' . $_SERVER['REQUEST_URI'] . '/confirma/">Sim</a> | ';
            $mensagem .= '<a href="' . HOME_URI . '/eventos/adm/">Não</a></p>';

            // Retorna a mensagem e não excluir
            return $mensagem;
        }

        // Configura o ID da notícia
        $evento_id = (int) chk_array($this->parametros, 1);

        // Executa a consulta
        $query = $this->db->delete('eventos', 'idEvento', $evento_id);

        // Redireciona para a página de administração de eventos
        echo '<meta http-equiv="Refresh" content="0; url=' . HOME_URI . '/eventos/adm/">';
        echo '<script type="text/javascript">window.location.href = "' . HOME_URI . '/eventos/adm/";</script>';
    }

// apaga_noticia

    public function upload_imagem() {
        // Verifica se o ficheiro da imagem existe
        if (empty($_FILES['evento_imagem'])
			&& empty($_FILES['imagem'])) {
            return;
        }

        // Configura os dados da imagem
        $imagem = isset($_FILES['imagem']) ? $_FILES['imagem'] : $_FILES['evento_imagem'];
        // Nome e extensão
        $nome_imagem = strtolower($imagem['name']);
        $ext_imagem = explode('.', $nome_imagem);
        $ext_imagem = end($ext_imagem);
        $nome_imagem = preg_replace('/[^a-zA-Z0-9]/' , '', $nome_imagem);
        $nome_imagem .=  '_' . mt_rand() .
						 '.' . $ext_imagem;

        // Tipo, nome temporário, erro e tamanho
        $tipo_imagem = $imagem['type'];
        $tmp_imagem = $imagem['tmp_name'];
        $erro_imagem = $imagem['error'];
        $tamanho_imagem = $imagem['size'];

        // Os mime types permitidos
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

}

// NoticiasAdmModel