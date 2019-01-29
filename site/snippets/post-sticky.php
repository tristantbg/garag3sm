<footer id="post-sticky" class="contained caption">
	<?php snippet('sharebuttons') ?>
	<?php if ($page->productUrl()->isNotEmpty()): ?>
		<div class="add-to-basket sans-serif upper">
			<a href="<?= $page->productUrl() ?>">Buy this product</a>
		</div>
	<?php elseif ($page->intendedTemplate() == 'product' && $page->productID()->isNotEmpty()): ?>
		<div class="add-to-basket sans-serif upper">
			<a class="sr-add" href="javascript:sraddtocheckout(<?= $page->productID() ?>);">Buy this product</a>
		</div>
	<?php endif ?>
	<div class="infos">
		<div class="sans-serif">
			<?= $page->title()->html() ?>
		</div>
		<?php if ($subtitle->isNotEmpty()): ?>
			<div class="serif"><?= $subtitle ?></div>
		<?php endif ?>
	</div>
	<?php if ($page->intendedTemplate() != 'product' || $page->productID()->empty()): ?>
	<div class="navigation">
		<div class="sans-serif">
			Navigation
		</div>
		<div class="serif">
			<?php if ($page->hasPrevVisible() && $prev = $page->prevVisible()): ?>
				<a href="<?= $prev->url() ?>" data-target>
					Previous&nbsp;article
				</a>
			<?php else: ?>
				<a href="<?= $posts->last()->url() ?>" data-target>
					Previous&nbsp;article
				</a>
			<?php endif ?>
			<span> — </span>
			<?php if ($page->hasNextVisible() && $next = $page->nextVisible()): ?>
				<a href="<?= $next->url() ?>" data-target>
					Next&nbsp;article
				</a>
			<?php else: ?>
				<a href="<?= $posts->first()->url() ?>" data-target>
					Next&nbsp;article
				</a>
			<?php endif ?>
		</div>
	</div>
	<?php endif ?>
	<!-- <div class="close-button">
		<a href="<?= site()->url() ?>" data-target>
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
			  <path d="M24 1.4L22.6 0 12 10.6 1.4 0 0 1.4 10.6 12 0 22.6 1.4 24 12 13.4 22.6 24l1.4-1.4L13.4 12z"/>
			</svg>
		</a>
	</div> -->
</footer>