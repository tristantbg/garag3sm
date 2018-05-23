<?php if ($posts->count() > 0 && in_array($page->intendedTemplate(), ['post', 'product'])): ?>
	<?php if ($page->hasPrevVisible() && $prev = $page->prevVisible()): ?>
		<a id="previous-post" href="<?= $prev->url() ?>" data-target>
			<div>
				<div class="serif condensed upper text">Previous<br>article</div>
				<div class="tiny sans-serif mt1"><?= $prev->headerTitle() ?></div>
			</div>
		</a>
	<?php else: ?>
		<a id="previous-post" href="<?= $posts->last()->url() ?>" data-target>
			<div>
				<div class="serif condensed upper text">Previous<br>article</div>
				<div class="tiny sans-serif mt1"><?= $posts->last()->headerTitle() ?></div>
			</div>
		</a>
	<?php endif ?>
<?php endif ?>