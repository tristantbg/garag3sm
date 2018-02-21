<footer id="post-sticky" class="contained caption">
	<div class="infos">
		<div class="sans-serif">
			<?= $page->title()->html() ?>
		</div>
		<?php if ($subtitle->isNotEmpty()): ?>
			<div><?= $subtitle ?></div>
		<?php endif ?>
	</div>
	<?php snippet('sharebuttons') ?>
	<div class="close-button">
		<a href="<?= site()->url() ?>" data-target>
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
			  <path d="M24 1.4L22.6 0 12 10.6 1.4 0 0 1.4 10.6 12 0 22.6 1.4 24 12 13.4 22.6 24l1.4-1.4L13.4 12z"/>
			</svg>
		</a>
	</div>
</footer>