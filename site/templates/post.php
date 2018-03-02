<?php snippet('header') ?>

<div id="post-header" class="row contained">
	<div id="post-date"><?= $date.' — ' ?><a href="<?= $category->url() ?>" data-target><?= $category->title() ?></a></div>
	<h1 class="title ls-narrow upper"><?= $title ?></h1>
</div>

<?php snippet('hero') ?>

<div class="row contained">
	<div id="post-description" class="row">
		<div class="align-left post-text"><?= $page->text()->kt() ?></div>
		<div id="post-captions" class="caption">
			<?php if ($page->caption()->isNotEmpty()): ?>
				<div class="sans-serif">
					<?= $page->caption()->kt() ?>
				</div>
			<?php endif ?>
			<?php foreach ($page->additionalCaptions()->toStructure() as $key => $c): ?>
				<div>
					<?php if ($c->title()->isNotEmpty()): ?>
					<div class="sans-serif">
						<?= $c->title()->html().':' ?>
					</div>
					<?php endif ?>
					<div>
						<?= $c->text()->kt() ?>
					</div>
				</div>
			<?php endforeach ?>
			<?php snippet('sharebuttons') ?>
		</div>
	</div>
</div>

<div id="post-sections" class="row">
	<?php foreach($page->sections()->toStructure() as $section): ?>
		<?php snippet('sections/' . $section->_fieldset(), array('data' => $section)) ?>
	<?php endforeach ?>
</div>

<?php snippet('post-sticky') ?>

<?php snippet('footer') ?>