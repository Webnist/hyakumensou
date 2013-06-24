<?php
/**
 * @package WordPress
 * @subpackage Megumi
**/
?><?php get_header(); ?>
	<div id="container">
		<div id="content" role="main">
			<article id="post-0" class="post error404 not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'Not Found', 'megumi' ); ?></h1>
				</header>
				<div class="entry-content">
					<p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'megumi' ); ?></p>
					<?php get_search_form(); ?>
					<script type="text/javascript">
						document.getElementById('s') && document.getElementById('s').focus();
					</script>
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->
		</div><!-- #content -->
	</div><!-- #container -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>