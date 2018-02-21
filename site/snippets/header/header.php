<header class="contained">
	<?php snippet("header/previous-post") ?>
	<div id="site-title">
		<a href="<?= $site->url() ?>" data-target>
			<h1><?= $site->title()->html() ?></h1>
			<?php snippet("logo") ?>
		</a>
	</div>
	<?php snippet("header/next-post") ?>
</header>