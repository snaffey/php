<div class="banner">
    <div class="grid">
        <div class="line"></div>
        <div>
            <p>Editar Evento</p>
            <form action="" method="post">
                <input type="text" name="titulo" placeholder="Titulo" value="<?php echo $titulo ?? ""; ?>"><br>
                <input type="date" name="data" placeholder="Data" value="<?php echo $data ?? ""; ?>"><br>
                <textarea placeholder="Conteudo" name="conteudo"><?php echo $conteudo ?? ""; ?></textarea><br>
                <input type="hidden" name="assocId" value="<?php echo $assocId ?? "0"; ?>">
                <?php if ($nextPage != null): ?>
                    <input type="hidden" name="nextPage" value="<?php echo $nextPage; ?>">
                <?php endif; ?>
                <?php if($this->msg != null): ?>
                    <div class="msgs">
                        <p><small style="color:<?php echo ($this->msg[1] == 'success') ? 'green' : 'red';?>;"><?php echo $this->msg[0]; ?></small></p>
                    </div>
                <?php endif; ?>
                <input type="submit" value="Guardar">
                <?php //todo remover este estilo quando for estilizar ?>
                <a class="cancel" " href="<?php echo HOME_URI . 'evento/' . $id;?>">Cancel</a>
            </form>
        </div>
    </div>
</div>