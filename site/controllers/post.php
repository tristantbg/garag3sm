<?php

return function ($site, $pages, $page) {
	if ($page->videoToggle()->bool()) {
		$title = $page->title()->html();
		if($page->author()->isNotEmpty()) {
			$subtitle = $page->author()->html();
			$title .= '<br>by '.$subtitle;
		}
	} else {
		$title = $page->title()->html();
		$subtitle = $page->subtitle()->html();
	}
	
	$date = $page->date("d.m.Y");
	$category = page("categories/".$page->category()->value());

	return array(
	'title' => $title,
	'subtitle' => $subtitle,
	'date' => $date,
	'category' => $category,
	'images' => $page->medias()->toStructure(),
	'posts' => site()->index()->filterBy('template', 'in', ['post', 'product'])->visible()
	);
}

?>
