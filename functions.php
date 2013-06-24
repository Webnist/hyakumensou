<?php
/* *** Include *** */
require_once get_template_directory() . '/includes/megumi-define.php';
require_once get_template_directory() . '/includes/megumi-admin.php';
require_once get_template_directory() . '/includes/megumi-query.php';
require_once get_template_directory() . '/includes/megumi-head.php';
require_once get_template_directory() . '/includes/megumi-functions.php';
require_once get_template_directory() . '/includes/megumi-shortcode.php';
require_once get_template_directory() . '/includes/megumi-filters.php';
require_once get_template_directory() . '/includes/widgets.php';
require_once get_template_directory() . '/includes/Browser.php';
require_once get_template_directory() . '/includes/megumi-updater.php';
if ( file_exists( get_stylesheet_directory() . '/default-widget.php' ) ) {
	require_once get_stylesheet_directory() . '/default-widget.php';
}

if ( !isset( $content_width ) )
	$content_width = 568;

/* *** Themes Setup hook *** */
add_action( 'after_setup_theme', 'megumi_setup' );

if ( ! function_exists( 'megumi_setup' ) ) {

	function megumi_setup() {

		/* *** Adapt the style visual editor *** */
		add_editor_style();
		
		/* *** post-formats *** */
		add_theme_support( 'post-formats', array( 'aside', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video', 'audio' ) );

		/* *** Add default posts and comments RSS feed links to head *** */
		add_theme_support( 'automatic-feed-links' );

		/* *** Make theme available for translation *** */
		load_theme_textdomain( 'megumi', get_template_directory() . '/languages' );

		/* *** This theme uses wp_nav_menu() in one location. *** */
		register_nav_menus( array(
			'main_menu'   => __( 'Main Navigation', 'megumi' ),
			'footer_menu' => __( 'Footer Navigation', 'megumi' ),
		) );

		// Add support for custom backgrounds.
		add_theme_support( 'custom-background', array(
				'default-color' => 'f2f2f2',
			) );

		// Add support for custom headers.
		$defaults = array(
			'default-image' => get_template_directory_uri() . '/images/headers/main_img.jpg',
			'width'         => apply_filters( 'megumi_main_img_width', 940 ),
			'height'        => apply_filters( 'megumi_main_img_height', 319 ),
			'header-text'   => false,
		);
		add_theme_support( 'custom-header', $defaults );

		register_default_headers(
			array(
				'megumi_themes' => array(
					'url'           => '%s/images/headers/main_img.jpg',
					'thumbnail_url' => '%s/images/headers/main_img-thumbnail.jpg',
					'description'   => __( 'Megumi themes', 'megumi' )
				),
			)
		);

		/* *** This theme uses post thumbnails *** */
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'post-archives', ARCHIVE_WIDTH, ARCHIVE_HEIGHT );
		add_image_size( 'small-archives', SMALL_ARCHIVE_WIDTH, SMALL_ARCHIVE_HEIGHT );
		add_image_size( 'mobile-archives', MOBILE_ARCHIVE_WIDTH, MOBILE_ARCHIVE_HEIGHT );

	}
}

/* *** Widgets *** */
add_action( 'widgets_init', 'megumi_widgets_init' );
function megumi_widgets_init() {
	/* *** Header Area *** */
	register_sidebar( array(
		'name'          => __( 'Header Widget Area', 'megumi' ),
		'id'            => 'header-widget-area',
		'description'   => __( 'The header widget area', 'megumi' ),
		'before_widget' => '<div id="%1$s" class="widget-header %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '',
		'after_title'   => '',
	) );
	if ( megumi_home_on() ) {

		/* *** First Front Page Widget Area *** */
		register_sidebar( array(
			'name'          => __( 'First Front Page Widget Area', 'megumi' ),
			'id'            => 'first-front-page',
			'description'   => __( 'First Front Page Widget Area', 'megumi' ),
			'before_widget' => '<aside id="%1$s" class="widget-container %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h1 class="widget-title">',
			'after_title'   => '</h1>',
		));

		/* *** Second Front Page Widget Area *** */
		register_sidebar( array(
			'name'          => __( 'Second Front Page Widget Area', 'megumi' ),
			'id'            => 'second-front-page',
			'description'   => __( 'Second Front Page Widget Area', 'megumi' ),
			'before_widget' => '<aside id="%1$s" class="widget-container %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h1 class="widget-title">',
			'after_title'   => '</h1>',
		));

		/* *** Third Front Page Widget Area *** */
		register_sidebar( array(
			'name'          => __( 'Third Front Page Widget Area', 'megumi' ),
			'id'            => 'third-front-page',
			'description'   => __( 'Third Front Page Widget Area', 'megumi' ),
			'before_widget' => '<aside id="%1$s" class="widget-container %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h1 class="widget-title">',
			'after_title'   => '</h1>',
		));

		/* *** Fourth Front Page Widget Area *** */
		register_sidebar( array(
			'name'          => __( 'Fourth Front Page Widget Area', 'megumi' ),
			'id'            => 'fourth-front-page',
			'description'   => __( 'Fourth Front Page Widget Area', 'megumi' ),
			'before_widget' => '<aside id="%1$s" class="widget-container %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h1 class="widget-title">',
			'after_title'   => '</h1>',
		));

	}

	/* *** First Side Widget Area *** */
	register_sidebar( array(
		'name'          => __( 'First Side Widget Area', 'megumi' ),
		'id'            => 'first-side-widget-area',
		'description'   => __( 'The first side widget area', 'megumi' ),
		'before_widget' => '<aside id="%1$s" class="widget-container %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );

	/* *** First Side Widget Area 2 *** */
	register_sidebar( array(
		'name'          => __( 'Second Side Widget Area', 'megumi' ),
		'id'            => 'second-side-widget-area',
		'description'   => __( 'The second side widget area', 'megumi' ),
		'before_widget' => '<aside id="%1$s" class="widget-container %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );

	/* *** First Footer Widget. *** */
	register_sidebar( array(
		'name'          => __( 'First Footer Widget Area', 'megumi' ),
		'id'            => 'first-footer-widget-area',
		'description'   => __( 'The first footer widget area', 'megumi' ),
		'before_widget' => '<aside id="%1$s" class="widget-container %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );

	/* *** Second Footer Widget *** */
	register_sidebar( array(
		'name'          => __( 'Second Footer Widget Area', 'megumi' ),
		'id'            => 'second-footer-widget-area',
		'description'   => __( 'The second footer widget area', 'megumi' ),
		'before_widget' => '<aside id="%1$s" class="widget-container %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );

	/* *** Third Footer Widget *** */
	register_sidebar( array(
		'name'          => __( 'Third Footer Widget Area', 'megumi' ),
		'id'            => 'third-footer-widget-area',
		'description'   => __( 'The third footer widget area', 'megumi' ),
		'before_widget' => '<aside id="%1$s" class="widget-container %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );

	/* *** Fourth Footer Widget *** */
	register_sidebar( array(
		'name'          => __( 'Fourth Footer Widget Area', 'megumi' ),
		'id'            => 'fourth-footer-widget-area',
		'description'   => __( 'The fourth footer widget area', 'megumi' ),
		'before_widget' => '<aside id="%1$s" class="widget-container %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}

/* *** Get Widget ID *** */
function megumi_widget_id( $unset = '' ) {
	$get_widget = wp_get_sidebars_widgets();
	foreach ( $get_widget as $key => $value ) {
		$widget_id[ $key ] = $key;
	}
	if ( $unset ) {
		foreach ( $unset as $value ) {
			unset( $widget_id[ $value ] );
		}
	}
	return $widget_id;
}

/* *** megumi post type *** */
function megumi_post_type() {
	$value = array( 'post' );
	return apply_filters( 'add_megumi_post_type', $value );
}
