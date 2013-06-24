<?php
/* Query
++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ */
add_filter( 'query_vars', 'add_megumi_all_post_query_var' );
function add_megumi_all_post_query_var( $vars ){
	array_push( $vars, 'all_post' );
	return $vars;
}

add_filter( 'rewrite_rules_array', 'add_megumi_all_post_rewrite_rules', 9 );
function add_megumi_all_post_rewrite_rules( $rules ) {
	$newrules = array();

	$newrules['all_post/?$'] = 'index.php?all_post=all_post';
	$newrules['all_post/page/?([0-9]{1,})/?$'] = 'index.php?all_post=all_post&paged=$matches[1]';

	return $newrules + $rules;
}

add_action( 'pre_get_posts', 'add_megumi_all_post_query' );
function add_megumi_all_post_query( $query ) {
	if ( !is_admin() && $query->is_main_query() && get_query_var('all_post') ) {
		$query->set( 'post_type', 'post' );
		$query->is_archive = true;
		$query->is_home = false;
		$query->is_front_page = false;
	}
	return $query;
}
