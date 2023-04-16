<?php if (!defined('ABSPATH')) exit; ?>
<div class="wrap">
<?php
if ( $this->logged_in ) {
	echo '<p class="alert">Sessão ativa.</p>';
}
?>
	<p><a href="<?=HOME_URI?>/register/index/">Sing in</a></p>
	<form method="post">
		<table class="form-table">
			<tr>
				<td>User</td> 
				<td><input name="userdata[user]"></td>
			</tr>
			<tr>
				<td>Password </td>
				<td><input type="password" name="userdata[user_password]"></td>
			</tr>
			<? if ( $this->login_error ) {
				echo '<tr><td colspan="2" class="error">' . $this->login_error . '</td></tr>';
			} ?>
			<tr>
				<td colspan="2">
					<input type="submit" value="Enter"> 
				</td>
			</tr>
		</table>
	</form>
</div>