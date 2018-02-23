<?php snippet('header') ?>

<?php foreach ($posts as $key => $post): ?>

	<?php if($post->featured()->isNotEmpty() && $featured = $post->featured()->toFile()): ?>

		<a class="post-item" href="<?= $post->url() ?>" data-target>
			<div class="sans-serif"><?= $post->title()->html() ?></div>
			<br>
			<img src="<?= $featured->width(300)->url() ?>" alt="" width="300px">
		</a>

	<?php endif ?>

<?php endforeach ?>

<?php snippet('footer') ?>