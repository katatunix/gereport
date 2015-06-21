<h3><i class="glyphicon glyphicon-file"></i> <?= htmlspecialchars($this->title) ?></h3>

<div class="row">
	<div class="col-md-6">
		<div class="text-right">Created by
			<span class="glyphicon glyphicon-user"></span>
			<span class="label label-primary"><?= $this->info->authorUsername() ?></span>
			<span class="glyphicon glyphicon-time"></span>
			<span class="label label-primary"><?= $this->info->createdTime() ?></span>
		</div>
	</div>
	<div class="col-md-6">
		<div class="text-right">Last edited by
			<span class="glyphicon glyphicon-user"></span>
			<span class="label label-primary"><?= $this->info->lastEditorUsername() ?></span>
			<span class="glyphicon glyphicon-time"></span>
			<span class="label label-primary"><?= $this->info->lastEditedTime() ?></span>
		</div>
	</div>
</div>

<div style="height: 20px"></div>

<div class="row">
	<div class="col-md-12">
		<div class="well"><?= $this->info->content() ?></div>
	</div>
</div>

<?php if ($this->info->canBeManuplated()) { ?>
<div class="row">
	<div class="col-md-12 text-right">
		<a href="<?= $this->info->editEntryUrl() ?>" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit"></span>
			Edit</a>
		<a href="<?= '#' ?>" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove"></span> Delete</a>
	</div>
</div>
<?php } ?>
