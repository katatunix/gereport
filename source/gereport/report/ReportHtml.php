<script type="text/javascript" src="<?= $this->config->resDirUrl() ?>ckeditor/ckeditor.js"></script>

<script type="text/javascript">
	$(function() {
		$('#d').datepicker({
			dateFormat: 'yy-mm-dd',
			showWeek: true,
			showOtherMonths: true,
			showButtonPanel: true,
			closeText: 'Close'
		});

		CKEDITOR.replace('content', {
			'extraPlugins' : 'autogrow',
			'autoGrow_bottomSpace' : 50,
			'autoGrow_onStartup' : true
		});
	});

	function deleteReport(reportId) {
		if (confirm('ARE YOU SURE TO DELETE THIS REPORT?')) {
			var theForm = $('#formDelReport');
			theForm.find('[name=<?= $this->info->deleteReportReportIdKey() ?>]').val(reportId);
			theForm.submit();
		}
	}
</script>

<h3><i class="glyphicon glyphicon-th-large"></i> <?= htmlspecialchars($this->title) ?></h3>

<div class="well">
<form role="form" class="form-inline" method="get" action="">
	<input type="hidden" name="<?= $this->info->projectIdKey() ?>" value="<?= $this->info->projectId() ?>" />
	<input type="text" id="d" name="<?= $this->info->dateKey() ?>" readonly value="<?= $this->info->date() ?>"
		   class="form-control input-lg" />
	<button type="submit" class="btn btn-primary btn-lg">GO!</button>
</form>
</div>

<?php if ($msg = $this->info->message()) { ?>
	<div class="alert <?= $this->info->success() ? 'alert-success' : 'alert-danger' ?>">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<?= htmlspecialchars($msg) ?>
	</div>
<?php } ?>

<?php if ($this->info->isAllowSubmittingReport()) { ?>
<form role="form" method="post" action="<?= $this->info->addReportUrl() ?>">
	<input type="hidden" name="<?= $this->info->addReportProjectIdKey() ?>" value="<?= $this->info->projectId() ?>" />
	<input type="hidden" name="<?= $this->info->addReportDateForKey() ?>" value="<?= $this->info->date() ?>" />
	<input type="hidden" name="<?= $this->info->addReportNextUrlKey() ?>" value="<?= htmlspecialchars($this->info->currentUrl()) ?>" />

	<h4>Compose a report</h4>
	<div class="form-group">
		<textarea class="form-control" name="<?= $this->info->addReportContentKey() ?>" id="reportContent"></textarea>
	</div>

	<button type="submit" class="btn btn-primary">Submit report</button>
</form>
<?php } ?>

<h4>Report status</h4>

<div class="row">
	<div class="col-md-12">
		<?php foreach ($this->info->reports() as $report) { ?>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4 class="panel-title"><span class="glyphicon glyphicon-user"></span> <?= htmlspecialchars($report['memberUsername']) ?>
						<small><?= $report['isVisitor'] ? '[visitor]' : '' ?>
							<span class="glyphicon glyphicon-time"></span> <?= $report['datetimeAdd'] ?></small></h4>
				</div>
				<div class="panel-body report">
					<?= $report['content'] ?>
					<?php if ($report['canBeManuplated']) { ?>
						<div style="float: right">
							<a title="Edit" href="<?= $report['editUrl'] ?>" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit"></span></a>
							<a title="Delete" href="javascript:deleteReport(<?= $report['id'] ?>)" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove"></span></a>
						</div>
					<?php } ?>

				</div>
			</div>
		<?php } ?>

		<?php foreach ($this->info->notReportedMemberUsernames() as $username) { ?>
			<div class="panel panel-danger">
				<div class="panel-heading">
					<h4 class="panel-title"><span class="glyphicon glyphicon-user"></span> <?= htmlspecialchars($username) ?></h4>
				</div>
				<div class="panel-body">
					No report
				</div>
			</div>
		<?php } ?>
	</div>
</div>

<form id="formDelReport" method="post" action="<?= $this->info->deleteReportUrl() ?>" style="display: none">
	<input type="hidden" name="<?= $this->info->deleteReportReportIdKey() ?>" />
	<input type="hidden" name="<?= $this->info->deleteReportNextUrlKey() ?>" value="<?= htmlspecialchars($this->info->currentUrl()) ?>" />
</form>
