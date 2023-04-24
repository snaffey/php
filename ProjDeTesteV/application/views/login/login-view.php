<div class="banner">
    <div class="grid">
        <div class="line login"></div>
        <div>
            <p>Login</p>
            <form action="<?php echo HOME_URI; ?>login/" method="post">
                <input type="text" name="username" placeholder="Username"><br>
                <input type="password" name="password" placeholder="Password"><br>
                <?php if ($nextPage != null): ?>
                    <input type="hidden" name="nextPage" value="<?php echo $nextPage; ?>">
                <?php endif; ?>
                <?php if($this->msg != null): ?>
                    <div class="msgs">
                        <p><small style="color:<?php echo ($this->msg[1] == 'success') ? 'green' : 'red';?>;"><?php echo $this->msg[0]; ?></small></p>
                    </div>
                <?php endif; ?>
                <input type="submit" value="Login">
            </form>
        </div>
    </div>
</div>
