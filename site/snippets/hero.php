<?php if ($page->hasHero()): ?>
	<div id="post-hero" class="row">
	<?php if ($page->heroVideoToggle()->bool()): ?>
		<?php
		$options = array();
		if ($page->heroVideoThumbnail()->isNotEmpty() && $thumb = $page->heroVideoThumbnail()->toFile()) $options = array("thumb" => $thumb->width(2000)->url());
		?>
		<?= $page->heroVideoUrl()->embed($options) ?>
	<?php else: ?>
		<?php snippet('slider', array('medias' => $page->heroImages()->toStructure())) ?>
		<div class="row contained caption slider-caption sans-serif lh-normal"></div>
	<?php endif ?>
	</div>
<?php endif ?>