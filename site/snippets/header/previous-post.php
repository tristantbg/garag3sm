<?php if ($posts->count() > 0 && in_array($page->intendedTemplate(), ['post', 'product'])): ?>
	<?php if ($page->hasPrevVisible() && $prev = $page->prevVisible()): ?>
		<a id="previous-post" href="<?= $prev->url() ?>" data-target>Previous article</a>
	<?php else: ?>
		<a id="previous-post" href="<?= $posts->last()->url() ?>" data-target>Previous article</a>
	<?php endif ?>
<?php endif ?>