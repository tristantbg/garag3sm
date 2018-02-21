<section class="post-section section--quote row contained">
	<div class="lead">	
		<?= $data->get("first")->kt() ?>
	</div>
	<?php if ($data->get("caption")->isNotEmpty()): ?>
	<div class="caption">
		<?= $data->get("caption")->kt() ?>
	</div>
	<?php endif ?>
</section>