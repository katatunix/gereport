<script>
	$(function() {
		$('#username').focus();
	});
</script>

<h3><i class="glyphicon glyphicon-log-in"></i> <?= htmlspecialchars($this->title) ?></h3>

<?php if ($msg = $this->info->message()) { ?>
	<div class="alert alert-danger"><?= htmlspecialchars($msg) ?></div>
<?php } ?>

<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-6">
		<form role="form" method="post" action="">
			<div class="form-group">
				<label for="username">Username</label>
				<input type="text" class="form-control" id="username" name="<?= $this->info->usernameKey() ?>"
					value="<?= $this->info->username() ?>">
			</div>
			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" class="form-control" id="password" name="<?= $this->info->passwordKey() ?>">
			</div>
			<button type="submit" class="btn btn-primary btn-block">Login</button>
		</form>
	</div>
	<div class="col-md-3"></div>
</div>
