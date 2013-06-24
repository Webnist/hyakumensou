<?php
/**
 * @package WordPress
 * @subpackage Megumi
**/
?><?php get_header(); ?>
		<section id="container"<?php echo megumi_side_on_class(); ?>>
			<div id="content" role="main">
				<?php if ( is_active_sidebar( 'first-front-page' ) ) { ?>
					<div id="first-front-page">
						<?php dynamic_sidebar( 'first-front-page' ); ?>
					</div><!-- #first-front-page -->
				<?php } elseif( get_action( 'first_front_page' ) ) { ?>
					<div id="first-front-page">
						<?php first_front_page(); ?>
					</div><!-- #first-front-page -->
				<?php } ?>
				<?php if ( is_active_sidebar( 'second-front-page' ) ) { ?>
					<div id="second-front-page">
						<?php dynamic_sidebar( 'second-front-page' ); ?>
					</div><!-- #second-front-page -->
				<?php } elseif( get_action( 'second_front_page' ) ) { ?>
					<div id="second-front-page">
						<?php second_front_page(); ?>
					</div><!-- #second-front-page -->
				<?php } ?>
				<?php if ( is_active_sidebar( 'third-front-page' ) ) { ?>
					<div id="third-front-page">
						<?php dynamic_sidebar( 'third-front-page' ); ?>
					</div><!-- #third-front-page -->
				<?php } elseif( get_action( 'third_front_page' ) ) { ?>
					<div id="third-front-page">
						<?php third_front_page(); ?>
					</div><!-- #third-front-page -->
				<?php } ?>
				<?php if ( is_active_sidebar( 'fourth-front-page' ) ) { ?>
					<div id="fourth-front-page">
						<?php dynamic_sidebar( 'fourth-front-page' ); ?>
					</div><!-- #fourth-front-page -->
				<?php } elseif( get_action( 'fourth_front_page' ) ) { ?>
					<div id="fourth-front-page">
						<?php fourth_front_page(); ?>
					</div><!-- #fourth-front-page -->
				<?php } ?>
			</div><!-- #content -->
		</section><!-- #container -->
<?php if ( megumi_side_on() ) {
	get_sidebar();
} ?>
<?php get_footer(); ?>
