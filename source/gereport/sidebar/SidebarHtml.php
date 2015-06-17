<?php function renderEntry($entry) { ?>
	<li data-jstree='{ "icon" : "glyphicon glyphicon-file" }'><a href="<?= $entry['url'] ?>"><?= $entry['title'] ?></a></li>
<?php } ?>

<?php function renderFolder($folder) { ?>
	<li><?= $folder['name'] ?>
		<ul>
			<?php foreach ($folder['children'] as $item) {
				renderItem($item);
			} ?>
		</ul>
<?php } ?>

<?php function renderItem($item) {
	if ($item['isFolder']) {
		renderFolder($item);
	} else {
		renderEntry($item);
	}
} ?>

<div id="jstree1" class="demo">
	<ul>
		<?php $tree = $this->info->tree();
		foreach ($tree as $item) {
			renderItem($item);
		} ?>

	</ul>
</div>

<script>
	$(function () {
		$('#jstree1').jstree({'plugins':["wholerow"]});

		$('#jstree1').on("changed.jstree", function (e, data) {
			if (data.node && data.node.a_attr && data.node.a_attr.href.length > 1) {
				window.location = data.node.a_attr.href;
			}
		});
	});
</script>
