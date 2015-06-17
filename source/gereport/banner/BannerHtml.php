<div class="row">
	<div class="col-md-3 col-sm-12">
		<h1 id="logo"><a href="<?= $this->info->indexUrl() ?>">GE Report<span>2.0</span></a></h1>
	</div>
	<div class="col-md-6 col-sm-8">
		<nav>
			<ul class="nav nav-pills" id="menu">
				<?php $currentUrl = $this->info->currentUrl();
					$indexUrl = $this->info->indexUrl();
				?>
				<li class="<?= $currentUrl == $indexUrl ? 'active' : '' ?>">
					<a href="<?= $indexUrl ?>"><i class="glyphicon glyphicon-home"></i> Home</a>
				</li>

				<?php if ($username = $this->info->loggedMemberUsername()) {
					$optionsUrl = $this->info->optionsUrl();
					$logoutUrl = $this->info->logoutUrl();
				?>
					<li class="<?= $currentUrl == $optionsUrl ? 'active' : '' ?>">
						<a href="<?= $optionsUrl ?>"><i class="glyphicon glyphicon-user"></i> <?= $username ?></a>
					</li>

					<li class="<?= $currentUrl == $logoutUrl ? 'active' : '' ?>">
						<a href="<?= $logoutUrl ?>"><i class="glyphicon glyphicon-log-out"></i> Logout</a>
					</li>
				<?php } else {
					$loginUrl = $this->info->loginUrl();
				?>
					<li class="<?= $currentUrl == $loginUrl ? 'active' : '' ?>">
						<a href="<?= $loginUrl ?>"><i class="glyphicon glyphicon-log-in"></i> Login</a>
					</li>
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
