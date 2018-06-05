<?php snippet('header') ?>

<?php $sizes = ['small', 'medium', 'large', 'xl'] ?>
<?php $pos = ['top', 'middle', 'bottom'] ?>

<div id="posts">
	<?php foreach ($posts as $key => $post): ?>
	
		<?php if($post->featured()->isNotEmpty() && $featured = $post->featured()->toFile()): ?>
	
			<a class="post-item <?= $featured->orientation() ?> <?= $pos[array_rand($pos)] ?> <?= e($post->size()->empty() || $post->size() == 'random', $sizes[array_rand($sizes)], $post->size()) ?>" href="<?= $post->url() ?>" data-target>
				<?php 
				$srcset = '';
				$src = $featured->width(1000)->url();
				for ($i = 500; $i <= 2000; $i += 500) $srcset .= $featured->width($i)->url() . ' ' . $i . 'w,';
				if ($post->videoToggle()->bool()) {
					$title = '<span class="sans-serif bold">'.$post->title()->html().'</span>';
					if($post->author()->isNotEmpty()) {
						$author = $post->author()->html();
						$title .= '<br>by '.$author;
					}
				} else {
					$title = '<span class="sans-serif bold">'.$post->title()->html().'</span>';
				}
				?>
				<div class="ph" style="padding-bottom: <?= number_format(100 / $featured->ratio(), 5, '.', '') ?>%"></div>
				<img class="lazy lazyload lazypreload" 
				data-src="<?= $src ?>" 
				data-srcset="<?= $srcset ?>" 
				data-sizes="auto" 
				data-optimumx="1.5" 
				width="100%" height="auto" />
				<div class="post-infos">
					<div class="inner">
						<div class="tiny sans-serif"><?= $post->date("d.m.Y").' — '.ucwords($post->category()) ?></div>
						<div><?= $title ?></div>
					</div>
				</div>
			</a>
	
		<?php endif ?>
	
	<?php endforeach ?>

</div>

<?php if ($posts->count() == 0): ?>
	<div class="no-content title"><span>No posts yet</span></div>
<?php endif ?>

<?php if($posts->pagination() && $posts->pagination()->hasPages() && $posts->pagination()->hasNextPage()): ?>
<!-- pagination -->
<nav id="pagination">

  <?php if($posts->pagination()->hasNextPage()): ?>
  <a class="next" href="<?php echo $posts->pagination()->nextPageURL() ?>"><h2>Next</h2></a>
  <?php endif ?>

  <?php if($posts->pagination()->hasPrevPage()): ?>
  <a class="prev" href="<?php echo $posts->pagination()->prevPageURL() ?>"><h2>Previous</h2></a>
  <?php endif ?>

</nav>
<!-- <div class="ajax-loading"><div class="button infinite-scroll-request">Loading</div></div> -->
<?php endif ?>


<?php snippet('footer') ?>