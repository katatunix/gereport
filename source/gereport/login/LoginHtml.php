<script type="text/javascript">
	$(document).ready(function() {
		$('#<?= $this->info->usernameKey() ?>').focus();
	});
</script>

<h2><?= $this->title ?></h2>

<?php
	if ($this->info->message())
	{
?>
		<p class="errorMessage"><?= htmlspecialchars($this->info->message()) ?></p>
		<br />
<?php
	}
?>

<form method="post" action="">
<table cellspacing="10">
	<tr>
		<td align="right">Username</td>
		<td><input type="text" class="memberInfoTextBox" name="<?= $this->info->usernameKey() ?>" id="username"
				   value="<?= htmlspecialchars($this->info->username()) ?>" /></td>
	</tr>
	<tr>
		<td align="right">Password</td>
		<td><input type="password" class="memberInfoTextBox" name="<?= $this->info->passwordKey() ?>" /></td>
	</tr>
	<tr>
		<td></td>
		<td><input type="submit" value="Let me in!" /></td>
	</tr>
</table>
</form>
