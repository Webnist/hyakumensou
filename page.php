<?php
/**
 * @package WordPress
 * @subpackage Megumi
**/
?><?php get_header(); ?>
		<div id="container">
			<div id="content" role="main">
			<?php if ( have_posts() ) while ( have_posts() ) { the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
			<?php } // end of the loop. ?>
			</div><!-- #content -->
		</div><!-- #container -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>