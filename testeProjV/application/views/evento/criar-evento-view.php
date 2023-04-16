<div class="banner">
    <div class="grid">
        <div class="line"></div>
        <div>
            <p>Novo Evento</p>
            <form action="" method="post">
                <input type="text" name="titulo" placeholder="Titulo"><br>
                <input type="date" name="data"><br>
                <textarea placeholder="Conteudo" name="conteudo"></textarea><br>
                <?php if (!$this->superAdm): ?>
                    <input type="hidden" name="assocId" value="<?php echo $assocId; ?>">
                <?php else: ?>
                    <select name="assocId">
                        <?php echo $options; ?>
                    </select><br>
                <?php endif; ?>
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
                    <a class="cancel" href="<?php echo HOME_URI . 'associacao/' . $assocId;?>">Cancel</a>
                <?php else: ?>
                    <a class="cancel" href="<?php echo HOME_URI . 'associacao/all/';?>">Cancel</a>
                <?php endif; ?>
            </form>
        </div>
    </div>
</div>