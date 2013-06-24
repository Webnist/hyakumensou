<?php
/* *** short megumi related posts *** */
add_shortcode( 'megumi_related_posts', 'shortcode_megumi_related_posts' );
function shortcode_megumi_related_posts( $atts, $content=null ){
    extract( shortcode_atts( array(
		'class' => 'related_posts',
		'title' => __( 'Related Articles', 'megumi'),
		'date'  => 1,
		'thumb' => 0,
		'limit' => 5,
    ), $atts ) );
    $output = megumi_related_posts( 'class=' . $class . '&title=' . $title . '&date=' . $date . '&thumb=' . $thumb . '&limit=' . $limit . '&echo=0' );
    return $output;
}

/* *** short megumi banner *** */
add_shortcode( 'megumi_banner', 'shortcode_short_megumi_banner' );
function shortcode_short_megumi_banner( $atts, $content=null ){
    extract( shortcode_atts( array(
		'href'   => '',
		'title'  => '',
		'target' => '',
		'src'    => '',
		'width'  => '',
		'height' => '',
		'alt'    => '',
		'class'  => '',
		'echo'   => 1,
    ), $atts ) );
    $output = megumi_banner( 'href=' . $href . '&title=' . $title . '&target=' . $target . '&src=' . $src . '&width=' . $width . '&height=' . $height . '&alt=' . $alt . '&class=' . $class . '&echo=0' );
    return $output;
}

/* *** megumi page content nav *** */
add_shortcode( 'page_content_nav', 'shortcode_page_content_nav' );
function shortcode_page_content_nav( $atts, $content=null ){
    extract( shortcode_atts( array(
        'pid' => '',
    ), $atts ) );
    $output = zen_page_content_nav( 'include=' . $pid );
    return $output;
}
