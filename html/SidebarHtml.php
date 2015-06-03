<ul>
	<?php
	foreach ($this->projects as $project)
	{
	?>
		<li><a href="aaaaa?p=<?= $project['id'] ?>"><?= htmlspecialchars($project['name']) ?></a>
		</li>
	<?php
	}
	?>
</ul>
