<h3><i class="glyphicon glyphicon-file"></i> <?= htmlspecialchars($this->title) ?></h3>

<div class="row">
	<div class="col-md-6">
		<div class="text-right">Created by
			<span class="glyphicon glyphicon-user"></span>
			<?= $this->info->authorUsername() ?>
			<span class="glyphicon glyphicon-time"></span>
			<?= $this->info->createdTime() ?>
		</div>
	</div>
	<div class="col-md-6">
		<div class="text-right">Last edited by
			<span class="glyphicon glyphicon-user"></span>
			<?= $this->info->lastEditorUsername() ?>
			<span class="glyphicon glyphicon-time"></span>
			<?= $this->info->lastEditedTime() ?>
		</div>
	</div>
</div>

<div style="height: 20px"></div>

<div class="row">
	<div class="col-md-12">
		<div class="well report"><?= $this->info->content() ?></div>
	</div>
</div>

<?php if ($this->info->canBeManuplated()) { ?>
<script>
	function gotoDeleteEntry(url) {
		if (confirm('ARE YOU SURE TO DELETE THIS ENTRY?')) {
			window.location = url;
		}
	}
</script>
<div class="row">
	<div class="col-md-12 text-right">
		<a href="<?= $this->info->editEntryUrl() ?>" class="btn btn-primary btn-sm">
			<span class="glyphicon glyphicon-edit"></span>
			Edit</a>
		<a href="javascript:gotoDeleteEntry('<?= htmlspecialchars($this->info->deleteEntryUrl()) ?>')" class="btn btn-danger btn-sm">
			<span class="glyphicon glyphicon-remove"></span>
			Delete</a>
	</div>
</div>
<?php } ?>
g