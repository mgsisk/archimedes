<ul class="sidebar small alignright">
	<?php if( !dynamic_sidebar() ) : ?>
	
	<li>
		<h2>Comic Buffer</h2>
		<p><?php the_comic_buffer(); ?></p>
	</li>
	
	<li>
		<h2>Bookmark Comic</h2>
		<p><?php bookmark_comic(); ?></p>
	</li>
	
	<li>
		<h2>Dropdown Comics</h2>
		<p><?php dropdown_comics(); ?></p>
	</li>
	
	<li>
		<h2>Random Comic</h2>
		<p><?php random_comic_link(); ?></p>
	</li>
	
	<li>
		<h2>Recent Comics</h2>
		<ul><?php recent_comics(); ?></ul>
	</li>
	
	<?php endif; ?>
</ul>