<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width" />

	<!--[if lt IE 9]><script src="<?= $this->config->resDirUrl() ?>html5.js"></script><![endif]-->

	<link rel="stylesheet" href="<?= $this->config->resDirUrl() ?>bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" href="<?= $this->config->resDirUrl() ?>jstree/themes/default/style.min.css" />
	<link rel="stylesheet" href="<?= $this->config->resDirUrl() ?>docs.css" />

	<!--[if lt IE 9]><script src="<?= $this->config->resDirUrl() ?>respond.js"></script><![endif]-->

	<link rel="icon" href="<?= $this->config->resDirUrl() ?>favicon.ico" type="image/x-icon" />
	<link rel="apple-touch-icon-precomposed" href="<?= $this->config->resDirUrl() ?>apple-touch-icon-precomposed.png" />

	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?= $this->config->resDirUrl() ?>feed.xml" />

	<meta property="og:title" content="gereport" />
	<meta property="og:type" content="website" />
	<meta property="og:description" content="gereport is the report system for GE team" />
	<meta property="og:url" content="<?= $this->config->rootUrl() ?>" />
	<meta property="og:image" content="jstree.png" />

	<link rel="search" type="application/opensearchdescription+xml" href="<?= $this->config->resDirUrl() ?>opensearch.xml" title="Search jstree API" />

	<link href="<?= $this->config->resDirUrl() ?>jquery-ui/jquery-ui.css" rel="stylesheet" type="text/css" />

	<script src="<?= $this->config->resDirUrl() ?>jquery.min.js"></script>
	<script src="<?= $this->config->resDirUrl() ?>bootstrap/js/bootstrap.min.js"></script>
	<script src="<?= $this->config->resDirUrl() ?>jstree/jstree.min.js"></script>
	<script src="<?= $this->config->resDirUrl() ?>jquery-ui/jquery-ui.min.js"></script>
	<title><?= htmlspecialchars($this->title) ?></title>
</head>
<body>

<header id="head">
	<div class="container">
		<?php $this->banner->render(); ?>
	</div>
</header>

<div class="container">
	<div class="row page">
		<div class="col-md-3">
			<?php $this->sidebar->render(); ?>

		</div>
		<div class="col-md-9">
			<?php $this->content->render(); ?>
			<p class="text-center" style="margin-top: 20px">
				<a href="mailto:nghia.buivan@gameloft.com" class="btn btn-default btn-sm">nghia.buivan@gameloft.com</a>
			</p>
		</div>
	</div>
</div>

<a class="hidden-xs hidden-sm" href="https://github.com">
	<img style="position: absolute; top: 0; left: 0; border: 0;" src="<?= $this->config->resDirUrl() ?>forkme_left_green_007200.png" alt="Fork me on GitHub">
</a>

</body>
</html>
