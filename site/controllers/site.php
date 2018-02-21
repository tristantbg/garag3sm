<?php

return function ($site, $pages, $page) {

	return array(
	'posts' => site()->index()->filterBy('template', 'in', ['post', 'product'])->visible()
	);
}

?>
