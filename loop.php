<?php
/**
 * @package WordPress
 * @subpackage Megumi
**/
?><article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'megumi' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
	<?php if ( get_action( 'megumi_entry_header_meta' ) ) { ?>
		<?php if ( in_array( $post->post_type, megumi_post_type() ) ) { ?>
			<div class="entry-meta">
				<?php megumi_entry_header_meta(); ?>
			</div><!-- .entry-meta -->
		<?php } ?>
	<?php } ?>
	</header><!-- .entry-header -->
	<?php if ( is_home() || is_front_page() || is_archive() || is_tax() || is_search() ) { // Only display Excerpts for search pages ?>
	<div class="entry-summary">
		<?php if ( has_post_thumbnail() ) { ?>
			<p class="thumb"><a href="<?php echo get_permalink(); ?>" title="<?php printf( __( 'Permanent Link to %s', 'megumi' ), get_the_title() ); ?>"><?php echo get_the_post_thumbnail(); ?></a></p>
		<?php } ?>
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php } else { ?>
	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'megumi' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
	<?php } ?>
	<?php if ( get_post_type() == 'page' && !comments_open() ) { ?>
	<?php } else { ?>
		<?php if ( get_action( 'megumi_entry_footer_meta' ) ) { ?>
			<footer class="entry-meta">
				<?php megumi_entry_footer_meta(); ?>
				<?php edit_post_link( __( 'Edit', 'megumi' ), '<span class="sep"></span> <span class="edit-link">', '</span>' ); ?>
			</footer><!-- #entry-meta -->
		<?php } ?>
	<?php } ?>
</article><!-- #post-<?php the_ID(); ?> -->
