<script type="text/javascript">
	$(document).ready(function() {
		$('#d').datepicker({
			dateFormat: 'yy-mm-dd',
			showWeek: true,
			showOtherMonths: true,
			showButtonPanel: true,
			closeText: 'Close'
		});

		$('#formAddReport').submit(function() {
			$(this).find('[name=nextUrl]').val(window.location);
		});
	});

	function deleteReport(reportId) {
		if (confirm('ARE YOU SURE TO DELETE THIS REPORT?')) {
			$('[name=reportIdToDelete]').val(reportId);
			$('#deleteForm').submit();
		}
	}
</script>

<h2><?= $this->title ?></h2>

<form method="get" action="" class="datePicker">
	<input type="hidden" name="<?= self::PROJECT_ID ?>" value="<?= $this->projectId ?>" />
	<input type="text" id="d" name="<?= self::DATE_FOR ?>" size="15" readonly value="<?= $this->date ?>" />
	<input type="submit" value="GO!" />
</form>

<?php if ($this->isAllowAddReport) { ?>
<br />
<form id="formAddReport" method="post" action="<?= $this->urlSource->getAddReportUrl() ?>">
	<input type="hidden" name="projectId" value="<?= $this->projectId ?>" />
	<input type="hidden" name="dateFor" value="<?= $this->date ?>" />
	<input type="hidden" name="nextUrl" />
	Compose a report for this day<br /><br />
	<p><textarea name="content" id="reportContent" class="submitReportTextArea"></textarea></p>
	<?php if ($this->addReportResultMessage) { ?>
		<br />
		<p class="<?= $this->isAddReportSuccess ? 'infoMessage' : 'errorMessage' ?>">
			<?= $this->addReportResultMessage ?>
		</p>
	<?php } ?>
	<?php if ($this->deleteReportResultMessage) { ?>
		<br />
		<p class="<?= $this->isDeleteReportSuccess ? 'infoMessage' : 'errorMessage' ?>">
			<?= $this->deleteReportResultMessage ?>
		</p>
	<?php } ?>
	<br />
	<p><input type="submit" value="Submit report" /></p>
</form>
<?php } ?>

<?php foreach ($this->reports as $report) { ?>
	<br />
	<p class="reportHeaderReported">
		<?= htmlspecialchars($report['memberUsername']) ?>
		<i><?= $report['isPast'] ? '[past member]' : '' ?>
		at <?= $report['datetimeAdd'] ?></i>
	</p>
	<br />
	<p class="reportContent"><?= nl2br(htmlspecialchars($report['content'])) ?></p>
	<?php if ($report['canDelete']) { ?>
		<br />
		<div class="reportDeleteButton">
			<input type="button" value="Delete" onclick="deleteReport(<?= $report['id'] ?>)" />
		</div>
	<?php } ?>
<?php } ?>

<?php foreach ($this->notReportedMembers as $username) { ?>
	<br />
	<p class="reportHeaderNotReported"><?= htmlspecialchars($username) ?></p>
	<br />
	<p class="reportContent">No report</p>
<?php } ?>

<br />

<form id="deleteForm" method="post" action="">
	<input type="hidden" name="p" value="<?= $this->projectId ?>" />
	<input type="hidden" name="d" value="<?= $this->date ?>" />
	<input type="hidden" name="reportIdToDelete" />
</form>
