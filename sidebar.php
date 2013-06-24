<?php
/**
 * @package WordPress
 * @subpackage Megumi
**/
?><div id="first-side" class="widget_area" role="complementary">
<?php if ( ! dynamic_sidebar( 'first-side-widget-area' ) ) { ?>
			<?php first_side_widget_area(); ?>
<?php } // end primary widget area ?>
		</div><!-- #side-primary .widget-area -->
<?php if ( is_active_sidebar( 'second-side-widget-area' ) ) { ?>
	<div id="second-side" class="widget_area">
		<?php dynamic_sidebar( 'second-side-widget-area' ); ?>
	</div><!-- #secondary .widget-area -->
<?php } elseif( get_action( 'second_side_widget_area' ) ) { ?>
	<div id="second-side" class="widget_area">
		<?php second_side_widget_area(); ?>
	</div><!-- #secondary .widget-area -->
<?php } ?>
