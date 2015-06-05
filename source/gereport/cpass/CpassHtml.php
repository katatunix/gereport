<script type="text/javascript">
	$(document).ready(function() {
		$('#<?= $this->info->oldKey() ?>').focus();
	});
</script>

<h2><?= $this->title ?></h2>

<?php if ($this->info->message()) { ?>
	<p class="<?= $this->info->success() ? 'infoMessage' : 'errorMessage' ?>">
		<?= $this->info->message() ?>
	</p>
<?php } ?>

<form method="post" action="">
	<table cellspacing="10">
		<tr>
			<td align="right">Current password</td>
			<td><input type="password" name="<?= $this->info->oldKey() ?>" id="oldPassword" class="memberInfoTextBox" value="" /></td>
		</tr>
		<tr>
			<td align="right">New password</td>
			<td><input type="password" name="<?= $this->info->newKey() ?>" class="memberInfoTextBox" value="" /></td>
		</tr>
		<tr>
			<td align="right">Confirm password</td>
			<td><input type="password" name="<?= $this->info->confirmKey() ?>" class="memberInfoTextBox" value="" /></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" value="Save" /></td>
		</tr>
	</table>
</form>
