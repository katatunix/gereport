<script src="<?= $this->config->resDirUrl() ?>ckeditor/ckeditor.js"></script>
<script>
	CKEDITOR.replace('<?= $this->id ?>', {
		'extraPlugins' : 'autogrow,colorbutton,colordialog,justify',
		'autoGrow_bottomSpace' : 20,
		'autoGrow_onStartup' : true
	});
</script>
