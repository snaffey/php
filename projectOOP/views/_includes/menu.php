<?php if (!defined('ABSPATH')) {
    exit;
} ?>

<?php
if ($this->login_required && !$this->logged_in) {
    return;
}
if ($this->logged_in) {
    echo "BemVindo: " . $this->user_name;
    ?>
    <a href="<?php echo HOME_URI; ?>/login/delete/">Logout</a>
<<<<<<< HEAD
    <?php } else {
    ?>
    <a href="<?php echo HOME_URI; ?>/login/">Login</a>
    <?php
}
?>
=======
    <?php } else {
        ?>
    <a href="<?php echo HOME_URI; ?>login/">Login</a>
    <?php
    }
?>
>>>>>>> 0b8ee74e0988d774852e8612b0a76bfb016f58b4

<nav class="menu clearfix">
    <ul>
        <li><a href="<?php echo HOME_URI; ?>">Home</a></li>

        <li><a href="<?php echo HOME_URI; ?>/user-register/">User Register</a></li>
		<li><a href="<?php echo HOME_URI; ?>/eventos/">eventos</a></li>
        <li><a href="<?php echo HOME_URI; ?>/eventos/adm/">eventos Adm</a></li>
		
    </ul>
</nav>