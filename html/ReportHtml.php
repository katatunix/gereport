<script type="text/javascript" src="<?= $this->urlSource->getHtmlUrl() ?>js/tinymce/tinymce.min.js"></script>

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

	function deleteReport(reportId) {
		if (confirm('ARE YOU SURE TO DELETE THIS REPORT?')) {
			var theForm = $('#formDelReport');
			theForm.find('[name=reportId]').val(reportId);
			theForm.submit();
		}
	}
</script>

<h2><?= $this->title ?></h2>

<form method="get" action="" class="datePicker">
	<input type="hidden" name="p" value="<?= $this->projectId ?>" />
	<input type="text" id="d" name="d" size="15" readonly value="<?= $this->date ?>" />
	<input type="submit" value="GO!" />
</form>

<?php if ($this->isAllowAddReport) { ?>
<br />
<form method="post" action="<?= $this->urlSource->getAddReportUrl() ?>">
	<input type="hidden" name="projectId" value="<?= $this->projectId ?>" />
	<input type="hidden" name="dateFor" value="<?= $this->date ?>" />
	<input type="hidden" name="nextUrl" value="<?= $this->currentUri ?>" />
	<b>Compose a report for this day</b><br /><br />
	<p><textarea name="content" id="reportContent" class="reportTextArea"></textarea></p>
	<?php if ($this->resultMessage) { ?>
		<div id="resultMessage">
			<br />
			<p class="<?= $this->isActionSuccess ? 'infoMessage' : 'errorMessage' ?>">
				<?= $this->resultMessage ?>
			</p>
		</div>
	<?php } ?>
	<br />
	<p><input type="submit" value="Submit report" /></p>
</form>
<?php } ?>

<?php foreach ($this->reports as $report) { ?>
	<br />
	<div class="reportHeaderReported">
		<?= htmlspecialchars($report['memberUsername']) ?>
		<i><?= $report['isPast'] ? '[past member]' : '' ?>
		at <?= $report['datetimeAdd'] ?></i>

		<?php if ($report['canDelete']) { ?>
			<div style="float: right">
				<a href="<?= $this->urlSource->getEditReportUrl() ?>?id=<?= $report['id'] ?>&next=<?=
						urlencode($this->currentUri) ?>">Edit</a> |
				<a href="javascript:deleteReport(<?= $report['id'] ?>)">Delete</a>
			</div>
		<?php } ?>
	</div>
	
	<div class="reportContent"><?= $report['content'] ?></div>
<?php } ?>

<?php foreach ($this->notReportedMembers as $username) { ?>
	<br />
	<p class="reportHeaderNotReported"><?= htmlspecialchars($username) ?></p>
	
	<p class="reportContent">No report</p>
<?php } ?>

<br />

<form id="formDelReport" method="post" action="<?= $this->urlSource->getDelReportUrl() ?>">
	<input type="hidden" name="reportId" />
	<input type="hidden" name="nextUrl" value="<?= $this->currentUri ?>" />
</form>
