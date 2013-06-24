<?php
/* *** megumi header action *** */
function megumi_header() {
	do_action( 'megumi_header' );
}

/* *** megumi header widget area action *** */
function header_widget_area() {
	do_action( 'header_widget_area' );
}

/* *** megumi first front page action *** */
function first_front_page() {
	do_action( 'first_front_page' );
}

/* *** megumi second front page action *** */
function second_front_page() {
	do_action( 'second_front_page' );
}

/* *** megumi third front page action *** */
function third_front_page() {
	do_action( 'third_front_page' );
}

/* *** megumi fourth front page action *** */
function fourth_front_page() {
	do_action( 'fourth_front_page' );
}

/* *** megumi first side widget area action *** */
function first_side_widget_area() {
	do_action( 'first_side_widget_area' );
}

/* *** megumi second side widget area action *** */
function second_side_widget_area() {
	do_action( 'second_side_widget_area' );
}

/* *** megumi first footer widget action *** */
function first_footer_widget_area() {
	do_action( 'first_footer_widget_area' );
}

/* *** megumi second footer widget action *** */
function second_footer_widget_area() {
	do_action( 'second_footer_widget_area' );
}

/* *** megumi third footer widget action *** */
function third_footer_widget_area() {
	do_action( 'third_footer_widget_area' );
}

/* *** megumi fourth footer widget action *** */
function fourth_footer_widget_area() {
	do_action( 'fourth_footer_widget_area' );
}

/* *** megumi entry header meta action *** */
function megumi_archive_header() {
	do_action( 'megumi_archive_header' );
}

/* *** megumi entry footer meta action *** */
function megumi_archive_footer() {
	do_action( 'megumi_archive_footer' );
}

/* *** megumi entry header meta action *** */
function megumi_entry_header_meta() {
	do_action( 'megumi_entry_header_meta' );
}

/* *** megumi entry footer meta action *** */
function megumi_entry_footer_meta() {
	do_action( 'megumi_entry_footer_meta' );
}

/* *** megumi entry other header action *** */
function megumi_entry_other_header() {
	do_action( 'megumi_entry_other_header' );
}

/* *** megumi entry other meta action *** */
function megumi_entry_other_content() {
	do_action( 'megumi_entry_other_content' );
}

/* *** megumi footer action *** */
function megumi_footer() {
	do_action( 'megumi_footer' );
}

/* *** Header Description *** */
add_action( 'megumi_header', 'megumi_header_description', apply_filters( 'order_megumi_header_description', 1 ) );
/* *** Header Title *** */
add_action( 'megumi_header', 'megumi_header_title', apply_filters( 'order_megumi_header_title', 2 ) );
/* *** Header Widget *** */
add_action( 'megumi_header', 'megumi_header_widget', apply_filters( 'order_megumi_header_widget', 3 ) );
/* *** Header Image *** */
add_action( 'megumi_header', 'megumi_header_images', apply_filters( 'order_megumi_header_images', 4 ) );
/* *** Header Navigation *** */
add_action( 'megumi_header', 'megumi_main_nav', apply_filters( 'order_megumi_main_nav', 5 ) );
/* *** Post Date *** */
add_action( 'megumi_entry_header_meta', 'megumi_posts_date', apply_filters( 'order_megumi_posts_date', 1 ) );
/* *** Post Author *** */
add_action( 'megumi_entry_header_meta', 'megumi_posts_by', apply_filters( 'order_megumi_posts_by', 2 ) );
/* *** Post Category List *** */
add_action( 'megumi_entry_footer_meta', 'megumi_category_list', apply_filters( 'order_megumi_category_list', 1 ) );
/* *** Post Tag List *** */
add_action( 'megumi_entry_footer_meta', 'megumi_tag_list', apply_filters( 'order_megumi_tag_list', 2 ) );
/* *** Post Comment Count *** */
add_action( 'megumi_entry_footer_meta', 'megumi_comments', 99 );
/* *** Single Nav *** */
add_action( 'megumi_entry_other_content', 'add_single_nav' );
/* *** Related Posts *** */
add_action( 'megumi_entry_other_content', 'megumi_related_posts' );
/* *** Comment View *** */
add_action( 'megumi_entry_other_content', 'add_comments_view' );
/* *** Pagenav *** */
add_action( 'megumi_archive_footer', 'add_tab_nav' );
/* *** Footer Navigation *** */
add_action( 'megumi_footer', 'megumi_footer_nav', apply_filters( 'order_megumi_footer_nav', 1 ) );
/* *** Footer Copyright *** */
add_action( 'megumi_footer', 'megumi_copyright', apply_filters( 'order_megumi_copyright', 2 ) );
/* *** Footer Site Generator *** */
add_action( 'megumi_footer', 'site_generator', apply_filters( 'order_site_generator', 3 ) );
/* *** Add IE7.jp *** */
add_action( 'wp_print_scripts', 'add_ie7_js' );

/* *** Include Child Themes Filter *** */
if ( file_exists( MEGUMI_CHILD_THEME_DIR . '/child-filter.php' ) ) {
	require_once MEGUMI_CHILD_THEME_DIR . '/child-filter.php';
}
