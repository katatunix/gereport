<ul>
	<?php
	foreach ($this->info->projects() as $project)
	{
	?>
		<li><a href="<?= $project['url'] ?>"><?= htmlspecialchars($project['name']) ?></a>
		</li>
	<?php
	}
	?>
</ul>
