<?php

/* *** Site URL *** */
if ( ! defined( 'MEGUMI_SITE_URL' ) )
	define( 'MEGUMI_SITE_URL', site_url( '/' ) );

/* *** HOME URL *** */
if ( ! defined( 'MEGUMI_HOME_URL' ) )
	define( 'MEGUMI_HOME_URL', home_url( '/' ) );

/* *** WordPress Document Root *** */
if ( ! defined( 'MEGUMI_SITE_DIR' ) )
	define( 'MEGUMI_SITE_DIR', ABSPATH );

/* *** Themes Directory Root *** */
if ( ! defined( 'MEGUMI_THEME_DIR' ) )
	define( 'MEGUMI_THEME_DIR', get_template_directory() );

/* *** Child Themes Directory Root *** */
if ( ! defined( 'MEGUMI_CHILD_THEME_DIR' ) )
	define( 'MEGUMI_CHILD_THEME_DIR', get_stylesheet_directory() );

/* *** Themes Directory URL *** */
if ( ! defined( 'MEGUMI_THEME_URL' ) )
	define( 'MEGUMI_THEME_URL', get_template_directory_uri() );

/* *** Child Themes Directory URL *** */
if ( ! defined( 'MEGUMI_CHILD_THEME_URL' ) )
	define( 'MEGUMI_CHILD_THEME_URL', get_stylesheet_directory_uri() );

/* *** Themes Images Directory Root *** */
if ( ! defined( 'MEGUMI_IMG_DIR' ) )
	define( 'MEGUMI_IMG_DIR', MEGUMI_THEME_DIR .'/images' );

/* *** Child Themes Images Directory Root *** */
if ( ! defined( 'MEGUMI_CHILD_IMG_DIR' ) )
	define( 'MEGUMI_CHILD_IMG_DIR', MEGUMI_CHILD_THEME_DIR . '/images' );

/* *** Themes Images Directory URL *** */
if ( ! defined( 'MEGUMI_IMG_URL' ) )
	define( 'MEGUMI_IMG_URL', MEGUMI_THEME_URL . '/images' );

/* *** Child Themes Images Directory URL *** */
if ( ! defined( 'MEGUMI_CHILD_IMG_URL' ) )
	define( 'MEGUMI_CHILD_IMG_URL', MEGUMI_CHILD_THEME_URL . '/images' );

/* *** Upload Directory Root *** */
if ( ! defined( 'MEGUMI_IMG_UPLOAD_PATH' ) ) {
	if ( get_option( 'upload_path' ) ) {
		define( 'MEGUMI_IMG_UPLOAD_PATH', ABSPATH . get_option( 'upload_path' ) );
	} else {
		define( 'MEGUMI_IMG_UPLOAD_PATH', MEGUMI_SITE_DIR . 'wp-content/uploads' );
	}
}

/* *** Upload Directory URL *** */
if ( ! defined( 'MEGUMI_IMG_UPLOAD_URL' ) ) {
	if ( get_option( 'upload_path' ) ) {
		if ( get_option( 'fileupload_url' ) ) {
			define( 'MEGUMI_IMG_UPLOAD_URL', get_option( 'fileupload_url' ) );
		} else {
			define( 'MEGUMI_IMG_UPLOAD_URL', MEGUMI_SITE_URL . get_option( 'upload_path' ) );
		}
	} else {
		define( 'MEGUMI_IMG_UPLOAD_URL',  MEGUMI_SITE_URL . 'wp-content/uploads' );
	}
}

/* *** Default Featured Image *** */
if ( ! defined( 'ARCHIVE_WIDTH' ) )
	define( 'ARCHIVE_WIDTH', apply_filters( 'archive_width', 191 ) );

if ( ! defined( 'ARCHIVE_HEIGHT' ) )
	define( 'ARCHIVE_HEIGHT', apply_filters( 'archive_height', 9999 ) );

/* *** Small Featured Image *** */
if ( ! defined( 'SMALL_ARCHIVE_WIDTH' ) )
	define( 'SMALL_ARCHIVE_WIDTH',  apply_filters( 'small_archive_width', 84 ) );

if ( ! defined( 'SMALL_ARCHIVE_HEIGHT' ) )
	define( 'SMALL_ARCHIVE_HEIGHT', apply_filters( 'small_archive_height', 9999 ) );

/* *** Mobile Featured Image *** */
if ( ! defined( 'MOBILE_ARCHIVE_WIDTH' ) )
	define( 'MOBILE_ARCHIVE_WIDTH', apply_filters( 'mobile_archive_width', 96 ) );

if ( ! defined( 'MOBILE_ARCHIVE_HEIGHT' ) )
	define( 'MOBILE_ARCHIVE_HEIGHT', apply_filters( 'mobile_archive_height', 9999 ) );

/* *** Megumi Theme Data *** */
if ( ! defined( 'MEGUMI_VERSION' ) ) {
	$megumi_theme_data = get_theme_data( MEGUMI_THEME_DIR.'/style.css' );
	define( 'MEGUMI_VERSION', $megumi_theme_data['Version'] );
}
