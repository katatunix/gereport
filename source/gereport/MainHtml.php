<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?= htmlspecialchars($this->title) ?></title>
	<meta http-equiv="Content-Language" content="English" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<link href="<?= $this->config->resDirUrl() ?>css/style.css" rel="stylesheet" type="text/css" />
	<link href="<?= $this->config->resDirUrl() ?>jquery-ui/jquery-ui.css" rel="stylesheet" type="text/css" />

	<script type="text/javascript" src="<?= $this->config->resDirUrl() ?>js/jquery.js"></script>
	<script type="text/javascript" src="<?= $this->config->resDirUrl() ?>jquery-ui/jquery-ui.min.js"></script>
</head>
<body>
<div id="wrap">

	<div class="header">
		<?php $this->banner->render(); ?>
	</div>

	<div class="content">
		<?php $this->content->render(); ?>
	</div>

	<div class="navigation">
		<?php $this->sidebar->render(); ?>
	</div>

	<div style="clear: both;"></div>

	<div class="footer">
		<?php $this->footer->render(); ?>
	</div>

</div>
</body>
</html>
