<div id="menu">
	<div id="menu--title">
		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 105">
		  <path d="M391.7.3V66c0 21.4 18.6 38.7 53.7 38.7 34.2 0 54.4-16 54.6-38.9V.3h-26.7v63.3c-1.7 11.3-11.8 20.8-27.7 20.8-18.2 0-26.9-7.4-27-21.1V.3h-26.9zM264.2 102.5H291V37.7l57.3 64.8h25.4V.3h-27v64.4L289.6.3h-25.4v102.2zm-115.4 0h99.5V82h-72.8V60.2h67.6V39.7h-67.6v-19h72.8V.3h-99.5v102.2zM0 102.5h26.7V46.8l27.6 55.7h22.2L104.4 46v56.5H131V.3H99.7L65.6 69.8 31.1.3H0v102.2z"/>
		</svg>
	</div>
	<div id="menu--la-time">
		<div>
			<div class="time lead serif"></div>
			<div class="time-convention tiny bold upper"></div>
		</div>
	</div>
	<div id="menu--fr-time">
		<div>
			<div class="time lead serif"></div>
			<div class="time-convention tiny bold upper"></div>
		</div>
	</div>
	<div id="menu--categories">
		<ul class="text">
			<?php foreach (page('categories')->children()->visible() as $key => $c): ?>
				<li><a href="<?= $c->url() ?>" data-target><?= $c->title()->html() ?></a></li>
			<?php endforeach ?>
		</ul>
	</div>
	<div id="menu--links">
		<ul class="text">
			<?php foreach (site()->menu()->toStructure() as $key => $m): ?>
				<?php if ($p = $m->page()->toPage()): ?>
					<li><a href="<?= $p->url() ?>" data-target><?= $p->title()->html() ?></a></li>
				<?php endif ?>
			<?php endforeach ?>
		</ul>
		<ul id="socials" class="text">
			<?php foreach (site()->socials()->toStructure() as $key => $s): ?>
				<li><a href="<?= $s->url() ?>" data-target><?= $s->title()->html() ?></a></li>
			<?php endforeach ?>
		</ul>
	</div>
	<div id="menu--board">
		<?php foreach (site()->board()->toStructure() as $key => $item): ?>
			<div class="slide">
				<?php if ($item->title()->isNotEmpty()): ?>
				<div class="tiny sans-serif"><?= $item->title()->html() ?></div>
				<?php endif ?>
				<?php if ($item->text()->isNotEmpty()): ?>
				<div class="bold upper"><?= $item->text()->kt() ?></div>
				<?php endif ?>
				<?php if ($item->author()->isNotEmpty()): ?>
				<div class="author"><?= $item->author()->html() ?></div>
				<?php endif ?>
			</div>
		<?php endforeach ?>
	</div>
</div>