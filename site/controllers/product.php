<?php

return function ($site, $pages, $page) {
	if ($page->videoToggle()->bool()) {
		$title = $page->title()->html();
		$titleHeader = $title;
		if($page->author()->isNotEmpty()) {
			$subtitle = $page->author()->html();
			$title .= ' by '.$subtitle;
			$titleHeader .= '<br><span class="title ls-narrow"><small>By</small>'.$subtitle.'</span>';
		}
	} else {
		$title = $page->title()->html();
		$titleHeader = $title;
		$subtitle = $page->subtitle()->html();
	}
	
	$date = $page->date("d.m.Y");

	$categories = $page->category()->split(',');
	$categoriesOutput = '';
	foreach ($categories as $key => $c) {
		$category = $site->index()->findBy('uid', $c);
		$categoriesOutput .= '<a id="post-category" href="'.$category->url().'" data-target>'.$category->title().'</a>';
		if($key < count($categories) - 1) $categoriesOutput .= ', ';
	}

	return array(
	'title' => $title,
	'titleHeader' => $titleHeader,
	'subtitle' => $subtitle,
	'date' => $date,
	'categories' => $categoriesOutput,
	'images' => $page->medias()->toStructure(),
	'posts' => site()->index()->filterBy('template', 'in', ['post', 'product'])->visible()
	);
}

?>
