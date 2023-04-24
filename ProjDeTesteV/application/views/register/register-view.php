<div class="banner">
    <div class="grid">
        <div class="line register"></div>
        <div>
            <p>User Register</p>
            <form action="<?php echo HOME_URI; ?>register/<?php echo $assocId;?>" method="post">
                <input type="text" name="username" placeholder="Username"><br>
                <input type="text" name="nome" placeholder="Nome"><br>
                <input type="text" name="email" placeholder="Email"><br>
                <input type="password" name="password" placeholder="Password"><br>
                <input type="password" name="rPassword" placeholder="Password repeat"><br>
                <p class="perms-title">Permissões:</p><br />
                <?php if ($superAdm): ?>
                    <label for="" class="perms">Admin: <input type="checkbox" name="Admin" value="1"></label>
                <?php endif; ?>
                <label for="" class="perms">Gerir noticias: <input type="checkbox" name="Gerir-noticias" value="1"></label>
                <label for="" class="perms">Gerir eventos: <input type="checkbox" name="Gerir-eventos" value="1"></label>
                <?php if($this->msg != null): ?>
                    <div class="msgs">
                        <p><small style="color:<?php echo ($this->msg[1] == 'success') ? 'green' : 'red';?>;"><?php echo $this->msg[0]; ?></small></p>
                    </div>
                <?php endif; ?>
                <br />
                <input type="submit" value="Register">
                <?php //todo remover este estilo quando for estilizar ?>
                <a class="cancel" href="<?php echo HOME_URI . 'associacao/' . $assocId;?>">Cancel</a>
            </form>
        </div>
    </div>
</div>
