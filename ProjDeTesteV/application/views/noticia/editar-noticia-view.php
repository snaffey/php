<div class="banner">
    <div class="grid">
        <div class="line"></div>
        <div>
            <p>Editar Noticia</p>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="grid">
                    <div class="col">
                        <input type="text" name="titulo" placeholder="Titulo" value="<?php echo $noticia->titulo; ?>"><br>
                        <textarea placeholder="Conteudo" name="conteudo" ><?php echo $noticia->conteudo; ?></textarea><br>
                    </div>
                    <div class="col">
                        <input type="file" name="imagem">
                    </div>
                </div>
                <?php if ($nextPage != null): ?>
                    <input type="hidden" name="nextPage" value="<?php echo $nextPage; ?>">
                <?php endif; ?>
                <?php if($this->msg != null): ?>
                    <div class="msgs">
                        <p><small style="color:<?php echo ($this->msg[1] == 'success') ? 'green' : 'red';?>;"><?php echo $this->msg[0]; ?></small></p>
                    </div>
                <?php endif; ?>
                <input type="submit" value="Guardar">
                <a class="sbmt-btn" href="<?php echo HOME_URI . 'noticia/' . $noticia->id;?>">Cancel</a>
            </form>
        </div>
    </div>
</div>