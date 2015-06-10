<script type="text/javascript" src="<?= $this->config->resDirUrl() ?>js/tinymce/tinymce.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		$('#d').datepicker({
			dateFormat: 'yy-mm-dd',
			showWeek: true,
			showOtherMonths: true,
			showButtonPanel: true,
			closeText: 'Close'
		});
		
		tinymce.init({
			selector: "#reportContent",
			height: 250,
			plugins: [
				"advlist autolink lists link image charmap print preview anchor",
				"searchreplace visualblocks code fullscreen",
				"insertdatetime media table contextmenu paste"
			]
		});
		
		setTimeout(function(){ $('#resultMessage').hide(1500); }, 3000);
	});
</script>

<h2><?= $this->title ?></h2>

<form method="get" action="" class="datePicker">
	<input type="hidden" name="<?= $this->info->projectIdKey() ?>" value="<?= $this->info->projectId() ?>" />
	<input type="text" id="d" name="<?= $this->info->dateKey() ?>" size="15" readonly value="<?= $this->info->date() ?>" />
	<input type="submit" value="GO!" />
</form>

<?php if ($this->info->isAllowSubmittingReport()) { ?>
<br />
<form method="post" action="<?= $this->info->addReportUrl() ?>">
	<input type="hidden" name="<?= $this->info->addReportProjectIdKey() ?>" value="<?= $this->info->projectId() ?>" />
	<input type="hidden" name="<?= $this->info->addReportDateForKey() ?>" value="<?= $this->info->date() ?>" />
	<input type="hidden" name="<?= $this->info->addReportNextUrlKey() ?>" value="<?= $this->info->currentUrl() ?>" />
	<b>Compose a report for this day</b><br /><br />
	<p><textarea name="<?= $this->info->addReportContentKey() ?>" id="reportContent" class="reportTextArea"></textarea></p>
	<?php if ($message = $this->info->message()) { ?>
		<div id="resultMessage">
			<br />
			<p class="<?= $this->info->success() ? 'infoMessage' : 'errorMessage' ?>">
				<?= $message ?>
			</p>
		</div>
	<?php } ?>
	<br />
	<p><input type="submit" value="Submit report" /></p>
</form>
<?php } ?>

<?php foreach ($this->info->reports() as $report) { ?>
	<br />
	<div class="reportHeaderReported">
		<?= htmlspecialchars($report['memberUsername']) ?>
		<i><?= $report['isPast'] ? '[visitor]' : '' ?>
		at <?= $report['datetimeAdd'] ?></i>

		<?php if ($report['canDelete']) { ?>
			<div style="float: right">
				<a href="<?= $report['editUrl'] ?>">Edit</a> |
				<a href="<?= $report['deleteUrl'] ?>">Delete</a>
			</div>
		<?php } ?>
	</div>
	
	<div class="reportContent"><?= $report['content'] ?></div>
<?php } ?>

<?php foreach ($this->info->notReportedMemberUsernames() as $username) { ?>
	<br />
	<p class="reportHeaderNotReported"><?= htmlspecialchars($username) ?></p>
	
	<p class="reportContent">No report</p>
<?php } ?>
