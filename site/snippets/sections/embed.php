<section class="post-section section--embed row contained">
	<div>	
		<?= $data->get("first")->embed() ?>
	</div>
	<?php if ($data->get("caption")->isNotEmpty()): ?>
	<div class="caption">
		<?= $data->get("caption")->kt() ?>
	</div>
	<?php endif ?>
</section>