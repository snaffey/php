<<<<<<< HEAD:projectOOP/views/eventos/eventos-adm-view.php
<?php
date_default_timezone_set('WET');
// Evita acesso direto a este ficheiro
if (!defined('ABSPATH'))
    exit;
// Configura as URLs
$adm_uri = HOME_URI . '/eventos/adm/';
$edit_uri = $adm_uri . 'edit/';
$delete_uri = $adm_uri . 'del/';
// Carrega o método para obter uma eventos
$modelo->obtem_eventos();
// Carrega o método para inserir uma eventos
$modelo->insere_evento();
// Carrega o método para apagar a eventos
$modelo->form_confirma = $modelo->apaga_evento();

// Remove o limite de valores da lista de eventos
$modelo->sem_limite = false;
// Número de posts por página
?>
<div class="wrap">
    <?php
    // Mensagem de configuração caso o user tente apagar algo
    echo $modelo->form_confirma;
    ?>
    <!-- Formulário de edição das eventos -->
=======
<?php
// Evita acesso direto a este ficheiro
if (!defined('ABSPATH')) {
    exit;
}
// Configura as URLs
$adm_uri = HOME_URI . '/projetos/adm/';
$edit_uri = $adm_uri . 'edit/';
$delete_uri = $adm_uri . 'del/';
// Carrega o método para obter uma projetos
$modelo->obtem_projetos();
// Carrega o método para inserir uma projetos
$modelo->insere_projeto();
// Carrega o método para apagar a projetos
$modelo->form_confirma = $modelo->apaga_projeto();

// Remove o limite de valores da lista de projetos
$modelo->sem_limite = false;
// Número de posts por página
?>
<div class="wrap">
    <?php
    // Mensagem de configuração caso o user tente apagar algo
    echo $modelo->form_confirma;
?>
    <!-- Formulário de edição das projetos -->
>>>>>>> 0b8ee74e0988d774852e8612b0a76bfb016f58b4:projectOOP/views/projetos/projetos-adm-view.php
    <form method="post" action="" enctype="multipart/form-data">
        <table class="form-table">
            <tr>
                <td>
                    Descricao: <br>
                    <input type="text" name="descricao" value="<?php
                echo htmlentities(chk_array($modelo->form_data, 'descricao') ?? '');
?>" />
                </td>
            </tr>
            <tr>
                <td>
                    Imagem: <br>
                    <input type="file" name="imagem" value="" />
                </td>
            </tr>
            <tr>
                <td>
                    Data: <br>
<<<<<<< HEAD:projectOOP/views/eventos/eventos-adm-view.php
                    <input type="text" name="dataExec" id="dataExec" value="<?php
                    $data = chk_array($modelo->form_data, 'dataExec');
                    if ($data && $data != '0000-00-00 00:00:00')
                        echo date('d-m-Y H:i:s', strtotime($data));
                    else
                        echo date('d-m-Y H:i:s');
                    ?>" />
=======
                    <input type="text" name="dataExec" value="<?php
$data = chk_array($modelo->form_data, 'dataExec');
if ($data && $data != '0000-00-00 00:00:00') {
    echo date('d-m-Y H:i:s', strtotime($data));
}
?>" />
>>>>>>> 0b8ee74e0988d774852e8612b0a76bfb016f58b4:projectOOP/views/projetos/projetos-adm-view.php
                </td>
            </tr>
            <tr>
                <td>
                    Link: <br>
                    <input type="text" name="link" value="<?php
echo htmlentities(chk_array($modelo->form_data, 'link') ?? '');
?>" />
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <?php echo $modelo->form_msg; ?>
                    <input type="submit" value="Save" />
                    <a href="<?php echo HOME_URI . '/eventos/adm'; ?>">New projet</a>
                </td>
            </tr>
        </table>
        <input type="hidden" name="insere_evento" value="1" />
    </form>
    <script>
        setInterval(function() {
            // Get the current date and time
            var now = new Date();
            var day = ('0' + now.getDate()).slice(-2);
            var month = ('0' + (now.getMonth() + 1)).slice(-2);
            var year = now.getFullYear();
            var hours = ('0' + now.getHours()).slice(-2);
            var minutes = ('0' + now.getMinutes()).slice(-2);
            var seconds = ('0' + now.getSeconds()).slice(-2);
            var currentTime = day + '-' + month + '-' + year + ' ' + hours + ':' + minutes + ':' + seconds;

<<<<<<< HEAD:projectOOP/views/eventos/eventos-adm-view.php
            // Set the updated time to the "Data" field
            document.getElementById('dataExec').value = currentTime;
        });
    </script>
    <!-- LISTA os eventos -->
    <?php 
	$lista = $modelo->listar_eventos(); ?>
    <h1>Lista de eventos</h1>
    <table id="tbl-evento" class="list-table">
=======
    <!-- LISTA os projetos -->
    <?php
    $lista = $modelo->listar_projetos(); ?>
    <h1>Lista de Projetos</h1>
    <table id="tbl-projeto" class="list-table">
>>>>>>> 0b8ee74e0988d774852e8612b0a76bfb016f58b4:projectOOP/views/projetos/projetos-adm-view.php
        <thead>
            <tr>
                <th>ID</th>
                <th>desc</th>
                <th>data</th>
                <th>link</th>
                <th>img</th>
                <th>edit</th>
            </tr>
        </thead>
        <tbody>
<<<<<<< HEAD:projectOOP/views/eventos/eventos-adm-view.php
<?php foreach ($lista as $evento): ?>
=======
<?php foreach ($lista as $projeto): ?>
>>>>>>> 0b8ee74e0988d774852e8612b0a76bfb016f58b4:projectOOP/views/projetos/projetos-adm-view.php
<tr>
	<td><a href="<?php echo HOME_URI ?>/eventos/index/<?php echo $evento['idEvento'] ?>"><?php echo $evento['idEvento'] ?></a></td>
	<td><?php echo $evento['descricao'] ?></td>
	<td><?php echo $evento['dataExec'] ?></td>
	<td><?php echo $evento['link'] ?></td>
	<td><p>
	<img src="<?php echo HOME_URI . '/views/_uploads/' . $evento['imagem']; ?>" width="30px">
			</p></td>
<td>
	<a href="<?php echo $edit_uri . $evento['idEvento'] ?>">
		Editar
	</a> 
	  &nbsp;&nbsp;
	<a href="<?php echo $delete_uri . $evento['idEvento'] ?>">
        Apagar
    </a>
 </td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>

    <?php //$modelo->paginacao();?>
</div> <!-- .wrap -->
