<?php
/**
 * @package WordPress
 * @subpackage Megumi
**/
if ( ! is_active_sidebar( 'first-footer-widget-area' ) && ! is_active_sidebar( 'second-footer-widget-area' )	&& ! is_active_sidebar( 'third-footer-widget-area' ) && ! is_active_sidebar( 'fourth-footer-widget-area' ) && ! get_action( 'first_footer_widget_area' ) && ! get_action( 'second_footer_widget_area' )	&& ! get_action( 'third_footer_widget_area' ) && ! get_action( 'fourth_footer_widget_area' ) ) {
	return;
} ?>
<div id="footer-widget-area" role="complementary">
	<?php if ( is_active_sidebar( 'first-footer-widget-area' ) ) { ?>
		<div id="first" class="widget-area">
			<?php dynamic_sidebar( 'first-footer-widget-area' ); ?>
		</div><!-- #first .widget-area -->
	<?php } elseif ( get_action( 'first_footer_widget_area' ) ) { ?>
		<div id="first" class="widget-area">
			<?php first_footer_widget_area(); ?>
		</div><!-- #first .widget-area -->
	<?php } ?>
	<?php if ( is_active_sidebar( 'second-footer-widget-area' ) ) { ?>
		<div id="second" class="widget-area">
			<?php dynamic_sidebar( 'second-footer-widget-area' ); ?>
		</div><!-- #second .widget-area -->
	<?php } elseif ( get_action( 'second_footer_widget_area' ) ) { ?>
		<div id="second" class="widget-area">
			<?php second_footer_widget_area(); ?>
		</div><!-- #second .widget-area -->
	<?php } ?>
	<?php if ( is_active_sidebar( 'third-footer-widget-area' ) ) { ?>
		<div id="third" class="widget-area">
			<?php dynamic_sidebar( 'third-footer-widget-area' ); ?>
		</div><!-- #third .widget-area -->
	<?php } elseif ( get_action( 'third_footer_widget_area' ) ) { ?>
		<div id="third" class="widget-area">
			<?php third_footer_widget_area(); ?>
		</div><!-- #third .widget-area -->
	<?php } ?>
	<?php if ( is_active_sidebar( 'fourth-footer-widget-area' ) ) { ?>
		<div id="fourth" class="widget-area">
			<?php dynamic_sidebar( 'fourth-footer-widget-area' ); ?>
		</div><!-- #fourth .widget-area -->
	<?php } elseif ( get_action( 'fourth_footer_widget_area' ) ) { ?>
		<div id="fourth" class="widget-area">
			<?php fourth_footer_widget_area(); ?>
		</div><!-- #fourth .widget-area -->
	<?php } ?>
</div><!-- #footer-widget-area -->
