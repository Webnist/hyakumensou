<?php
/**
 * @package WordPress
 * @subpackage Megumi
**/
?><article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php if ( in_array( $post->post_type, megumi_post_type() ) ) : ?>
			<div class="entry-meta">
				<?php megumi_entry_header_meta(); ?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->
	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( '<span>Pages:</span>', 'megumi' ), 'after' => '</div>' ) ); ?>
		<?php edit_post_link( __( 'Edit', 'megumi' ), '<span class="edit-link">', '</span>' ); ?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
<?php if ( megumi_comments_view() ) {
	comments_template( '', true );
} ?>
