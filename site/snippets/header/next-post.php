<?php if ($posts->count() > 0 && in_array($page->intendedTemplate(), ['post', 'product'])): ?>
	<?php if ($page->hasNextVisible() && $next = $page->nextVisible()): ?>
		<a id="next-post" href="<?= $next->url() ?>" data-target>Next article</a>
	<?php else: ?>
		<a id="next-post" href="<?= $posts->first()->url() ?>" data-target>Next article</a>
	<?php endif ?>
<?php endif ?>