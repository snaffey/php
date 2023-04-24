<?php if($this->msg != null): ?>
    <div class="msgs">
        <p><small style="color:<?php echo ($this->msg[1] == 'success') ? 'green' : 'red';?>;"><?php echo $this->msg[0]; ?></small></p>
    </div>
<?php endif; ?>
<div class="banner">
    <h1><?php echo $titulo ?? '';?></h1>
    <p><?php echo $conteudo ?? '';?></p>
    <p>Data: <?php echo $data ?? '';?></p>
    <p>Associcão: <?php echo $assocNome ?? '';?></p>
    <form id="participar<?php echo $id; ?>" action="<?php echo HOME_URI . 'evento/participar'; ?>" method="post">
        <input type="hidden" name="eventoId" value="<?php echo $id; ?>">
    </form>
    <div class="grid">
        <div><a href="#" style="color: #1cc8a0" onclick="submit('#participar<?php echo $id ?? ''; ?>')">Participar</a></div>
        <?php if ($this->adm): ?>
                <div style="margin-left: 15px;"><a style="color: #1cc8a0" href="<?php echo HOME_URI . 'evento/editar/' . $id ?? ''; ?>">Editar</a></div>
                <div style="margin-left: 15px;"><a style="color: #1cc8a0" href="<?php echo HOME_URI . 'evento/apagar/' . $id ?? ''; ?>">Apagar</a></div>
        <?php endif; ?>
    </div>
</div>