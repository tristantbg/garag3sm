<?php

return function ($site, $pages, $page) {

	$posts = site()->index()->filterBy('template', 'in', ['post', 'product'])->visible();

	if(param("category")) $posts = $posts->filterBy("category", param("category"));

	return array(
		'posts' => $posts
	);
}

?>
