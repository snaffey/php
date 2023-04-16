<div class="banner">
    <p class="pmsg">Criar Associação</p><br />
    <form action="<?php echo HOME_URI . 'associacao/criar/'?>" method="post" enctype="multipart/form-data">
        <input type="text" name="nome" placeholder="Nome da associação!"><br /><br />
        <input type="text" name="morada" placeholder="Morada da associação!"><br /><br />
        <input type="text" name="nTelefone" placeholder="Telefone da associação!"><br /><br />
        <input type="text" name="nContribuinte" placeholder="Numero de contribuinte!"><br /><br />
        <input type="file" multiple="multiple" name="imgs[]"><br /><br />
        <?php if($this->msg != null): ?>
            <div class="msgs">
                <p><small style="color:<?php echo ($this->msg[1] == 'success') ? 'green' : 'red';?>;"><?php echo $this->msg[0]; ?></small></p>
            </div>
        <?php endif; ?>
        <input type="submit" value="Criar">
        <a class="cancel" href="<?php echo HOME_URI ;?>">Cancel</a>
    </form>
</div>