<?php

return function ($site, $pages, $page) {

	$posts = site()->index()->filterBy('template', 'in', ['post', 'product'])->visible();
	$posts = $posts->filterBy("category", $page->uid());

	return array(
		'posts' => $posts
	);
}

?>
