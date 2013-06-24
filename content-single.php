<?php
/**
 * @package WordPress
 * @subpackage Megumi
**/
?>
<?php if ( get_action( 'megumi_entry_other_header' ) ) { ?>
	<?php megumi_entry_other_header(); ?>
<?php } ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php if ( get_action( 'megumi_entry_header_meta' ) ) { ?>
			<?php if ( in_array( $post->post_type, megumi_post_type() ) ) { ?>
				<div class="entry-meta">
					<?php megumi_entry_header_meta(); ?>
				</div><!-- .entry-meta -->
			<?php } ?>
		<?php } ?>
	</header><!-- .entry-header -->
	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( '<span>Pages:</span>', 'megumi' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
	<?php if ( get_action( 'megumi_entry_footer_meta' ) ) { ?>
		<footer class="entry-meta">
			<?php megumi_entry_footer_meta(); ?>
			<?php edit_post_link( __( 'Edit', 'megumi' ), '<span class="sep"></span> <span class="edit-link">', '</span>' ); ?>
		</footer><!-- #entry-meta -->
	<?php } ?>
</article><!-- #post-<?php the_ID(); ?> -->
<?php if ( get_action( 'megumi_entry_other_content' ) ) { ?>
	<?php megumi_entry_other_content(); ?>
<?php } ?>
