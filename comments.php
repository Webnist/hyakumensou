<?php
/**
 * @package WordPress
 * @subpackage Megumi
**/
?>
<?php if ( post_password_required() ) { ?>
<div id="comments">
<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'megumi' ); ?></p>
</div><!-- #comments -->
<?php } elseif ( have_comments() ) { ?>
<div id="comments">
	<h2 id="comments-title"><?php printf( _n( 'One Response to %2$s', '%1$s Responses to %2$s', get_comments_number(), 'megumi' ), number_format_i18n( get_comments_number() ), '<em>' . get_the_title() . '</em>' ); ?></h2>
	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { ?>
		<nav class="navigation">
			<p class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'megumi' ) ); ?></p>
			<p class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'megumi' ) ); ?></p>
		</nav> <!-- .navigation -->
	<?php } ?>
		<ol class="commentlist">
			<?php wp_list_comments( array( 'callback' => 'megumi_comment' ) ); ?>
		</ol>
	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { ?>
		<nav class="navigation">
			<p class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'megumi' ) ); ?></p>
			<p class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'megumi' ) ); ?></p>
		</nav> <!-- .navigation -->
	<?php }
	if ( ! comments_open() ) { ?>
<?php } ?>
</div><!-- #comments -->
<?php } ?>
<?php comment_form(); ?>
