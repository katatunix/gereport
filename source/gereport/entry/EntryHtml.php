<?php foreach ($this->info->breadcrumb() as $bread) { ?>
	<a href="<?= $bread[1] ?>"><?= $bread[0] ?></a> /
<?php } ?>

<h2><?= $this->title ?></h2>

<p class="entryHeadline">Author: <?= htmlspecialchars($this->info->author()) ?> <?= $this->info->createdTime() ?></p>
<p class="entryHeadline">Last editor: <?= htmlspecialchars($this->info->editor()) ?> <?= $this->info->editedTime() ?></p>
<?php if ($this->info->canBeManupaled()) { ?>
	<br />
	<p class="entryHeadline">
		<a href="<?= $this->info->editUrl() ?>">Edit</a> |
		<a href="<?= $this->info->editUrl() ?>">Delete</a>
	</p>
<?php } ?>

<div class="reportContent">
<?= $this->info->content() ?>
</div>
