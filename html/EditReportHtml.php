<h2><?= $this->title ?></h2>

<script type="text/javascript" src="<?= $this->urlSource->getHtmlUrl() ?>js/tinymce/tinymce.min.js"></script>
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
	<b>Compose a new content for the report</b><br /><br />
	<p><textarea name="content" id="content" class="reportTextArea"><?= htmlspecialchars($this->content) ?></textarea></p>
	<?php if ($this->resultMessage) { ?>
		<br />
		<p class="<?= $this->isActionSuccess ? 'infoMessage' : 'errorMessage' ?>">
			<?= $this->resultMessage ?>
		</p>
	<?php } ?>
	<br />
	<p>
		<input type="submit" value="Save report" />
		<input type="button" value="Cancel" onclick="window.open('<?= $this->nextUrl ?>', '_self')" />
	</p>
</form>
