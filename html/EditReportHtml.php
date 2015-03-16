<h2><?= $this->title ?></h2>

<form method="post" action="">
	Compose a new content of the report<br /><br />
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
