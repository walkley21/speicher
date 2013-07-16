<div class="sidebar right">
	
	<?php if ( !dynamic_sidebar( 'sidebar-widget' ) ) : ?>

	<div class="rss">
		<a href="#" id="rss">RSS</a>
		<form method="get" id="searchform" action="">
			<input type="text" value="Search Site" name="s" id="s" onfocus="if (this.value == 'Search Site') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Search Site';}" />
		</form>
		<input type="text" value="Subscribe By Email" id="rssemail" name="email" onfocus="if (this.value == 'Subscribe By Email') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Subscribe By Email';}" />
	</div>	
	
	<h3>Your Widget Here</h3>
	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
	
	<h3>Categories</h3>
		<ul>
			<li><a href="#">Architecture</a> (8)</li>
			<li><a href="#">Buying</a> (83)</li>
			<li><a href="#">Closing</a> (11)</li>
			<li><a href="#">Condos</a> (13)</li>
			<li><a href="#">Contracts</a> (5)</li>
			<li><a href="#">Development</a> (11)</li>
		</ul>
	
	<h3>Your Widget Here</h3>
	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
	
	<?php endif; ?>
	
	<br class="clear"/>

</div>