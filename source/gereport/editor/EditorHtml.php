<script src="<?= $this->config->resDirUrl() ?>ckeditor/ckeditor.js"></script>
<script>
	$(function() {
		CKEDITOR.replace('<?= $this->id ?>', {
			'extraPlugins' : 'autogrow',
			'autoGrow_bottomSpace' : 20,
			'autoGrow_onStartup' : true
		});
	});
</script>
