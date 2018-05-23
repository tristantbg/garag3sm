<?php if ($posts->count() > 0 && in_array($page->intendedTemplate(), ['post', 'product'])): ?>
	<?php if ($page->hasNextVisible() && $next = $page->nextVisible()): ?>
		<a id="next-post" href="<?= $next->url() ?>" data-target>
			<div>
				<div class="serif condensed upper text">Next<br>article</div>
				<div class="tiny sans-serif mt1"><?= $next->headerTitle() ?></div>
			</div>
		</a>
	<?php else: ?>
		<a id="next-post" href="<?= $posts->first()->url() ?>" data-target>
			<div>
				<div class="serif condensed upper text">Next<br>article</div>
				<div class="tiny sans-serif mt1"><?= $posts->first()->headerTitle() ?></div>
			</div>
		</a>
	<?php endif ?>
<?php endif ?>