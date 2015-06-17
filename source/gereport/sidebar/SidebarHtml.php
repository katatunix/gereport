<?php function renderEntry($entry, $currentUrl) {
	$entryUrl = $entry['url'];
	$isActive = $entryUrl == $currentUrl;
?>
	<li data-jstree='{ "icon" : "glyphicon glyphicon-file" <?= $isActive ? ', "selected" : true' : '' ?> }'>
		<a href="<?= $entry['url'] ?>"><?= $entry['title'] ?></a>
	</li>
<?php } ?>

<?php function renderFolder($folder, $currentUrl) { ?>
	<li><?= $folder['name'] ?>
		<ul>
			<?php foreach ($folder['children'] as $item) {
				renderItem($item, $currentUrl);
			} ?>
		</ul>
<?php } ?>

<?php function renderItem($item, $currentUrl) {
	if ($item['isFolder']) {
		renderFolder($item, $currentUrl);
	} else {
		renderEntry($item, $currentUrl);
	}
} ?>

<div id="jstree1" class="demo">
	<ul>
		<?php $currentUrl = $this->info->currentUrl();
		foreach ($this->info->tree() as $item) {
			renderItem($item, $currentUrl);
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
