<script type="text/javascript">
	$(document).ready(function() {
		$('#<?= $this->router->usernameKey() ?>').focus();
	});
</script>

<h2><?= $this->title ?></h2>

<?php
	if ($this->message)
	{
?>
		<p class="errorMessage"><?= htmlspecialchars($this->message) ?></p>
		<br />
<?php
	}
?>

<form method="post" action="">
<table cellspacing="10">
	<tr>
		<td align="right">Username</td>
		<td><input type="text" class="memberInfoTextBox" name="<?= $this->router->usernameKey() ?>" id="username"
				   value="<?= htmlspecialchars($this->username) ?>" /></td>
	</tr>
	<tr>
		<td align="right">Password</td>
		<td><input type="password" class="memberInfoTextBox" name="<?= $this->router->passwordKey() ?>" /></td>
	</tr>
	<tr>
		<td></td>
		<td><input type="submit" value="Let me in!" /></td>
	</tr>
</table>
</form>
