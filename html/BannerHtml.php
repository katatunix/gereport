<h1><a href="<?= $this->indexUrl ?>">GE Report</a></h1>
<h2>I love the way that you report</h2>

<div id="menu">
	<?php if ($this->username) { ?>
		<span id="hello">Hello, <?= htmlspecialchars($this->username) ?></span>
	<?php } ?>

	<a href="<?= $this->indexUrl ?>">Home</a> |
	<?php if ($this->username) { ?>
		<a href="<?= $this->optionsUrl ?>">Options</a> |
		<a href="<?= $this->logoutUrl ?>">Logout</a>
	<?php } else { ?>
		<a href="<?= $this->loginUrl ?>">Login</a>
	<?php } ?>
</div>
