<?php get_header(); ?>
<div class="container">
	<div class="col-md-9">
		<h1 class="error">Whoops, 404!</h1>
		<p class="tagline">We're sorry, we can't find the page you're looking for.</p>
		<div class="form-wrapper">
			<form role="search" method="get" id="searchform" action="<?php bloginfo( 'url' ) ?>" >
				<input type="text" value="" name="s" id="s" placeholder="Search here!">
				<input type="submit" id="searchsubmit" value="Search" />
			</form>
		</div>
	</div>
	<div class="col-md-3">
		<?php dynamic_sidebar( '404 Error Page' ); ?>
	</div>
</div>

<?php get_footer(); ?>