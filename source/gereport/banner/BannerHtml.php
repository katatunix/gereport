<h1><a href="<?= $this->info->indexUrl() ?>">GE Report</a></h1>
<h2>I love the way that you report</h2>

<div id="menu">
	<?php if ($this->info->loggedMemberUsername()) { ?>
		<span id="hello">Hello, <?= htmlspecialchars($this->info->loggedMemberUsername()) ?></span>
	<?php } ?>

	<a href="<?= $this->info->indexUrl() ?>">Home</a> |
	<?php if ($this->info->loggedMemberUsername()) { ?>
		<a href="<?= $this->info->optionsUrl() ?>">Options</a> |
		<a href="<?= $this->info->logoutUrl() ?>">Logout</a>
	<?php } else { ?>
		<a href="<?= $this->info->loginUrl() ?>">Login</a>
	<?php } ?>
</div>