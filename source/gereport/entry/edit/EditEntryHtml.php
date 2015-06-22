<h3><i class="glyphicon glyphicon-edit"></i> <?= htmlspecialchars($this->title) ?></h3>

<script type="text/javascript" src="<?= $this->config->resDirUrl() ?>ckeditor/ckeditor.js"></script>
<script type="text/javascript">
	$(function() {
		CKEDITOR.replace('content', {
			'extraPlugins' : 'autogrow',
			'autoGrow_bottomSpace' : 50,
			'autoGrow_onStartup' : true
		});
	});
</script>

<?php if ($msg = $this->info->message()) { ?>
	<div class="alert <?= $this->info->success() ? 'alert-success' : 'alert-danger' ?>">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<?= htmlspecialchars($msg) ?>
	</div>
<?php } ?>

<form role="form" method="post" action="">
	<div class="form-group">
		<label for="title">Title</label>
		<input type="text" class="form-control" name="<?= $this->info->titleKey() ?>" id="title"
			   value="<?= htmlspecialchars($this->info->title()) ?>" />
	</div>

	<div class="form-group">
		<label for="content">Content</label>
		<textarea class="form-control" name="<?= $this->info->contentKey() ?>" id="content">
			<?= htmlspecialchars($this->info->content()) ?>
		</textarea>
	</div>

	<button type="submit" class="btn btn-primary">Save entry</button>
	<a href="<?= $this->info->entryUrl() ?>" class="btn btn-default">View entry</a>
</form>
