<section class="post-section section--quote row narrow contained">
	<div class="lead">	
		<?= $data->get("first")->kt() ?>
	</div>
	<?php if ($data->get("caption")->isNotEmpty()): ?>
	<div class="caption serif">
		<?= $data->get("caption")->kt() ?>
	</div>
	<?php endif ?>
</section>