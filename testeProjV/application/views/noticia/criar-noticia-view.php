<div class="banner">
    <div class="grid">
        <div class="line"></div>
        <div>
            <p>Nova Noticia</p>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="grid">
                    <div class="col">
                        <input type="text" name="titulo" placeholder="Titulo"><br>
                        <textarea placeholder="Conteudo" name="conteudo"></textarea><br>
                        <?php if (!$superAdm): ?>
                            <input type="hidden" name="associacaoId" value="<?php echo $assocId; ?>">
                        <?php else: ?>
                            <select name="associacaoId">
                                <?php echo $options; ?>
                            </select>
                        <?php endif; ?>
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
                <input type="submit" value="Criar evento">
                <?php if (!$this->superAdm): ?>
                    <a class="sbmt-btn" href="<?php echo HOME_URI . 'associacao/' . $assocId;?>">Cancel</a>
                <?php else: ?>
                    <a class="sbmt-btn" href="<?php echo HOME_URI . 'associacao/all'?>">Cancel</a>
                <?php endif; ?>
            </form>
        </div>
    </div>
</div>