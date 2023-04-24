<div class="banner">
    <p class="pmsg">Editar Associação</p><br />
    <form action="<?php echo HOME_URI . 'associacao/editar/' . ($id ?? '');?>" method="post" enctype="multipart/form-data">
        <input type="text" name="nome" placeholder="Nome da associação!" value="<?php echo $nome ?? ''; ?>"><br /><br />
        <input type="text" name="morada" placeholder="Morada da associação!" value="<?php echo $morada ?? ''; ?>"><br /><br />
        <input type="text" name="nTelefone" placeholder="Telefone da associação!" value="<?php echo $telefone ?? ''; ?>"><br /><br />
        <input type="text" name="nContribuinte" placeholder="Numero de contribuinte!" value="<?php echo $nContribuinte ?? ''; ?>"><br /><br />
        <input type="file" multiple="multiple" name="imgs[]"><br /><br />
        <?php if($this->msg != null): ?>
            <div class="msgs">
                <p><small style="color:<?php echo ($this->msg[1] == 'success') ? 'green' : 'red';?>;"><?php echo $this->msg[0]; ?></small></p>
            </div>
        <?php endif; ?>
        <input type="submit" value="Guardar">
        <a class="cancel" href="<?php echo HOME_URI ;?>associacao/all/">Cancel</a>
    </form>
</div>