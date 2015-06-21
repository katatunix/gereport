<h3><i class="glyphicon glyphicon-cog"></i> <?= htmlspecialchars($this->title) ?></h3>

<div class="row">
	<div class="col-md-12">
		<div class="well">
			<form role="form" method="post" action="">
				<div class="form-group">
					<label for="subFolderName">Create new sub-folder</label>
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
					<label for="subFolderName">Rename this folder to</label>
					<input type="text" class="form-control" id="subFolderName" name="<?= $this->info->folderNameKey() ?>"
						value="<?= htmlspecialchars($this->info->folderName()) ?>"/>
				</div>
				<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-edit"></span> Rename</button>
				<input type="hidden" name="<?= $this->info->actionKey() ?>" value="<?= $this->info->actionRenameValue() ?>" />
			</form>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="well">
			<form role="form" method="post" action="">
				<button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span>
					Delete this folder</button>
				<input type="hidden" name="<?= $this->info->actionKey() ?>" value="<?= $this->info->actionDeleteValue() ?>" />
			</form>
		</div>
	</div>
</div>
