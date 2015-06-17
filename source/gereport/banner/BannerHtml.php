<div class="row">
	<div class="col-md-3 col-sm-12">
		<h1 id="logo"><a href="<?= $this->info->indexUrl() ?>">GE Report<span>2.0</span></a></h1>
	</div>
	<div class="col-md-6 col-sm-8">
		<nav>
			<ul class="nav nav-pills" id="menu">
				<li><a href="<?= $this->info->indexUrl() ?>"><i class="glyphicon glyphicon-home"></i> Home</a></li>

				<?php if ($username = $this->info->loggedMemberUsername()) { ?>
					<li><a href="<?= $this->info->optionsUrl() ?>"><i class="glyphicon glyphicon-user"></i> <?= $username ?></a></li>
					<li><a href="<?= $this->info->logoutUrl() ?>"><i class="glyphicon glyphicon-log-out"></i> Logout</a></li>
				<?php } else { ?>
					<li><a href="<?= $this->info->loginUrl() ?>"><i class="glyphicon glyphicon-log-in"></i> Login</a></li>
				<?php } ?>
			</ul>
		</nav>
	</div>

	<div class="col-md-3 col-sm-4">
		<form role="search">
			<input type="text" id="srch" class="form-control" placeholder="Search" />
		</form>
	</div>
</div>
