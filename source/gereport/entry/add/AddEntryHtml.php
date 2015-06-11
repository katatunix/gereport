<h2><?= $this->title ?></h2>

<script type="text/javascript" src="<?= $this->config->resDirUrl() ?>js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		tinymce.init({
			selector: "#content",
			height: 400,
			plugins: [
				"advlist autolink lists link image charmap print preview anchor",
				"searchreplace visualblocks code fullscreen",
				"insertdatetime media table contextmenu paste"
			]
		});
	});
</script>

<?php foreach ($this->info->breadcrumb() as $bread) { ?>
	<a href="<?= $bread[1] ?>"><?= $bread[0] ?></a> /
<?php } ?>

<form method="post" action="">
	<br />
	<?php if ($msg = $this->info->message()) { ?>
		<p class="errorMessage"><?= $msg ?></p>
		<br />
	<?php } ?>
	<p><input type="text" name="<?= $this->info->titleKey() ?>" size="80" value="<?= htmlspecialchars($this->info->title()) ?>" /></p><br />
	<p><textarea name="<?= $this->info->contentKey() ?>" id="content"
				 class="reportTextArea"><?= htmlspecialchars($this->info->content()) ?></textarea></p>
	<br />
	<p>
		<input type="submit" value="Submit entry" />
	</p>
</form>
