<h2><?= $this->title ?></h2>

<script type="text/javascript" src="<?= $this->config->resDirUrl() ?>js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		tinymce.init({
			selector: "#content",
			height: 250,
			plugins: [
				"advlist autolink lists link image charmap print preview anchor",
				"searchreplace visualblocks code fullscreen",
				"insertdatetime media table contextmenu paste"
			]
		});
	});
</script>

<form method="post" action="">
	<?php if ($this->info->isShowingEditor()) { ?>
	<b>Compose a new content for the report</b><br /><br />
	<p><textarea name="<?= $this->info->contentKey() ?>" id="content" class="reportTextArea"><?= htmlspecialchars($this->info->content()) ?></textarea></p>
	<?php } ?>

	<?php if ($this->info->message()) { ?>
		<br />
		<p class="errorMessage"><?= $this->info->message() ?></p>
	<?php } ?>
	<br />
	<p>
		<?php if ($this->info->isShowingEditor()) { ?>
		<input type="submit" value="Save report" />
		<?php } ?>
		<input type="button" value="Cancel" onclick="window.open('<?= $this->info->nextUrl() ?>', '_self')" />
	</p>
</form>