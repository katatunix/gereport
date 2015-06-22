<script>
	function saveAndView() {
		$('#isSaveAndView').val('1');
		$('#theForm').submit();
	}
</script>

<h3><i class="glyphicon glyphicon-edit"></i> <?= htmlspecialchars($this->title) ?></h3>

<?php if ($msg = $this->info->message()) { ?>
	<div class="alert <?= $this->info->success() ? 'alert-success' : 'alert-danger' ?>">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<?= htmlspecialchars($msg) ?>
	</div>
<?php } ?>

<form role="form" method="post" action="" id="theForm">
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
		<?php $this->editorView->render(); ?>
	</div>

	<button type="submit" class="btn btn-primary">Save entry</button>
	<button type="button" class="btn btn-default" onclick="saveAndView()">Save and view</button>

	<input type="hidden" name="<?= $this->info->isSaveAndViewKey() ?>" value="0" id="isSaveAndView" />
</form>
