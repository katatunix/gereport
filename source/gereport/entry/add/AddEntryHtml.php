<h3><i class="glyphicon glyphicon-plus"></i> <?= htmlspecialchars($this->title) ?></h3>

<script type="text/javascript" src="<?= $this->config->resDirUrl() ?>tinymce/tinymce.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		tinymce.init({
			selector: "#content",
			height: 200,
			plugins: [
				"advlist autolink lists link image charmap print preview anchor",
				"searchreplace visualblocks code fullscreen",
				"insertdatetime media table contextmenu paste"
			]
		});
	});
</script>

<?php if ($msg = $this->info->message()) { ?>
	<div class="alert alert-danger"><?= htmlspecialchars($msg) ?></div>
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

	<button type="submit" class="btn btn-primary">Submit entry</button>
</form>
