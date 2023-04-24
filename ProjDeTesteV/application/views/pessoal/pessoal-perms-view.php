<div class="main perms-panel">
    <h1>Alterar as permições para <?php echo $username ;?></h1><br />
    <?php if($this->msg != null): ?>
        <div class="msgs">
            <p><small style="color:<?php echo ($this->msg[1] == 'success') ? 'green' : 'red';?>;"><?php echo $this->msg[0]; ?></small></p>
        </div>
    <?php endif; ?>
    <form action="<?php echo HOME_URI .'pessoal/edit/perms/'. $id;?>" method="post">
        <label for="">Admin: <input type="checkbox" name="Admin" value="1" <?php if (in_array('Admin', $permissions)) echo "checked"; ?>></label>
        <label for="">Gerir noticias: <input type="checkbox" name="Gerir-noticias" value="1" <?php if (in_array('Gerir-noticias', $permissions)) echo "checked"; ?>></label>
        <label for="">Gerir eventos: <input type="checkbox" name="Gerir-eventos" value="1" <?php if (in_array('Gerir-eventos', $permissions)) echo "checked"; ?>></label>
        <input type="submit" value="Guardar">
    </form>
</div>