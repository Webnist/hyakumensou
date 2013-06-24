<?php

/* *** excerpt *** */
if ( ! function_exists( 'megumi_excerpt_more' ) ) {
	add_filter( 'excerpt_more', 'megumi_excerpt_more' );
	function megumi_excerpt_more( $post ) {
		$output = '<br>' . "\n";
		$output .= '<a href="'. get_permalink() . '" title="' . sprintf( esc_attr__( 'Permalink to %s', 'megumi' ), the_title_attribute( 'echo=0' ) ) . '" class="read_more">' . __( 'Read the Rest...', 'megumi' ) . '</a>' . "\n";
		return $output;
	}
}

/* *** All Posts More *** */
function get_all_posts_more() {
	if (get_option( 'permalink_structure' ) ) {
		$output = home_url( 'all_post' );
	} else {
		$output = home_url( '?all_post=all_post' );
	}
	return $output;
}

/* = Header Area
-------------------------------------------------------------- */
/* *** Theme Title *** */
function megumi_title() {
	global $wp_query, $page, $paged;
	$site_title = get_bloginfo( 'name', 'display' );
	$page_title = wp_title( '', true, 'right' );
	$site_description = get_bloginfo( 'description', 'display' );
	$get_pagename = $wp_query->query_vars['post_type'];
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$output = $site_title . ' | ' . $site_description;
	} else {
		if ( $get_pagename == 'post' ) {
			if ( $paged >= 2 | $page >= 2 ) {
				$output = __( 'All Post', 'megumi' ) . ' | ' . sprintf( __( 'Page %s', 'megumi' ), max( $paged, $page ) ) . ' | ' . $site_title;
			} else {
				$output = __( 'All Post', 'megumi' ) . ' | ' . $site_title;
			}
		} else {
			if ( $paged >= 2 | $page >= 2 ) {
				$output = $page_title . ' | ' . sprintf( __( 'Page %s', 'megumi' ), max( $paged, $page ) ) . ' | ' . $site_title;
			} else {
				$output = $page_title . ' | ' . $site_title;
			}
		}
	}
	return $output;
}

function megumi_header_check() {
	global $wp_filter, $merged_filters;
	$get_array = $wp_filter['megumi_header'];
	foreach ( $get_array as $key ) {
		foreach ( $key as $value ) {
			if( $value['function'] == 'megumi_header_description' ) {
				return 1;
			} elseif( $value['function'] == 'megumi_header_title' ) {
				return 2;
			}
		}
	}
}

function megumi_header_description( $args = '' ) {
	global $post;
	$defaults = array(
		'echo'  => 1,
	);
	$r         = wp_parse_args( $args, $defaults );
	$echo      = $r['echo'];
	if ( megumi_header_check() == 1 ) {
		$output = '<h1 id="site-description">' . get_bloginfo( 'description' ) . '</h1>' . "\n";
	} else {
		$output = '<h2 id="site-description">' . get_bloginfo( 'description' ) . '</h2>' . "\n";
	}
	if ( $echo == 1 ) {
		echo $output;
	} else {
		return $output;
	}
}
		
function megumi_header_title( $args = '' ) {
	global $post;
	$defaults = array(
		'echo'  => 1,
	);
	$r         = wp_parse_args( $args, $defaults );
	$echo      = $r['echo'];
	if ( megumi_header_check() == 2 ) {
		$output = '<h1 id="site-title"><a href="' . home_url( '/' ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" rel="home">' . get_bloginfo( 'title' ). '</a></h1>' . "\n";
	} else {
		$output = '<h2 id="site-title"><a href="' . home_url( '/' ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" rel="home">' . get_bloginfo( 'title' ). '</a></h2>' . "\n";
	}
	if ( $echo == 1 ) {
		echo $output;
	} else {
		return $output;
	}
}

function megumi_header_widget( $args = '' ) {
	global $post;
	if ( ! dynamic_sidebar( 'header-widget-area' ) ) {
		header_widget_area();
	}
}

/* *** Megumi Header Images *** */
function megumi_header_images( $args = '' ) {
	global $post;
	$defaults = array(
		'echo'  => 1,
	);
	$r         = wp_parse_args( $args, $defaults );
	$echo      = $r['echo'];
	$view_page = array( is_home(), is_front_page() );
	$view_page = apply_filters( 'view_megumi_header_images', $view_page );
	if ( in_array( 1, $view_page ) ) {
		$output = '<p id="main-img"><img src="' . get_header_image() . '" width="' . HEADER_IMAGE_WIDTH . '" height="' . HEADER_IMAGE_HEIGHT . '" alt=""></p>' . "\n";
		if ( $echo == 1 ) {
			echo $output;
		} else {
			return $output;
		}
	}
}

/* *** Main Page Navs *** */
function megumi_page_menu() {
	$output = '<nav id="main-menu-box" class="main-menu-box">' . "\n";
	$output .= '<ul id="main-menu" class="main-menu">' . "\n";
	$output .= wp_list_pages( 'title_li=&echo=0' );
	$output .= '</ul>' . "\n";
	$output .= '</nav>' . "\n";
	echo $output;
}

/* *** Megumi Main Navigation *** */
function megumi_main_nav( $args = '' ) {
	global $post;
	$defaults = array(
			'echo'  => 1,
	);
	$r      = wp_parse_args( $args, $defaults );
	$echo   = $r['echo'];
	$output = wp_nav_menu( array( 'menu' => 'main_nenu', 'container' => 'nav', 'container_class' => 'main-menu-box', 'container_id' => 'main-menu-box', 'menu_class' => 'main-menu', 'menu_id' => 'main-menu', 'echo' => true, 'fallback_cb' => 'megumi_page_menu', 'theme_location' => 'main_menu' ) );
	if ( $echo == 1 ) {
		echo $output;
	} else {
		return $output;
	}
}

/* = HOME Area
-------------------------------------------------------------- */
/* *** megumi content banner *** */
function megumi_content_banner( $args = '' ) {
	$defaults = array(
		'on'      => 1,
		'tsrc'    => '',
		'twidth'  => '',
		'theight' => '',
		'ttitle'  => '',
		'talt'    => '',
		'tlink'   => 1,
		'tolink'  => 1,
		'id'      => '',
		'href'    => '',
		'title'   => '',
		'target'  => '',
		'src'     => '',
		'width'   => '',
		'height'  => '',
		'alt'     => '',
		'class'   => '',
		'echo'    => 1,
	);
	$r       = wp_parse_args( $args, $defaults );
	$on      = $r['on'];
	$tsrc    = esc_html( $r['tsrc'] );
	$twidth  = $r['twidth'];
	$theight = $r['theight'];
	$ttitle  = $r['ttitle'];
	$tlink   = $r['tlink'];
	$tolink  = $r['tolink'];
	$id      = $r['id'];
	$href    = esc_html( $r['href'] );
	$title   = $r['title'];
	$target  = $r['target'];
	$src     = esc_html( $r['src'] );
	$width   = $r['width'];
	$height  = $r['height'];
	$alt     = $r['alt'];
	$class   = $r['class'];
	$echo    = $r['echo'];
	if ( $id && $tolink == 1 ) {
		$href = get_permalink( $id );
	} else {
		$href = $href;
	}
	if ( $class ) {
		$class = ' class="' . $class . '"';
	} else {
		$class = '';
	}
	if ( $title ) {
		$title = ' title="' . $title . '"';
	} else {
		$title = '';
	}
	if ( $target ) {
		$target =  ' target="' . $target . '"';
	} else {
		$target = '';
	}
	if ( $twidth ) {
		$twidth =  ' width="' . $twidth . '"';
	} else {
		$twidth = '';
	}
	if ( $theight ) {
		$theight =  ' height="' . $theight . '"';
	} else {
		$theight = '';
	}
	if ( $talt ) {
		$alt =  ' alt="' . $talt . '"';
	} else {
		if ( $alt ) {
			$alt =  ' alt="' . $alt . '"';
		} else {
			$alt = '';
		}
	}
	if ( $width ) {
		$width =  ' width="' . $width . '"';
	} else {
		$width = '';
	}
	if ( $height ) {
		$height =  ' height="' . $height . '"';
	} else {
		$height = '';
	}
	$output = '<div' . $class . '>' . "\n";
	if ( $on == 1 ) {
		if ( $tlink == 1 ) {
			$output .= '<h2>';
			$output .= '<a href="' . $href . '"' . $title . $target . '>';
			$output .= '<img src="' . $tsrc . '"' . $twidth . $theight . $alt . '>';
			$output .= '</a>' . "\n";
			$output .= '</h2>';
			$output .= '<a href="' . $href . '"' . $title . $target . '>';
			$output .= '<img src="' . $src . '"' . $width . $height . $alt . '>';
			$output .= '</a>' . "\n";
		} else {
			$output .= '<h2>';
			$output .= '<img src="' . $tsrc . '"' . $twidth . $theight . $alt . '>';
			$output .= '</h2>';
			$output .= '<a href="' . $href . '"' . $title . $target . '>';
			$output .= '<img src="' . $src . '"' . $width . $height . $alt . '>';
			$output .= '</a>' . "\n";
		}
	} else {
			$output .= '<a href="' . $href . '"' . $title . $target . '>';
			$output .= '<img src="' . $src . '"' . $width . $height . $alt . '>';
			$output .= '</a>' . "\n";
	}
	$output .= '</div>' . "\n";
	if ( $echo == 1 ) {
		echo $output;
	} else {
		return $output;
	}
}

function megumi_page_excerpt( $post_id, $text, $more = 1 ) {
	global $shortcode_tags;
	if ( class_exists( 'multibyte_patch' ) ) {
		$wpmp_conf = new multibyte_patch;
		$excerpt_length = $wpmp_conf->conf['excerpt_length'];
		$excerpt_mblength = $wpmp_conf->conf['excerpt_mblength'];
	} else {
		$excerpt_length = 55;
		$excerpt_mblength = 110;
	}
	$text = strip_shortcodes( $text );
	if ( !empty( $shortcode_tags ) && is_array( $shortcode_tags) ) {
		$tagnames  = array_keys( $shortcode_tags );
		$tagregexp = join( '|', array_map( 'preg_quote', $tagnames ) );
		$text   = preg_replace( '/\[(' . $tagregexp . ')\\b.*?\\/?\\]/s', '', $text );
		$text   = preg_replace( '/\[\/(' . $tagregexp . ')\\b.*?\\/?\\]/s', '', $text );
	}
	if ( strlen( $text ) == mb_strlen( $text, 'UTF-8') ) {
		$excerpt = wp_html_excerpt( $text, $excerpt_length );
	} else {
		$excerpt = wp_html_excerpt( $text, $excerpt_mblength );
	}

	if ( $text == $excerpt )
		return $text;

	if ( $more == 1 ) {
		$excerpt .= '<br>' . "\n";
		$excerpt .= '<a href="'. get_permalink( $post_id ) . '" title="' . sprintf( esc_attr__( 'Permalink to %s', 'megumi' ), get_the_title( $post_id ) ) . '" class="read_more">' . __( 'Read the Rest...', 'megumi' ) . '</a>' . "\n";
	}
	return $excerpt;
}

/* megumi include page */
function megumi_include_page( $args = '' ) {
	$defaults = array(
		'page'         => 1,
		'id'           => '',
		'type'         => 3,
		'image_size'   => '',
		'content_type' => 1,
		'class'        => 'include_page',
		'widget'       => '',
		'echo'         => 1,
	);
	$r            = wp_parse_args( $args, $defaults );
	$page         = $r['page'];
	$id           = $r['id'];
	$type         = $r['type'];
	$image_size   = $r['image_size'];
	$content_type = $r['content_type'];
	$class        = $r['class'];
	$widget       = $r['widget'];
	$echo         = $r['echo'];
	if ( $class ) {
		$class = ' class="' . $class . '"';
	} else {
		$class = '';
	}
	if ( $page == 1 ) {
		$get_post = get_pages( 'include=' . $id );
	} else {
		$get_post = get_posts( 'numberposts=1&include=' . $id );
	}
	if ( in_array( $widget, megumi_widget_id( array( 'wp_inactive_widgets', 'header-widget-area', 'first-front-page', 'second-front-page', 'third-front-page', 'fourth-front-page' ) ) ) ) {
		$thumb_size = 'small-archives';
	} else {
		if ( $image_size ) {
			$thumb_size = $image_size;
		} else {
			$thumb_size = 'post-archives';
		}
	}
	if ( $get_post ) {
		$output = '<div' . $class . '>' . "\n";
		foreach ( $get_post as $post ) {
			setup_postdata( $post );
			if ( $content_type == 1 ) {
				if ( $page == 1 ) {
					$text    = get_the_content();
					$content = megumi_page_excerpt( $post->ID, $text );
					$content = apply_filters('the_content', $content);
					$content = str_replace(']]>', ']]&gt;', $content);
				} else {
					$content = get_the_excerpt();
					$content = apply_filters('the_content', $content);
					$content = str_replace(']]>', ']]&gt;', $content);
				}
			} else {
				$content = get_the_content();
				$content = apply_filters('the_content', $content);
				$content = str_replace(']]>', ']]&gt;', $content);
			}
			$output .= '<article class="' . implode( ' ', get_post_class( '', $post->ID ) ) . '">' . "\n";
			$output .= '<header class="entry-header">' . "\n";
			$output .= '<h1 class="entry-title">' . get_the_title( $post->ID ) . '</h1>' . "\n";
			$output .= '</header><!-- .entry-header -->' . "\n";
			$output .= '<div class="entry-content">' . "\n";
			switch ( $type ) {
				case 1:
					if ( has_post_thumbnail( $post->ID ) ) {
						$output .= '<p class="thumb"><a href="' . get_permalink( $post->ID ) . '" title="' . sprintf( __( 'Permanent Link to %s', 'megumi' ), get_the_title( $post->ID ) ) . '">' . get_the_post_thumbnail( $post->ID, $thumb_size ) . '</a></p>' . "\n";
					}
					$output .= $content;
				break;
				case 2:
					$output .= $content;
				break;
				case 3:
					if ( has_post_thumbnail( $post->ID ) ) {
						$output .= '<p class="thumb"><a href="' . get_permalink( $post->ID ) . '" title="' . sprintf( __( 'Permanent Link to %s', 'megumi' ), get_the_title( $post->ID ) ) . '">' . get_the_post_thumbnail( $post->ID, $thumb_size ) . '</a></p>' . "\n";
					}
				break;
			}
			$output .= '</div>' . "\n";
			$output .= '</article>' . "\n";
		}
		$output .= '</div>' . "\n";
	}
	if ( $echo == 1 ) {
		echo $output;
	} else {
		return $output;
	}
}

function megumi_page_content( $include_page = null ) {
    if( $include_page ) {
		$content = get_post_meta( $include_page, 'description', $single = true );
		$content = apply_filters('the_content', $content);
		$content = str_replace(']]>', ']]&gt;', $content);
        $output = '<li class="page_content_' . $include_page . '">' . "\n";
        $output .= '<h2><a href="' . get_permalink( $include_page ) . '">' . get_the_title( $include_page ) . '</a></h2>' . "\n";
        $output .= '<p>' . $content . '</p>'."\n";
        $output .= '</li>' . "\n";
        return $output;
    }
}

function megumi_page_content_nav( $args = '' ) {
    $defaults = array(
        'class' => 'page_content_nav',
        'include' => ''
    );
    $r = wp_parse_args( $args, $defaults );
    if( $r['include'] ) {
        $include_array = explode( ',', $r['include'] );
        $output = '<div class="' . $r['class'] . '">' . "\n";
        $output .= '<ul>' . "\n";
        foreach( $include_array as $pageid ) {
            $output .= megumi_page_content( $pageid );
        }
        $output .= '</ul>' . "\n";
        $output .= '</div>' . "\n";
        $output .= '<hr class="clear">' . "\n";
        return $output;
    }
}

/* = Content Area
-------------------------------------------------------------- */
/* megumi page title */
function megumi_page_title() {
	global $post, $author;
	if ( is_category() ) {
		$output = '<h1 class="page-title">' . sprintf( __( 'Category Archives: %s', 'megumi' ), single_cat_title( '', false ) ) . '</h1>' . "\n";
		$output = apply_filters( 'add_megumi_category_title', $output );
	} elseif ( is_tag() ) {
		$output = '<h1 class="page-title">' . sprintf( __( 'Tag Archives: %s', 'megumi' ), single_tag_title( '', false ) ) . '</h1>' . "\n";
		$output = apply_filters( 'add_megumi_tags_title', $output );
	} elseif ( is_tax() ) {
		$output = '<h1 class="page-title">' . sprintf( __( 'Taxonomy Archives: %s', 'megumi' ), single_term_title( '', false ) ) . '</h1>';
		$output = apply_filters( 'add_megumi_tax_title', $output );
	} elseif ( is_day() ) {
		$output = '<h1 class="page-title">' . sprintf( __( 'Daily Archives: %s', 'megumi' ), get_the_date() ) . '</h1>' . "\n";
		$output = apply_filters( 'add_megumi_day_title', $output );
	} elseif ( is_month() ) {
		$output = '<h1 class="page-title">' . sprintf( __( 'Monthly Archives: %s', 'megumi' ), get_the_date( 'Y/m' ) ) . '</h1>' . "\n";
		$output = apply_filters( 'add_megumi_month_title', $output );
	} elseif ( is_year() ) {
		$output = '<h1 class="page-title">' . sprintf( __( 'Yearly Archives: %s', 'megumi' ), get_the_date( 'Y' ) ) . '</h1>' . "\n";
		$output = apply_filters( 'add_megumi_year_title', $output );
	} elseif ( is_search() ) {
		$output = '<h1 class="page-title">' . sprintf( __( 'Search results in %s for %s hits.', 'megumi' ), get_search_query(), $wp_query->found_posts ) . '</h1>';
		$output = apply_filters( 'add_megumi_search_title', $output );
	} elseif( is_author() ) {
		$output = '<h1 class="page-title">' . sprintf( __( 'Author Archives: %s', 'megumi' ), get_the_author_meta( 'display_name', $author ) ) . '</h1>';
		$output = apply_filters( 'add_megumi_author_title', $output );
		if ( get_the_author_meta( 'description', $author ) ) {
			$author_desc .= '<div id="entry-author-info">' . "\n";
			$author_desc .= '<div id="author-avatar">' . "\n";
			$author_desc .= get_avatar( get_the_author_meta( 'user_email', $author ), apply_filters( 'add_megumi_avatar_size', 60 ) ) . "\n";
			$author_desc .= '</div><!-- #author-avatar -->' . "\n";
			$author_desc .= '<div id="author-description">' . "\n";
			$author_desc .= '<h2>' . sprintf( __( 'About %s', 'megumi' ), get_the_author_meta( 'display_name', $author ) ) . '</h2>' . "\n";
			$author_desc .= get_the_author_meta( 'description', $author ) . "\n";
			$author_desc .= '</div><!-- #author-description	-->' . "\n";
			$author_desc .= '</div><!-- #entry-author-info -->' . "\n";
			$output .= apply_filters( 'add_megumi_author_desc', $author_desc );
		}
	} else {
		$output = '<h1 class="page-title">' . __( 'Blog Archives:', 'megumi' ) . '</h1>' . "\n";
		$output = apply_filters( 'add_megumi_archives_title', $output );
	}
	return apply_filters( 'add_megumi_other_title', $output );
}

/* *** megumi posts date *** */
function megumi_posts_date( $args = '' ) {
	global $post;
	$defaults = array(
		'echo'  => 1,
	);
	$r      = wp_parse_args( $args, $defaults );
	$echo   = $r['echo'];
	$output = '<time datetime="' . get_the_date( 'c' ) . '">' . get_the_date() . '</time>' . "\n";
	if ( $echo == 1 ) {
		echo $output;
	} else {
		return $output;
	}
}

/* *** megumi posts by *** */
function megumi_posts_by( $args = '' ) {
	global $post, $author;
	$defaults = array(
		'before' => __( 'Posts by ', 'megumi' ),
		'echo'  => 1,
	);
	$r      = wp_parse_args( $args, $defaults );
	$before = $r['before'];
	$echo   = $r['echo'];
	$output = sprintf( __( '<span class="author">' . $before . '<a href="%1$s" title="%2$s">%3$s</a></span>', 'megumi' ),
		get_author_posts_url( $post->post_author ),
		esc_attr( sprintf( __( $before . ' %s', 'megumi' ),  get_the_author_meta( 'display_name', $post->post_author ) ) ),
		get_the_author_meta( 'display_name', $post->post_author )
	);
	if ( $echo == 1 ) {
		echo $output;
	} else {
		return $output;
	}
}

/* *** megumi category list *** */
function megumi_category_list( $args = '' ) {
	global $post;
	$defaults = array(
		'class'  => 'category',
		'before' => __( 'Posted in ', 'megumi' ),
		'sep'    => ', ',
		'after'  => '<span class="sep"> | </span>',
		'echo'   => 1,
	);
	$r      = wp_parse_args( $args, $defaults );
	$class  = $r['class'];
	$before = $r['before'];
	$sep    = $r['sep'];
	$after  = $r['after'];
	$echo   = $r['echo'];
	if ( get_the_category() ) {
		$output = '<span class="' . $class . '">' . $before;
		$output .=  sprintf( __( '%1$s', 'megumi' ),	get_the_category_list( $sep ) );
		$output .= '</span>' . $after;
		if ( $echo == 1 ) {
			echo $output;
		} else {
			return $output;
		}
	}
}

/* *** megumi tag list *** */
function megumi_tag_list( $args = '' ) {
	global $post;
	$defaults = array(
		'taxonomy' => 'post_tag',
		'class'    => 'tag',
		'before'   => __( 'Tags in ', 'megumi' ),
		'sep'      => ', ',
		'after'    => '<span class="sep"> | </span>',
		'echo'     => 1,
	);
	$r         = wp_parse_args( $args, $defaults );
	$taxonomy  = $r['taxonomy'];
	$class     = $r['class'];
	$before    = $r['before'];
	$sep       = $r['sep'];
	$after     = $r['after'];
	$echo      = $r['echo'];
	$get_terms = get_the_terms( $post->ID, $taxonomy );
	if ( $get_terms ) {
		$output = '<span class="' . $class . '">';
		$output .= sprintf( __( '%1$s', 'megumi' ), get_the_term_list( $post->ID, $taxonomy, $before, $sep, $after ) );
		$output .= '</span>';
		if ( $echo == 1 ) {
			echo $output;
		} else {
			return $output;
		}
	}
}

/* *** megumi comments *** */
function megumi_comments( $args = '' ) {
	global $post, $wpcommentspopupfile, $wpcommentsjavascript;
	$defaults = array(
		'zero'      => __( 'Leave a comment', 'megumi' ),
		'one'       => __( '1 Comment', 'megumi' ),
		'more'      => __( '%s Comments', 'megumi' ),
		'css_class' => '',
		'none'      => __( 'Comments Off', 'megumi' ),
		'after'     => '<span class="sep"> | </span>',
		'echo'      => 1,
	);
	$r         = wp_parse_args( $args, $defaults );
	$zero      = $r['zero'];
	$one       = $r['one'];
	$more      = $r['more'];
	$css_class = $r['css_class'];
	$none      = $r['none'];
	$after     = $r['after'];
	$echo      = $r['echo'];
	$number = get_comments_number();
	if ( 0 == $number && !comments_open() && !pings_open() ) {
		$output = '<span' . ( ( !empty( $css_class ) ) ? ' class="' . esc_attr( $css_class ) . '"' : ' class="comments-link"') . '><span>' . $none . '</span></span>';
	} elseif ( post_password_required() ) {
		$output = __( 'Enter your password to view comments.' );
	} else {
		$output = '<span class="comments-link">';
		$output .= '<a href="';
		if ( $wpcommentsjavascript ) {
			if ( empty( $wpcommentspopupfile ) )
				$home = home_url();
			else
				$home = get_option( 'siteurl' );
			$output .= $home . '/' . $wpcommentspopupfile . '?comments_popup=' . $id;
			$output .= '" onclick="wpopen(this.href); return false"';
		} else { // if comments_popup_script() is not in the template, display simple comment link
			if ( 0 == $number )
				$output .= get_permalink() . '#respond';
			else
				$output .= get_comments_link();
			$output .= '"';
		}
	
		if ( !empty( $css_class ) ) {
			$output .= ' class="'.$css_class.'" ';
		}
		$title = the_title_attribute( array( 'echo' => 0 ) );
	
		$output .= apply_filters( 'comments_popup_link_attributes', '' );
	
		$output .= ' title="' . esc_attr( sprintf( __( 'Comment on %s' ), $title ) ) . '">';
		if ( 0 == $number ) {
			$output .= $zero;
		} elseif ( 1 == $number ) {
			$output .= $one;
		} elseif ( 0 < $number ) {
			$output .= esc_attr( sprintf( __( $more ), $number ) );
		} else {
			$output .= $none;
		}
		$output .= '</a>';
		$output .= '</span>' . $after;
	}
	if ( $echo == 1 ) {
		echo $output;
	} else {
		return $output;
	}
}

/* *** megumi comments view *** */
function megumi_comments_view() {
	return apply_filters( 'add_megumi_comments_view', TRUE );
}

function get_megumi_parents_category( $id ) {
	$parent = &get_category( $id );
	if ( $parent->parent ) {
		$chain[] .= get_megumi_parents_category( $parent->parent );
	}
	$chain[] .= $parent->term_id;
	return array_shift($chain);
}

/* *** megumi page title *** */
function megumi_active_category_list() {
	$cat = get_query_var('cat');
	$get_parents = get_megumi_parents_category( get_query_var('cat') );
	if ( $get_parents == 0 ) {
		$get_parents = $cat;
	}
	$get_child_cat = get_categories( 'parent=' . $get_parents . '&' );
	if ( $get_child_cat ) {
		$output .= '';
		foreach( $get_child_cat as $cat ) {
			$output .= '<div id="cat-' . $cat->term_id . '" class="cat-box">' . "\n";
			$output .= '<p><a href="' . get_category_link( $cat->term_id ) . '">' . $cat->cat_name . '</a></p>' . "\n";
			if ( $get_child_cat = get_categories( 'parent=' . $cat->term_id ) ) {
				$output .= '<dl id="child-cat-' . $cat->term_id . '" class="child-cat-list">' . "\n";
				foreach( $get_child_cat as $cat ) {
					$output .= '<dt>';
					$output .= '<span class="cat_name"><a href="' . get_category_link( $cat->term_id ) . '">' . $cat->cat_name . '</a></span>';
					$output .= '</dt>' . "\n";
					if ( $cat->category_description ) {
						$output .= '<dd>';
						$output .= '<span class="cat_desc">' . $cat->category_description . '</span>';
						$output .= '</dd>' . "\n";
					}
				}
				$output .= '</dl>' . "\n";
			}
			$output .= '</div>' . "\n";
		}
		return $output;
	}
}


/* *** megumi new post / title text *** */
function megumi_post_list_title( $catid, $title, $title_rss, $title_class ) {
	if ( $title_rss == 1 ) {
		if ( $catid == 0 ) {
			$link .= '<a href="' . get_bloginfo( 'rss2_url' ) . '">' . __( '[RSS]', 'megumi') . '</a>';
		} else {
			$link .= '<a href="' . get_term_feed_link( $catid, 'category' ) . '">' . __( '[RSS]', 'megumi') . '</a>';
		}
		$output = '<h1' . $title_class . '>' . $title . '<span class="title_rss_link">' . $link . '</span></h1>' . "\n";
	} else {
		$output = '<h1' . $title_class . '>' . $title . '</h1>' . "\n";
	}
	return apply_filters( 'add_megumi_post_list_title', $output );
}

/* *** megumi new post / title img *** */
function megumi_post_list_title_img( $catid, $title, $title_src, $title_width, $title_height, $title_rss, $title_class ) {
	if ( $title_rss == 1 ) {
		if ( $catid == 0 ) {
			$link .= '<a href="' . get_bloginfo( 'rss2_url' ) . '">' . __( '[RSS]', 'megumi') . '</a>';
		} else {
			$link .= '<a href="' . get_term_feed_link( $catid, 'category' ) . '">' . __( '[RSS]', 'megumi') . '</a>';
		}
		$output = '<h1' . $title_class . '><img src="' . $title_src . '" title="' . $title . '" width="' . $title_width . '" height="' . $title_height . '"><span class="title_rss_link">' . $link . '</span></h1>' . "\n";
	} else {
		$output = '<h1' . $title_class . '><img src="' . $title_src . '" title="' . $title . '" width="' . $title_width . '" height="' . $title_height . '"></h1>' . "\n";
	}
	return apply_filters( 'add_megumi_post_list_title_img', $output );
}

/* *** megumi new post / title & date *** */
function megumi_post_list_type_01() {
	$output  = '<li>';
	$output .= '<span class="title"><a href="' . get_permalink() . '" title="' . sprintf( __( 'Permanent Link to %s', 'megumi' ), get_the_title() ) . '">' . get_the_title() . '</a></span>';
	$output .= '<time datetime="' . get_the_date( 'c' ) . '">' . get_the_date() . '</time>';
	$output .= $catname . "\n";
	$output .= '</li>' . "\n";
	return apply_filters( 'add_megumi_post_list_type_01', $output );
}

/* *** megumi new post / date & title *** */
function megumi_post_list_type_02() {
	$output  = '<li>';
	$output .= '<time datetime="' . get_the_date( 'c' ) . '">' . get_the_date() . '</time>';
	$output .= '<span class="title"><a href="' . get_permalink() . '" title="' . sprintf( __( 'Permanent Link to %s', 'megumi' ), get_the_title() ) . '">' . get_the_title() . '</a></span>';
	$output .= '</li>' . "\n";
	return apply_filters( 'add_megumi_post_list_type_02', $output );
}

/* *** megumi new post / category & date & title *** */
function megumi_post_list_type_03() {
	$cat = get_the_category();
	$cid = $cat[0]->cat_ID;
	$output  = '<li>';
	$output .= '<span class="cid"><a href="' . get_category_link( $cid ) . '" title="' . sprintf( __( 'Permanent Link to %s', 'megumi' ), get_cat_name( $cid ) ) . '">' . get_cat_name( $cid ) . '</a></span>';
	$output .= '<time datetime="' . get_the_date( 'c' ) . '">' . get_the_date() . '</time>';
	$output .= '<span class="title"><a href="' . get_permalink() . '" title="' . sprintf( __( 'Permanent Link to %s', 'megumi' ), get_the_title() ) . '">' . get_the_title() . '</a></span>';
	$output .= '</li>' . "\n";
	return apply_filters( 'add_megumi_post_list_type_03', $output );
}

/* *** megumi new post / date & category & title *** */
function megumi_post_list_type_04() {
	$cat = get_the_category();
	$cid = $cat[0]->cat_ID;
	$output  = '<li>';
	$output .= '<time datetime="' . get_the_date( 'c' ) . '">' . get_the_date() . '</time>';
	$output .= '<span class="cid"><a href="' . get_category_link( $cid ) . '" title="' . sprintf( __( 'Permanent Link to %s', 'megumi' ), get_cat_name( $cid ) ) . '">' . get_cat_name( $cid ) . '</a></span>';
	$output .= '<span class="title"><a href="' . get_permalink() . '" title="' . sprintf( __( 'Permanent Link to %s', 'megumi' ), get_the_title() ) . '">' . get_the_title() . '</a></span>';
	$output .= '</li>' . "\n";
	return apply_filters( 'add_megumi_post_list_type_04', $output );
}

/* *** megumi new post / date & title & category *** */
function megumi_post_list_type_05() {
	$cat = get_the_category();
	$cid = $cat[0]->cat_ID;
	$output  = '<li>';
	$output .= '<time datetime="' . get_the_date( 'c' ) . '">' . get_the_date() . '</time>';
	$output .= '<span class="title"><a href="' . get_permalink() . '" title="' . sprintf( __( 'Permanent Link to %s', 'megumi' ), get_the_title() ) . '">' . get_the_title() . '</a></span>';
	$output .= '<span class="cid"><a href="' . get_category_link( $cid ) . '" title="' . sprintf( __( 'Permanent Link to %s', 'megumi' ), get_cat_name( $cid ) ) . '">' . get_cat_name( $cid ) . '</a></span>';
	$output .= '</li>' . "\n";
	return apply_filters( 'add_megumi_post_list_type_05', $output );
}

/* *** megumi new post / title only *** */
function megumi_post_list_type_06() {
	$output  = '<li>';
	$output .= '<span class="title"><a href="' . get_permalink() . '" title="' . sprintf( __( 'Permanent Link to %s', 'megumi' ), get_the_title() ) . '">' . get_the_title() . '</a></span>';
	$output .= '</li>' . "\n";
	return apply_filters( 'add_megumi_post_list_type_06', $output );
}

/* *** megumi new post / images & title & excerpt *** */
function megumi_post_list_type_07( $thumb_size ) {
	global $post;
	$output  = '<article class="' . implode( ' ', get_post_class( 'widget', $post->ID ) ) . '">' . "\n";
	if ( has_post_thumbnail() ) {
		$output .= '<p class="thumb"><a href="' . get_permalink() . '" title="' . sprintf( __( 'Permanent Link to %s', 'megumi' ), get_the_title() ) . '">' . get_the_post_thumbnail( $post->ID, $thumb_size ) . '</a></p>' . "\n";
	}
	$output .= '<header class="entry-header">' . "\n";
	$output .= '<h1 class="entry-title"><a href="' . get_permalink() . '" title="' . sprintf( esc_attr__( 'Permalink to %s', 'megumi' ), the_title_attribute( 'echo=0' ) ) . '" rel="bookmark">' . get_the_title() . '</a></h1>' . "\n";
	$output .= '</header><!-- .entry-header -->' . "\n";
	$output .= '<div class="entry-summary">' . "\n";
	$output .= apply_filters( 'the_excerpt', get_the_excerpt() );
	$output .= '</div><!-- .entry-summary -->' . "\n";
	$output .= '</article>' . "\n";
	return apply_filters( 'add_megumi_post_list_type_07', $output );
}

/* *** megumi new post / title & images & excerpt *** */
function megumi_post_list_type_08( $thumb_size ) {
	global $post;
	$output  = '<article class="' . implode( ' ', get_post_class( 'widget', $post->ID ) ) . '">' . "\n";
	$output .= '<header class="entry-header">' . "\n";
	$output .= '<h1 class="entry-title"><a href="' . get_permalink() . '" title="' . sprintf( esc_attr__( 'Permalink to %s', 'megumi' ), the_title_attribute( 'echo=0' ) ) . '" rel="bookmark">' . get_the_title() . '</a></h1>' . "\n";
	$output .= '</header><!-- .entry-header -->' . "\n";
	if ( has_post_thumbnail() ) {
		$output .= '<p class="thumb"><a href="' . get_permalink() . '" title="' . sprintf( __( 'Permanent Link to %s', 'megumi' ), get_the_title() ) . '">' . get_the_post_thumbnail( $post->ID, $thumb_size ) . '</a></p>' . "\n";
	}
	$output .= '<div class="entry-summary">' . "\n";
	$output .= apply_filters( 'the_excerpt', get_the_excerpt() );
	$output .= '</div><!-- .entry-summary -->' . "\n";
	$output .= '</article>' . "\n";
	return apply_filters( 'add_megumi_post_list_type_08', $output );
}

/* *** megumi new post / images & date & excerpt *** */
function megumi_post_list_type_09( $thumb_size ) {
	global $post;
	$output  = '<article class="' . implode( ' ', get_post_class( 'widget', $post->ID ) ) . '">' . "\n";
	if ( has_post_thumbnail() ) {
		$output .= '<p class="thumb"><a href="' . get_permalink() . '" title="' . sprintf( __( 'Permanent Link to %s', 'megumi' ), get_the_title() ) . '">' . get_the_post_thumbnail( $post->ID, $thumb_size ) . '</a></p>' . "\n";
	}
	$output .= '<div class="entry-meta">' . "\n";
	$output .= '<time datetime="' . get_the_date( 'c' ) . '">' . get_the_date() . '</time>';
	$output .= '</div><!-- .entry-meta -->' . "\n";
	$output .= '<div class="entry-summary">' . "\n";
	$output .= apply_filters( 'the_excerpt', get_the_excerpt() );
	$output .= '</div><!-- .entry-summary -->' . "\n";
	$output .= '</article>' . "\n";
	return apply_filters( 'add_megumi_post_list_type_09', $output );
}

/* *** megumi new post / images & excerpt *** */
function megumi_post_list_type_10( $thumb_size ) {
	global $post;
	$output  = '<article class="' . implode( ' ', get_post_class( 'widget', $post->ID ) ) . '">' . "\n";
	if ( has_post_thumbnail() ) {
		$output .= '<p class="thumb"><a href="' . get_permalink() . '" title="' . sprintf( __( 'Permanent Link to %s', 'megumi' ), get_the_title() ) . '">' . get_the_post_thumbnail( $post->ID, $thumb_size ) . '</a></p>' . "\n";
	}
	$output .= '<div class="entry-summary">' . "\n";
	$output .= apply_filters( 'the_excerpt', get_the_excerpt() );
	$output .= '</div><!-- .entry-summary -->' . "\n";
	$output .= '</article>' . "\n";
	return apply_filters( 'add_megumi_post_list_type_10', $output );
}

/* *** megumi new post / images only *** */
function megumi_post_list_type_11( $thumb_size ) {
	global $post;
	if ( has_post_thumbnail() ) {
		$output  = '<article class="' . implode( ' ', get_post_class( 'widget', $post->ID ) ) . '">' . "\n";
		$output .= '<p class="thumb"><a href="' . get_permalink() . '" title="' . sprintf( __( 'Permanent Link to %s', 'megumi' ), get_the_title() ) . '">' . get_the_post_thumbnail( $post->ID, $thumb_size ) . '</a></p>' . "\n";
		$output .= '</article>' . "\n";
	}
	return apply_filters( 'add_megumi_post_list_type_11', $output );
}

/* *** megumi new post more *** */
function megumi_post_list_more( $more, $catid ) {
	if ( $more ) {
		if ( $catid ) {
			$output = '<p class="archive-more"><a href="' . get_category_link( $catid ) . '" title="' . __( 'Article List', 'megumi' ) . '">' . apply_filters( 'more_text', __( 'Article List &nbsp;&raquo;', 'megumi' ) ) . '</a></p>' . "\n";
		} else {
			$output = '<p class="archive-more"><a href="' . get_all_posts_more() . '" title="' . __( 'Article List', 'megumi' ) . '">' . apply_filters( 'more_text', __( 'Article List &nbsp;&raquo;', 'megumi' ) ) . '</a></p>' . "\n";
		}
	}
	return $output;
}

/* *** megumi new post *** */
function megumi_post_list( $args = '' ) {
	global $post;
	$defaults = array(
		'catid'        => 0,
		'type'         => 1,
		'image_size'   => '',
		'callback'     => '',
		'sticky'       => 1,
		'limit'        => 5,
		'orderby'      => 'date',
		'order'        => 'DESC',
		'meta_key'     => '',
		'meta_value'   => '',
		'title'        => __( 'Post list', 'megumi' ),
		'title_type'   => 1,
		'title_src'    => '',
		'title_width'  => '',
		'title_height' => '',
		'title_rss'    => 0,
		'title_class'  => 'new_post_title',
		'list_class'   => 'new_post_list',
		'widget'       => '',
		'more'         => 1,
		'echo'         => 1,
	);
	$r            = wp_parse_args( $args, $defaults );
	$catid        = $r['catid'];
	$type         = $r['type'];
	$image_size   = $r['image_size'];
	$callback     = $r['callback'];
	$on_sticky    = $r['sticky'];
	$get_limit    = $r['limit'];
	$orderby      = $r['orderby'];
	$order        = $r['order'];
	$meta_key     = $r['meta_key'];
	$meta_value   = $r['meta_value'];
	$title        = $r['title'];
	$title_type   = $r['title_type'];
	$title_src    = $r['title_src'];
	$title_width  = $r['title_width'];
	$title_height = $r['title_height'];
	$title_rss    = $r['title_rss'];
	$title_class  = $r['title_class'];
	$list_class   = $r['list_class'];
	$widget       = $r['widget'];
	$more         = $r['more'];
	$echo         = $r['echo'];
	if ( $title ) {
		$get_title = $title;
	}
	if ( $title_class ) {
		$title_class = ' class="' . $title_class . '"';
	} else {
		$title_class = '';
	}
	if ( $list_class ) {
		$list_class = ' class="' . $list_class . '"';
	} else {
		$list_class = '';
	}
	if ( in_array( $widget, megumi_widget_id( array( 'wp_inactive_widgets', 'header-widget-area', 'first-front-page', 'second-front-page', 'third-front-page', 'fourth-front-page' ) ) ) ) {
		$thumb_size = 'small-archives';
	} else {
		if ( $image_size ) {
			$thumb_size = $image_size;
		} else {
			$thumb_size = 'post-archives';
		}
	}
	$sticky = get_option( 'sticky_posts' );
	$get_sticky = implode( ',', $sticky );
	if( $get_sticky && $on_sticky == 1 ) {
		if ( $meta_key && $meta_value ) {
			$sticky_args = array(
				'category'    => $catid,
				'include'     => $get_sticky,
				'meta_key'    => $meta_key,
				'meta_value'  => $meta_value,
			);
		} else {
			$sticky_args = array(
				'category'    => $catid,
				'include'     => $get_sticky,
			);
		}
		$sticky_post  = get_posts( $sticky_args );
		$sticky_count = count( $sticky_post );
		$limit        = $get_limit - $sticky_count;
		if ( $meta_key && $meta_value ) {
			$args = array(
				'numberposts' => $limit,
				'category'    => $catid,
				'orderby'     => $orderby,
				'order'       => $order,
				'exclude'     => $sticky,
				'meta_key'    => $meta_key,
				'meta_value'  => $meta_value,
			);
		} else {
			$args = array(
				'numberposts' => $limit,
				'category'    => $catid,
				'orderby'     => $orderby,
				'order'       => $order,
				'exclude'     => $sticky,
			);
		}
	} else {
		if ( $meta_key && $meta_value ) {
			$args = array(
				'numberposts' => $get_limit,
				'orderby'     => $orderby,
				'order'       => $order,
				'category'    => $catid,
				'meta_key'    => $meta_key,
				'meta_value'  => $meta_value,
			);
		} else {
			$args = array(
				'numberposts' => $get_limit,
				'orderby'     => $orderby,
				'order'       => $order,
				'category'    => $catid,
			);
		}
	}
	$get_posts = get_posts( $args );

	if ( ( !isset($widgetid) || !$widgetid ) && $title ) {
		switch ( $title_type ) {
			case 1:
				$output = megumi_post_list_title( $catid, $title, $title_rss, $title_class );
			break;
			case 2:
				$output = megumi_post_list_title_img( $catid, $title, $title_src, $title_width, $title_height, $title_rss, $title_class );
			break;
		}
	}
	switch ( $type ) {
		case 1:
			if ( $sticky_post || $get_posts ) {
				$output .= '<ul' . $list_class . '>' . "\n";
				if ( $sticky_post ) {
					foreach( $sticky_post as $post ) {
						setup_postdata( $post );
						$output .= megumi_post_list_type_01();
					}
				}
				if ( $get_posts ) {
					foreach( $get_posts as $post ) {
						setup_postdata( $post );
						$output .= megumi_post_list_type_01();
					}
				}
				$output .= '</ul>' . "\n";
				$output .= megumi_post_list_more( $more, $catid );
			}
		break;
		case 2:
			if ( $sticky_post || $get_posts ) {
				$output .= '<ul' . $list_class . '>' . "\n";
				if ( $sticky_post ) {
					foreach( $sticky_post as $post ) {
						setup_postdata( $post );
						$output .= megumi_post_list_type_02();
					}
				}
				if ( $get_posts ) {
					foreach( $get_posts as $post ) {
						setup_postdata( $post );
						$output .= megumi_post_list_type_02();
					}
				}
				$output .= '</ul>' . "\n";
				$output .= megumi_post_list_more( $more, $catid );
			}
		break;
		case 3:
			if ( $sticky_post || $get_posts ) {
				$output .= '<ul' . $list_class . '>' . "\n";
				if ( $sticky_post ) {
					foreach( $sticky_post as $post ) {
						setup_postdata( $post );
						$output .= megumi_post_list_type_03();
					}
				}
				if ( $get_posts ) {
					foreach( $get_posts as $post ) {
						setup_postdata( $post );
						$output .= megumi_post_list_type_03();
					}
				}
				$output .= '</ul>' . "\n";
				$output .= megumi_post_list_more( $more, $catid );
			}
		break;
		case 4:
			if ( $sticky_post || $get_posts ) {
				$output .= '<ul' . $list_class . '>' . "\n";
				if ( $sticky_post ) {
					foreach( $sticky_post as $post ) {
						setup_postdata( $post );
						$output .= megumi_post_list_type_04();
					}
				}
				if ( $get_posts ) {
					foreach( $get_posts as $post ) {
						setup_postdata( $post );
						$output .= megumi_post_list_type_04();
					}
				}
				$output .= '</ul>' . "\n";
				$output .= megumi_post_list_more( $more, $catid );
			}
		break;
		case 5:
			if ( $sticky_post || $get_posts ) {
				$output .= '<ul' . $list_class . '>' . "\n";
				if ( $sticky_post ) {
					foreach( $sticky_post as $post ) {
						setup_postdata( $post );
						$output .= megumi_post_list_type_05();
					}
				}
				if ( $get_posts ) {
					foreach( $get_posts as $post ) {
						setup_postdata( $post );
						$output .= megumi_post_list_type_05();
					}
				}
				$output .= '</ul>' . "\n";
				$output .= megumi_post_list_more( $more, $catid );
			}
		break;
		case 6:
			if ( $sticky_post || $get_posts ) {
				$output .= '<ul' . $list_class . '>' . "\n";
				if ( $sticky_post ) {
					foreach( $sticky_post as $post ) {
						setup_postdata( $post );
						$output .= megumi_post_list_type_06();
					}
				}
				if ( $get_posts ) {
					foreach( $get_posts as $post ) {
						setup_postdata( $post );
						$output .= megumi_post_list_type_06();
					}
				}
				$output .= '</ul>' . "\n";
				$output .= megumi_post_list_more( $more, $catid );
			}
		break;
		case 7:
			if ( $sticky_post || $get_posts ) {
				if ( $sticky_post ) {
					foreach( $sticky_post as $post ) {
						setup_postdata( $post );
						$output .= megumi_post_list_type_07( $thumb_size );
					}
				}
				if ( $get_posts ) {
					foreach( $get_posts as $post ) {
						setup_postdata( $post );
						$output .= megumi_post_list_type_07( $thumb_size );
					}
				}
				$output .= megumi_post_list_more( $more, $catid );
			}
		break;
		case 8:
			if ( $sticky_post || $get_posts ) {
				if ( $sticky_post ) {
					foreach( $sticky_post as $post ) {
						setup_postdata( $post );
						$output .= megumi_post_list_type_08( $thumb_size );
					}
				}
				if ( $get_posts ) {
					foreach( $get_posts as $post ) {
						setup_postdata( $post );
						$output .= megumi_post_list_type_08( $thumb_size );
					}
				}
				$output .= megumi_post_list_more( $more, $catid );
			}
		break;
		case 9:
			if ( $sticky_post || $get_posts ) {
				if ( $sticky_post ) {
					foreach( $sticky_post as $post ) {
						setup_postdata( $post );
						$output .= megumi_post_list_type_09( $thumb_size );
					}
				}
				if ( $get_posts ) {
					foreach( $get_posts as $post ) {
						setup_postdata( $post );
						$output .= megumi_post_list_type_09( $thumb_size );
					}
				}
				$output .= megumi_post_list_more( $more, $catid );
			}
		break;
		case 10:
			if ( $sticky_post || $get_posts ) {
				if ( $sticky_post ) {
					foreach( $sticky_post as $post ) {
						setup_postdata( $post );
						$output .= megumi_post_list_type_10( $thumb_size );
					}
				}
				if ( $get_posts ) {
					foreach( $get_posts as $post ) {
						setup_postdata( $post );
						$output .= megumi_post_list_type_10( $thumb_size );
					}
				}
				$output .= megumi_post_list_more( $more, $catid );
			}
		break;
		case 11:
			if ( $sticky_post || $get_posts ) {
				if ( $sticky_post ) {
					foreach( $sticky_post as $post ) {
						setup_postdata( $post );
						$output .= megumi_post_list_type_11( $thumb_size );
					}
				}
				if ( $get_posts ) {
					foreach( $get_posts as $post ) {
						setup_postdata( $post );
						$output .= megumi_post_list_type_11( $thumb_size );
					}
				}
				$output .= megumi_post_list_more( $more, $catid );
			}
		break;
		case 12:
			if ( $sticky_post || $get_posts ) {
				if ( $sticky_post ) {
					foreach( $sticky_post as $post ) {
						setup_postdata( $post );
						$output .= $callback( $list_class );
					}
				}
				if ( $get_posts ) {
					foreach( $get_posts as $post ) {
						setup_postdata( $post );
						$output .= $callback( $list_class );
					}
				}
				$output .= megumi_post_list_more( $more, $catid );
			}
		break;
	}
	wp_reset_query();
	if ( $echo == 1 ) {
		echo $output;
	} else {
		return $output;
	}
}

/* *** megumi related posts *** */
function megumi_related_posts( $args = '' ) {
	global $wpdb, $post;
	$defaults = array(
		'class' => 'related_posts',
		'title' => __( 'Related Articles', 'megumi'),
		'date'  => 1,
		'thumb' => 0,
		'limit' => 5,
		'echo'  => 1,
	);
	$r      = wp_parse_args( $args, $defaults );
	$class  = $r['class'];
	$title  = $r['title'];
	$date   = $r['date'];
	$thumb  = $r['thumb'];
	$limit  = $r['limit'];
	$echo   = $r['echo'];
	$postid = $post->ID;
	if ( $class ) {
		$class = ' class="' . $class . '"';
	} else {
		$class = '';
	}
	$args = array(
		'hierarchical' => false,
		'show_ui'      => true,
		'public'       => true,
	); 
	$objects    = 'names';
	$operator   = 'and';
	$taxonomies = get_taxonomies( $args, $objects, $operator );
	foreach ( $taxonomies as $value ){
		$get_terms = get_the_terms( $post->ID, $value );
		if ( $get_terms ) {
			foreach ( $get_terms as $value ){
				$term_id[] = $value->term_id;
			}
		} else {
			$term_id = '';
		}
	}
	if ( $term_id ) {
		$term_id  = implode( ',', $term_id );
		$get_post = $wpdb->get_results( $wpdb->prepare( "SELECT DISTINCT (ID), post_date, post_title, post_status, post_name, guid FROM $wpdb->posts left join $wpdb->term_relationships on $wpdb->posts.ID = $wpdb->term_relationships.object_id WHERE post_status = 'publish' AND ID != $postid AND term_taxonomy_id IN ($term_id) AND post_date != '0000-00-00 00:00:00' ORDER BY post_date DESC LIMIT $limit" ) , OBJECT );
		if ( $get_post ) {
			if ( $title ) {
				$output .= '<h2 class="related_posts_title">' . $title . '</h2>' . "\n";
			}
			$output .= '<ul' . $class . '>' . "\n";
			foreach ( $get_post as $post ) {
				setup_postdata( $post );
				if ( $thumb == 1 ) {
					if ( has_post_thumbnail() ) { 
						$output .= '<li class="thumb">';
						$output .= '<span class="thumb"><a href="' . get_permalink() . '" title="' . sprintf( __( 'Permanent Link to %s', 'megumi' ), get_the_title() ) . '">' . get_the_post_thumbnail( $post->ID, apply_filters( 'add_related_posts_thumb', 'small-archives' ) ) . '</a></span>' . "\n";
					} else {
						$output .= '<li>';
					}
				} else {
					$output .= '<li>';
				}
				if ( $date == 1 ) {
					$output .= '<time datetime="' . get_the_date( 'c' ) . '">' . get_the_date() . '</time>' . "\n";
				}
				$output .= '<span class="title"><a href="' . get_permalink() . '" title="' . sprintf( __( 'Permanent Link to %s', 'megumi' ), get_the_title() ) . '">' . get_the_title() . '</a></span>' . "\n";
				$output .= '</li>' . "\n";
			}
			$output .= '</ul>' . "\n";
		}
		wp_reset_query();
		if ( $echo == 1 ) {
			echo $output;
		} else {
			return $output;
		}
	}
}

/* *** megumi comment *** */
function megumi_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer>
				<div class="comment-author vcard">
					<?php echo get_avatar( $comment, 40 ); ?>
					<?php printf( __( '%s <span class="says">says:</span>', 'megumi' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
				</div><!-- .comment-author .vcard -->
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em><?php _e( 'Your comment is awaiting moderation.', 'megumi' ); ?></em>
					<br>
				<?php endif; ?>

				<div class="comment-meta commentmetadata">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time pubdate datetime="<?php comment_time( 'c' ); ?>">
					<?php
						/* translators: 1: date, 2: time */
						printf( __( '%1$s at %2$s', 'megumi' ), get_comment_date(),  get_comment_time() ); ?>
					</time></a>
					<?php edit_comment_link( __( '(Edit)', 'megumi' ), ' ' );
					?>
				</div><!-- .comment-meta .commentmetadata -->
			</footer>

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-##  -->
	<?php
		break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'megumi' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'megumi' ), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}

/* = Side Area
-------------------------------------------------------------- */
/* *** megumi banner *** */
function megumi_banner( $args = '' ) {
	$defaults = array(
		'href'   => '',
		'title'  => '',
		'target' => '',
		'src'    => '',
		'width'  => '',
		'height' => '',
		'alt'    => '',
		'class'  => '',
		'echo'   => 1,
	);
	$r      = wp_parse_args( $args, $defaults );
	$href   = esc_html( $r['href'] );
	$title  = $r['title'];
	$target = $r['target'];
	$src    = esc_html( $r['src'] );
	$width  = $r['width'];
	$height = $r['height'];
	$alt    = $r['alt'];
	$class  = $r['class'];
	$echo   = $r['echo'];
	if ( $target ) {
		$target = ' target="' . $target . '"';
	} else {
		$target = '';
	}
	if ( $class ) {
		$class = ' class="' . $class . '"';
	} else {
		$class = '';
	}
	$output = '<p' . $class . '>' . "\n";
	if ( $href ) {
		$output .= '<a href="' . $href . '" title="' . $title . '"' . $target . '>';
		$output .= '<img src="' . $src . '" width="' . $width . '" height="' . $height . '" alt="' . $alt . '">';
		$output .= '</a>' . "\n";
	} else {
		$output .= '<img src="' . $src . '" width="' . $width . '" height="' . $height . '" alt="' . $alt . '">';
	}
	$output .= '</p>' . "\n";
	if ( $echo == 1 ) {
		echo $output;
	} else {
		return $output;
	}
}

/* *** megumi child nav *** */
function megumi_child_nav( $postid, $echo = 1 ) {
	global $post;
	$get_main_parent = array_pop( get_post_ancestors( $postid ) );
	$get_parent      = get_post_ancestors( $postid );
	$get_child       = isset($post->ID) ? get_pages( 'child_of=' . $post->ID ) : false;
	if ( $get_child || $get_main_parent > 0) {
		$output = '<h2><a href="' . get_permalink( $get_main_parent ) . '">' . get_the_title( $get_main_parent ) . '</a></h2>' . "\n";
		if ( $get_main_parent ) {
			$get_page = get_pages( 'child_of=' . $get_main_parent );
			if ( $get_page ) {
				foreach ( $get_page as $pid ) {
					if ( $pid->post_parent == $postid || $pid->post_parent == $get_main_parent || in_array( $pid->post_parent, $get_parent) ) {
						$get_pid[] = $pid->ID;
					}
				}
				$pid = implode( ',', $get_pid );
				$output .= '<ul class="child_nav">';
				$output .= wp_list_pages( 'sort_column=menu_order&include=' . $pid . '&title_li=&echo=0' );
				$output .= '</ul>';
			}
		} else {
			$get_page = get_pages( 'child_of=' . $postid );
			echo $get_main_parent;
			if ( $get_page ) {
				foreach ( $get_page as $pid ) {
					if ( $pid->post_parent == $postid ) {
						$get_pid[] = $pid->ID;
					}
				}
				$pid = implode( ',', $get_pid );
				$output .= '<ul class="child_nav">';
				$output .= wp_list_pages( 'sort_column=menu_order&child_of=' . $postid . '&title_li=&echo=0&depth=1' );
				$output .= '</ul>';
			}
		}
		return $output;
	}
}

/* = Footer Area
-------------------------------------------------------------- */
/* *** copyright year *** */
function copyright_year( $year ) {
	if ( !$year ) {
		$year = date( 'Y' );
	}
	$year = apply_filters( 'change_copyright_year', $year );
	$get_year = date( 'Y' );
	if ( $get_year == $year ) {
		$output = $year;
	} else {
		$output = $year . ' - ' . date( 'Y' );
	}
	return $output;
}

/* *** copyright *** */
function megumi_copyright() {
	$output = '<p id="copyright"><small>Copyright &copy; ' . copyright_year( 2011 ) . ' <a href="' . home_url( '/' ) . '" title="' .esc_attr( get_bloginfo( 'name', 'display' ) ) . '" rel="home">' . get_bloginfo( 'name' ) . '</a></small></p>' . "\n";
	echo apply_filters( 'add_megumi_copyright', $output );
}

/* *** site generator *** */
function site_generator() {
	$output = '<div id="site-generator">' . "\n";
	$output .= '<p id="generator"><a href="' . esc_url( __( 'http://wordpress.org/', 'megumi' ) ) . '" title="' . esc_attr__( 'Semantic Personal Publishing Platform', 'megumi' ) . '" rel="generator">' . sprintf( __( 'Proudly powered by %s.', 'megumi' ), 'WordPress' ) . '</a></p>' . "\n";
	$output .= '<p id="themes-generator"><a href="' . esc_url( __( 'http://www.megumithemes.com/', 'megumi' ) ) . '" title="' . esc_attr__( 'Semantic Personal Publishing Themes', 'megumi' ) . '" class="megumi" >' . sprintf( __( 'Theme by %s.', 'megumi'), 'MEGUMI' ) . '</a></p>' . "\n";
	$output .= '</div><!-- #site-generator -->' . "\n";
	echo apply_filters( 'add_site_generator', $output );
}

/* *** Footer Page Navs \*\ megumi_footer_menu \*\ *** */
function megumi_footer_menu() {
	$output = '<nav id="footer-menu-box" class="footer-menu-box">' . "\n";
	$output .= '<ul id="footer-menu" class="footer-menu">' . "\n";
	$output .= wp_list_pages( 'depth=1&title_li=&echo=0' );
	$output .= '</ul>' . "\n";
	$output .= '</nav>' . "\n";
	echo $output;
}

/* *** Megumi Footer Navigation *** */
function megumi_footer_nav( $args = '' ) {
	global $post;
		$defaults = array(
		'echo' => 1,
	);
	$r      = wp_parse_args( $args, $defaults );
	$echo   = $r['echo'];
	$output = wp_nav_menu( array( 'menu' => 'footer_menu', 'container' => 'nav', 'container_class' => 'footer-menu-box', 'container_id' => 'footer-menu-box', 'menu_class' => 'footer-menu', 'menu_id' => 'footer-menu', 'echo' => true, 'fallback_cb' => 'megumi_footer_menu', 'theme_location' => 'footer_menu' ) );
	if ( $echo == 1 ) {
		echo $output;
	} else {
		return $output;
	}
}

/* = Other
-------------------------------------------------------------- */
/** megumi home on **/
function megumi_home_on() {
	if ( file_exists( MEGUMI_THEME_DIR . '/front-page.php' ) ) {
		return apply_filters( 'add_megumi_home_on', TRUE );
	} else {
		return FALSE;
	}
}

add_action('template_redirect', 'check_front_page_template', 11);
function check_front_page_template() {
	if ( is_home() || is_front_page() ) {
		if ( !megumi_home_on() ) {
			if ( get_option( 'template' ) == get_option( 'stylesheet' ) || !file_exists( MEGUMI_CHILD_THEME_DIR . '/index.php' ) ) {
				include( MEGUMI_THEME_DIR . '/index.php');
				exit;
			} else {
				include( MEGUMI_CHILD_THEME_DIR . '/index.php');
				exit;
			}
		}
	}
}

/** megumi side on **/
function megumi_side_on() {
	if ( file_exists( MEGUMI_THEME_DIR . '/front-page.php' ) ) {
		return apply_filters( 'add_megumi_side_on', TRUE );
	} else {
		return FALSE;
	}
}

/** megumi side on class **/
function megumi_side_on_class() {
	if ( !megumi_side_on() ) {
		$value = ' class="one-column"';
		return apply_filters( 'add_megumi_side_on_class', $value );
	}
}

/** Redirect URL **/
add_action('get_header', 'redirect_301');
function redirect_301() {
	global $post;
	if(is_search()) {
	} else {
		$get_redirect_url = isset($post->ID) ? get_post_meta( $post->ID, 'redirect_url', $single = true ) : false;
		if ( is_single() || is_page() ) {
			if( $get_redirect_url ) {
				$redirect_url = $get_redirect_url;
				header( "HTTP/1.1 301 Moved Permanently" ); 
				header( "Location: $get_redirect_url" ); 
			}
		}
	}
}

/** Page Navigation ** Thank you. Yuriko's **/
function tab_nav() {
	global $wp_query, $paged, $wp_rewrite;
	$paginate_base = get_pagenum_link(1);
	$output = '<p class="tab_nav">';
	if (strpos($paginate_base, '?') || ! $wp_rewrite->using_permalinks()) {
		$paginate_format = '';
		$paginate_base   = add_query_arg( 'paged', '%#%' );
	} else {
		$paginate_format = (substr($paginate_base, -1 ,1) == '/' ? '' : '/') .
		user_trailingslashit( 'page/%#%/', 'paged' );
		$paginate_base .= '%_%';
	}
	$output .= paginate_links( array(
		'base'      => $paginate_base,
		'format'    => $paginate_format,
		'prev_text' => __( '&laquo;' ),
		'next_text' => __( '&raquo;' ),
		'total'     => $wp_query->max_num_pages,
		'mid_size'  => 5,
		'current'   => ($paged ? $paged : 1),
	));
	$output .= '</p>';
	return $output;
}

/** Page Navigation ** Thank you. Yuriko's **/
function add_tab_nav() {
	global $wp_query, $paged, $wp_rewrite;
	if ( $wp_query->max_num_pages > 1 ) {
		$output = '<nav id="nav-above">' . "\n";
		$output .= tab_nav();
		$output .= '</nav><!-- #nav-above -->' . "\n";
		echo $output;
	}
}

/** Single Page Navigation **/
function add_single_nav() { ?>
	<nav id="nav-below">
	<p class="nav-previous"><?php previous_post_link(); ?></p>
	<p class="nav-next"><?php next_post_link(); ?></p>
	</nav><!-- #nav-below -->
<?php }

/** Single Page Navigation **/
function add_comments_view() {
	if ( megumi_comments_view() ) {
		comments_template( '', true );
	}
}
