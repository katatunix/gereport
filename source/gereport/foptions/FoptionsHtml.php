<script>
	function deleteFolder() {
		if (confirm('WARNING: THIS WILL DELETE ALL SUB-FOLDERS AND ENTRIES OF THIS FOLDER!\nARE YOU SURE?')) {
			$('#formDeleteFolder').submit();
		}
	}
</script>

<h3><i class="glyphicon glyphicon-cog"></i> <?= htmlspecialchars($this->title) ?></h3>

<?php if ($msg = $this->info->message()) { ?>
	<div class="alert <?= $this->info->success() ? 'alert-success' : 'alert-danger' ?>">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<?= htmlspecialchars($msg) ?>
	</div>
<?php } ?>

<div class="row">
	<div class="col-md-12">
		<div class="well">
			<a href="<?= $this->info->addEntryUrl() ?>" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> New entry</a>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="well">
			<form role="form" method="post" action="">
				<div class="form-group">
					<label for="subFolderName">New sub-folder</label>
					<input type="text" class="form-control" id="subFolderName" name="<?= $this->info->folderNameKey() ?>"
						placeholder="Sub-folder name"/>
				</div>
				<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Create</button>
				<input type="hidden" name="<?= $this->info->actionKey() ?>" value="<?= $this->info->actionAddValue() ?>" />
			</form>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="well">
			<form role="form" method="post" action="">
				<div class="form-group">
					<label for="folderName">Rename this folder to</label>
					<input type="text" class="form-control" id="folderName" name="<?= $this->info->folderNameKey() ?>"
						value="<?= htmlspecialchars($this->info->folderName()) ?>"/>
				</div>
				<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-edit"></span> Save</button>
				<input type="hidden" name="<?= $this->info->actionKey() ?>" value="<?= $this->info->actionRenameValue() ?>" />
			</form>
		</div>
	</div>
</div>

<?php if ($this->info->isAllowDelete()) { ?>
<div class="row">
	<div class="col-md-12">
		<div class="well">
			<form role="form" method="post" action="" id="formDeleteFolder">
				<button type="button" class="btn btn-danger" onclick="deleteFolder()">
					<span class="glyphicon glyphicon-remove"></span> Delete this folder</button>
				<input type="hidden" name="<?= $this->info->actionKey() ?>" value="<?= $this->info->actionDeleteValue() ?>" />
			</form>
		</div>
	</div>
</div>
<?php } ?>
