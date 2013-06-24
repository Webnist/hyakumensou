<?php

/* *** Posts & Pages ID Check *** */
add_filter( 'manage_posts_columns', 'manage_posts_columns' );
add_filter( 'manage_pages_columns', 'manage_posts_columns' );
add_action( 'manage_posts_custom_column', 'add_column', 10, 2 );
add_action( 'manage_pages_custom_column', 'add_column', 10, 2 );
function manage_posts_columns( $posts_columns ) {
	$posts_columns['ID'] = __( 'ID', 'megumi' );
	return $posts_columns;
}

function add_column($column_name, $post_id) {
	if( $column_name == 'ID' ) {
		$id = $post_id;
	}
	if ( isset($id) && $id ) {
		echo esc_attr($id);
	} else {
		echo __( 'None', 'megumi' );
	}
}

function get_action( $tag ) {
	global $wp_filter, $merged_filters;
	if ( isset( $wp_filter[$tag] ) ) {
		return true;
	} else {
		return false;
	}
}