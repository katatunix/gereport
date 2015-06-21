<script>
	$(function() {
		$('#old').focus();
	});
</script>

<h3><i class="glyphicon glyphicon-edit"></i> <?= htmlspecialchars($this->title) ?></h3>

<?php if ($msg = $this->info->message()) { ?>
	<div class="alert <?= $this->info->success() ? 'alert-success' : 'alert-danger' ?>">
		<?= htmlspecialchars($msg) ?>
	</div>
<?php } ?>

<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-6">
		<form role="form" method="post" action="">
			<div class="form-group">
				<label for="old">Current password</label>
				<input type="password" class="form-control" id="old" name="<?= $this->info->oldKey() ?>">
			</div>
			<div class="form-group">
				<label for="new">New password</label>
				<input type="password" class="form-control" id="new" name="<?= $this->info->newKey() ?>">
			</div>
			<div class="form-group">
				<label for="confirm">Confirm password</label>
				<input type="password" class="form-control" id="confirm" name="<?= $this->info->confirmKey() ?>">
			</div>
			<button type="submit" class="btn btn-primary btn-block">Save</button>
		</form>
	</div>
	<div class="col-md-3"></div>
</div>
