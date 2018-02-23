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
			<?php 
			$srcset = '';
			$src = $image->width(1000)->url();
			for ($i = 1000; $i <= 3000; $i += 500) $srcset .= $image->width($i)->url() . ' ' . $i . 'w,';
			?>
			<img class="lazy lazyload" 
			data-src="<?= $src ?>" 
			data-srcset="<?= $srcset ?>" 
			data-sizes="auto" 
			data-optimumx="1.5" 
			alt="<?= $title.' - © '.$site->title()->html() ?>" height="100%" width="auto" />
			<noscript>
				<img src="<?= $src ?>" alt="<?= $title.' - © '.$site->title()->html() ?>" width="100%" height="auto" />
			</noscript>
			<div class="ph" style="padding-bottom: <?= 100 / $image->ratio() ?>%"></div>
		</div>
		<?php if ($image->caption()->isNotEmpty()): ?>
			<div class="caption sans-serif lh-normal"><?= $image->caption()->kt() ?></div>
		<?php endif ?>
	</section>
	<?php endif ?>
<?php endforeach ?>