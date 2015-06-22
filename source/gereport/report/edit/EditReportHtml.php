<h3><i class="glyphicon glyphicon-edit"></i> <?= htmlspecialchars($this->title) ?></h3>

<form role="form" method="post" action="">
	<h4>Compose report content</h4>

	<?php if ($msg = $this->info->message()) { ?>
		<div class="alert alert-danger"><?= htmlspecialchars($msg) ?></div>
	<?php } ?>

	<div class="form-group">
		<textarea class="form-control" name="<?= $this->info->contentKey() ?>" id="content"><?= htmlspecialchars($this->info->content()) ?></textarea>
		<?php $this->editorView->render(); ?>
	</div>

	<button type="submit" class="btn btn-primary">Save report</button>
	<button type="button" class="btn btn-default" onclick="window.open('<?= htmlspecialchars($this->info->nextUrl()) ?>', '_self')">Cancel</button>
</form>
