<?php foreach ($data->get("first")->toStructure() as $key => $image): ?>
	<?php if ($image = $image->toFile()): ?>
	<?php 
		if ($image->caption()->isNotEmpty()) {
			$caption = $image->caption()->escape();
		} else {
			$page = $image->page();
			$caption = $page->title()->escape().c::get('alt');
		}
	?>
	<section class="post-section section--image row contained">
		<div class="section--image--content <?= $image->orientation() ?>">
			<img class="lazy lazyload" data-src="<?= $image->thumb(c::get('thumbs-slider'))->url() ?>" alt="<?= $caption ?>" width="100%" />
			<div class="ph" style="padding-bottom: <?= 100 / $image->ratio() ?>%"></div>
			<noscript>
				<img src="<?= $image->thumb(c::get('thumbs-slider'))->url() ?>" alt="<?= $caption ?>" width="100%" />
			</noscript>
		</div>
		<?php if ($image->caption()->isNotEmpty()): ?>
			<div class="caption sans-serif lh-normal"><?= $image->caption()->kt() ?></div>
		<?php endif ?>
	</section>
	<?php endif ?>
<?php endforeach ?>