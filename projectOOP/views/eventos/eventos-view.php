<?php
// Evita acesso direto a este ficheiro
if (!defined('ABSPATH'))
    exit;
?>

<div class="wrap">
    <?php
// Número de posts por página
//$modelo->posts_por_pagina = 10;
// Lista eventos
    $lista = $modelo->listar_eventos();
    ?>
    <h1>Lista de eventos</h1>
    <?php foreach ($lista as $evento): ?>

<!-- Título -->
<h1>
	<a href="<?php echo HOME_URI ?>/eventos/index/<?php echo $evento['idEvento'] ?>">
		<?php echo $evento['descricao'] ?>
	</a>
</h1>
        <?php
// Verifica se estamos a visualizar uma única evento
if (is_numeric(chk_array($modelo->parametros, 0))): // single
            ?>
<?php
   $this->prev_page = true;
	if ($this->prev_page) {
		?>
		<a href="<?php echo HOME_URI ?>/eventos/index/">Voltar</a>
    <?php } ?>
        <p>
	   <?php echo $modelo->inverte_data($evento['dataExec']); ?> | 
	   <?php echo $evento['dataExec']; ?> 
            </p>

            <p>
                <img src="<?php echo HOME_URI . '/views/_uploads/' . $evento['imagem']; ?>">
            </p>

            <?php echo $evento['link']; ?>

        <?php endif;  // single  ?>

    <?php endforeach; ?>

</div> <!-- .wrap -->
