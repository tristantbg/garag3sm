<?php snippet('header') ?>

<div id="post-header" class="row contained">
	<div id="post-date"><?= $date.' — ' ?><?= $categories ?></div>
	<h1 class="title ls-narrow"><?= $titleHeader ?></h1>
</div>

<?php snippet('hero') ?>

<div class="row mn-90vh">
	<div class="row contained">
		<div id="post-description" class="row">
			<div class="align-left post-text"><?= $page->text()->kt() ?></div>
			<div id="post-captions" class="caption">
				<?php if ($page->productID()->isNotEmpty()): ?>
				<div class="add-to-basket sans-serif upper">
					<a class="sr-add" href="javascript:sraddtocheckout(<?= $page->productID() ?>);">Buy this product</a>
				</div>
				<?php endif ?>
				<?php if ($page->caption()->isNotEmpty()): ?>
					<div id="main-caption" class="sans-serif">
						<?= $page->caption()->kt() ?>
					</div>
				<?php endif ?>
				<?php foreach ($page->additionalCaptions()->toStructure() as $key => $c): ?>
					<div class="additional-caption">
						<?php if ($c->title()->isNotEmpty()): ?>
						<div class="sans-serif">
							<?= $c->title()->html().':' ?>
						</div>
						<?php endif ?>
						<div class="serif">
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
</div>

<?php snippet('post-sticky') ?>

<?php snippet('footer') ?>