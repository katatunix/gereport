<div id="jstree1" class="demo">
	<ul>
		<li>Root node 1
			<ul>
				<li data-jstree='{ "icon" : "tree-icon.png" }'><a href="http://google.com">Suede</a></li>
				<li data-jstree='{ "icon" : "tree-icon.png" }'>custom icon URL</li>
				<li data-jstree='{ "opened" : true }'>initially open
					<ul>
						<li>Test folder
							<ul>
								<li data-jstree='{ "icon" : "glyphicon glyphicon-file" }'>Nghia Bui</li>
							</ul>
						</li>
					</ul>
				</li>
				<li>Kata learns to code
					<ul>
						<li data-jstree='{ "icon" : "glyphicon glyphicon-file", "selected" : true }'>Meat! is a new Git collaboration platform for web developers</li>
						<li data-jstree='{ "icon" : "glyphicon glyphicon-file" }'>Apple</li>
						<li data-jstree='{ "icon" : "glyphicon glyphicon-file" }'>Banana</li>
					</ul>
				</li>
				<li data-jstree='{ "icon" : "glyphicon glyphicon-leaf" }'>Custom icon class (bootstrap)</li>
			</ul>
		</li>
		<li>Root node 2</li>
	</ul>
</div>

<script>
	$(function () {
		$('#jstree1').jstree({'plugins':["wholerow"]});
	});
</script>

<?php
$tree = $this->info->tree();
var_dump($tree);
?>
