<div class="share-buttons">
		<div class="sans-serif">Share this story:</div>
		<ul>
			<li>
				<a href="http://www.facebook.com/sharer.php?u=<?= rawurlencode ($page->url()); ?>" target="blank" title="Share on Facebook">
					Facebook
				</a>
			</li>
			<li>
				<a href="https://twitter.com/intent/tweet?source=webclient&text=<?= rawurlencode($site->title().' | '.$page->title()); ?>%20<?= rawurlencode($page->url()); ?>" target="blank" title="Tweet this">Twitter</a>
			</li>
			<li>
				<a href="https://pinterest.com/pin/create/button/?url=<?= rawurlencode ($page->url()); ?>&media=&description=<?= rawurlencode ($site->title().' | '.$page->title()); ?>" target="blank" title="Share on Pinterest">
					Pinterest
				</a>
			</li>
		</ul>

</div>