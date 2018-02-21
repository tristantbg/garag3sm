<?php snippet('header') ?>

<div id="page-header">
	<h1 class="title ls-narrow"><?= $page->title()->html() ?></h1>
</div>

<?php if ($page->text()->isNotEmpty()): ?>
	<div id="page-text" class="row contained narrow lead">
		<?= $page->text()->kt() ?>
	</div>
<?php endif ?>

<?php snippet('footer') ?>