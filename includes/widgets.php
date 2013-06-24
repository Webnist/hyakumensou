<?php
/* *** Child Page Nav *** */
//add_action( 'widgets_init', 'Add_Megumi_Widget_Child_Page' );
function Add_Megumi_Widget_Child_Page() {
	register_widget( 'Megumi_Widget_Child_Page' );
}
class Megumi_Widget_Child_Page extends WP_Widget {
	function Megumi_Widget_Child_Page() {
		$widget_ops = array(
			'classname'   => 'megumi_child_page',
			'description' => __( 'If the page displays the current page the child.', 'megumi' ),
		);
		$this->WP_Widget( 'megumi_child_page_nav', __( 'Megumi Child Page Nav', 'megumi' ), $widget_ops );
	}
	function widget( $args, $instance ) {
		global $post;
		extract( $args );
		if ( is_page() ) {
			echo $before_widget;
			echo megumi_child_nav( $post->ID );
			echo $after_widget;
		}
	}
}

/* *** megumi banner *** */
add_action( 'widgets_init', 'Add_Megumi_Widget_Megumi_Banner' );
function Add_Megumi_Widget_Megumi_Banner() {
	register_widget( 'Megumi_Widget_Megumi_Banner' );
}
class Megumi_Widget_Megumi_Banner extends WP_Widget {
	function Megumi_Widget_Megumi_Banner() {
		$widget_ops = array(
			'classname'   => 'megumi_banner',
			'description' => __( 'Set the banner.', 'megumi' ),
		);
		$this->WP_Widget( 'megumi_banner', __( 'Megumi Banner', 'megumi' ), $widget_ops );
	}

	function form( $instance ) {
		global $post;
		$instance = wp_parse_args(
						(array) $instance, array(
							'href'   => '',
							'title'  => '',
							'target' => '',
							'src'    => '',
							'width'  => '',
							'height' => '',
							'alt'    => '',
							'class'  => '',
						)
					);
		$href   = esc_url( $instance['href'] );
		$title  = esc_attr( $instance['title'] );
		$target = intval( $instance['target'] );
		$src    = esc_url( $instance['src'] );
		$width  = intval( $instance['width'] );
		$height = intval( $instance['height'] );
		$alt    = esc_attr( $instance['alt'] );
		$class  = esc_attr( $instance['class'] );
		$output = '<p>' . "\n";
		$output .= '<label for="' . $this->get_field_id( 'href' ) . '">' . "\n";
		$output .= __( 'URL:', 'megumi' ) ."\n";
		$output .= '<input class="widefat" name="' . $this->get_field_name( 'href' ) . '" id="' . $this->get_field_id( 'href' ) . '" type="text" value="' . $href . '" />' . "\n";
		$output .= '</label>' . "\n";
		$output .= '</p>' . "\n";
		$output .= '<p>' . "\n";
		$output .= '<label for="' . $this->get_field_id( 'title' ) . '">' . "\n";
		$output .= __( 'Link Title:', 'megumi' ) ."\n";
		$output .= '<input class="widefat" name="' . $this->get_field_name( 'title' ) . '" id="' . $this->get_field_id( 'title' ) . '" type="text" value="' . $title . '" />' . "\n";
		$output .= '</label>' . "\n";
		$output .= '</p>' . "\n";
		$output .= '<p>' . "\n";
		$output .= '<label for="' . $this->get_field_id( 'target' ) . '">' . "\n";
		$output .= '<input class="checkbox" name="' . $this->get_field_name( 'target' ) . '" id="' . $this->get_field_id( 'target' ) . '" type="checkbox" value="1"';
		if ( $target == 1 ) {
			$output .= ' checked';
		}
		$output .= ' />' . "\n";
		$output .= __( 'Open link in a new window/tab', 'megumi' ) ."\n";
		$output .= '</label>' . "\n";
		$output .= '</p>' . "\n";
		$output .= '<p>' . "\n";
		$output .= '<label for="' . $this->get_field_id( 'src' ) . '">' . "\n";
		$output .= __( 'Images SRC:', 'megumi' ) ."\n";
		$output .= '<input class="widefat" name="' . $this->get_field_name( 'src' ) . '" id="' . $this->get_field_id( 'src' ) . '" type="text" value="' . $src . '" />' . "\n";
		$output .= '</label>' . "\n";
		$output .= '</p>' . "\n";
		$output .= '<p>' . "\n";
		$output .= '<label for="' . $this->get_field_id( 'width' ) . '">' . "\n";
		$output .= __( 'Width:', 'megumi' ) ."\n";
		$output .= '<input class="widefat" name="' . $this->get_field_name( 'width' ) . '" id="' . $this->get_field_id( 'width' ) . '" type="text" value="' . $width . '" />' . "\n";
		$output .= '</label>' . "\n";
		$output .= '</p>' . "\n";
		$output .= '<p>' . "\n";
		$output .= '<label for="' . $this->get_field_id( 'height' ) . '">' . "\n";
		$output .= __( 'Height:', 'megumi' ) ."\n";
		$output .= '<input class="widefat" name="' . $this->get_field_name( 'height' ) . '" id="' . $this->get_field_id( 'height' ) . '" type="text" value="' . $height . '" />' . "\n";
		$output .= '</label>' . "\n";
		$output .= '</p>' . "\n";
		$output .= '<p>' . "\n";
		$output .= '<label for="' . $this->get_field_id( 'alt' ) . '">' . "\n";
		$output .= __( 'alt:', 'megumi' ) ."\n";
		$output .= '<input class="widefat" name="' . $this->get_field_name( 'alt' ) . '" id="' . $this->get_field_id( 'alt' ) . '" type="text" value="' . $alt . '" />' . "\n";
		$output .= '</label>' . "\n";
		$output .= '</p>' . "\n";
		$output .= '<p>' . "\n";
		$output .= '<label for="' . $this->get_field_id( 'class' ) . '">' . "\n";
		$output .= __( 'class:', 'megumi' ) ."\n";
		$output .= '<input class="widefat" name="' . $this->get_field_name( 'class' ) . '" id="' . $this->get_field_id( 'class' ) . '" type="text" value="' . $class . '" />' . "\n";
		$output .= '</label>' . "\n";
		$output .= '</p>' . "\n";
		echo $output;
	}

	function update( $new_instance, $old_instance ) {
		$instance           = $old_instance;
		$instance['href']   = esc_html( $new_instance['href'] );
		$instance['title']  = strip_tags( $new_instance['title'] );
		$instance['target'] = (int) $new_instance['target'];
		$instance['src']    = esc_html( $new_instance['src'] );
		$instance['width']  = (int) $new_instance['width'];
		$instance['height'] = (int) $new_instance['height'];
		$instance['alt']    = strip_tags( $new_instance['alt'] );
		$instance['class']  = strip_tags( $new_instance['class'] );
		return $instance;
	}

	function widget( $args, $instance ) {
		extract( $args );
		$href   = ( $instance['href'] ) ? esc_html( $instance['href'] ) : '';
		$title  = ( $instance['title'] ) ? strip_tags( $instance['title'] ) : '';
		$target = ( $instance['target'] ) ? '_blank' : '';
		$src    = ( $instance['src'] ) ? esc_html( $instance['src'] ) : '';
		$width  = ( $instance['width'] ) ? (int) $instance['width'] : '';
		$height = ( $instance['height'] ) ? (int) $instance['height'] : '';
		$alt    = ( $instance['alt'] ) ? strip_tags( $instance['alt'] ) : '';
		$class  = ( $instance['class'] ) ? strip_tags( $instance['class'] ) : '';
		echo $before_widget;
		megumi_banner( 'href=' . $href . '&title=' . $title . '&target=' . $target . '&src=' . $src . '&width=' . $width . '&height=' . $height . '&alt=' . $alt . '&class=' . $class );
		echo $after_widget;
	}
}

/* *** megumi content banner *** */
add_action( 'widgets_init', 'Add_Megumi_Widget_Megumi_Content_Banner' );
function Add_Megumi_Widget_Megumi_Content_Banner() {
	register_widget( 'Megumi_Widget_Megumi_Content_Banner' );
}
class Megumi_Widget_Megumi_Content_Banner extends WP_Widget {
	function Megumi_Widget_Megumi_Content_Banner() {
		$widget_ops = array(
			'classname'   => 'megumi_content_banner',
			'description' => __( 'Place the banner for site content.', 'megumi' ),
		);
		$this->WP_Widget( 'megumi_content_banner', __( 'Megumi Content Banner', 'megumi' ), $widget_ops );
	}
	function form( $instance ) {
		global $post;
		$instance = wp_parse_args(
						(array) $instance, array(
							'on'      => '',
							'tsrc'    => '',
							'twidth'  => '',
							'theight' => '',
							'ttitle'  => '',
							'talt'    => '',
							'tlink'   => '',
							'tolink'  => '1',
							'pid'     => '',
							'href'    => '',
							'title'   => '',
							'target'  => '',
							'src'     => '',
							'width'   => '',
							'height'  => '',
							'alt'     => '',
							'class'   => '',
						)
					);
		$on      = intval( $instance['on'] );
		$tsrc    = esc_url( $instance['tsrc'] );
		$twidth  = intval( $instance['twidth'] );
		$theight = intval( $instance['theight'] );
		$ttitle  = esc_attr( $instance['ttitle'] );
		$talt    = esc_attr( $instance['talt'] );
		$tlink   = intval( $instance['tlink'] );
		$tolink  = intval( $instance['tolink'] );
		$pid     = intval( $instance['pid'] );
		$href    = esc_url( $instance['href'] );
		$title   = esc_attr( $instance['title'] );
		$target  = intval( $instance['target'] );
		$src     = esc_url( $instance['src'] );
		$width   = intval( $instance['width'] );
		$height  = intval( $instance['height'] );
		$alt     = esc_attr( $instance['alt'] );
		$class   = esc_attr( $instance['class'] );

		$output  = '<p>' . "\n";
		$output .= '<label for="' . $this->get_field_id( 'on' ) . '">' . "\n";
		$output .= '<input class="checkbox" name="' . $this->get_field_name( 'on' ) . '" id="' . $this->get_field_id( 'on' ) . '" type="checkbox" value="1"';
		if ( $on == 1 ) {
			$output .= ' checked';
		}
		$output .= ' />' . "\n";
		$output .= __( 'Use the title picture.', 'megumi' ) ."\n";
		$output .= '</label>' . "\n";
		$output .= '</p>' . "\n";
		$output .= '<p>' . "\n";
		$output .= '<label for="' . $this->get_field_id( 'tsrc' ) . '">' . "\n";
		$output .= __( 'Title Images SRC:', 'megumi' ) ."\n";
		$output .= '<input class="widefat" name="' . $this->get_field_name( 'tsrc' ) . '" id="' . $this->get_field_id( 'tsrc' ) . '" type="text" value="' . $tsrc . '" />' . "\n";
		$output .= '</label>' . "\n";
		$output .= '</p>' . "\n";
		$output .= '<p>' . "\n";
		$output .= '<label for="' . $this->get_field_id( 'twidth' ) . '">' . "\n";
		$output .= __( 'Title Imeges Width:', 'megumi' ) ."\n";
		$output .= '<input class="widefat" name="' . $this->get_field_name( 'twidth' ) . '" id="' . $this->get_field_id( 'twidth' ) . '" type="text" value="' . $twidth . '" />' . "\n";
		$output .= '</label>' . "\n";
		$output .= '</p>' . "\n";
		$output .= '<p>' . "\n";
		$output .= '<label for="' . $this->get_field_id( 'theight' ) . '">' . "\n";
		$output .= __( 'Title Imeges Height:', 'megumi' ) ."\n";
		$output .= '<input class="widefat" name="' . $this->get_field_name( 'theight' ) . '" id="' . $this->get_field_id( 'theight' ) . '" type="text" value="' . $theight . '" />' . "\n";
		$output .= '</label>' . "\n";
		$output .= '</p>' . "\n";
		$output .= '<p>' . "\n";
		$output .= '<label for="' . $this->get_field_id( 'talt' ) . '">' . "\n";
		$output .= __( 'Title images alt:', 'megumi' ) ."\n";
		$output .= '<input class="widefat" name="' . $this->get_field_name( 'talt' ) . '" id="' . $this->get_field_id( 'talt' ) . '" type="text" value="' . $talt . '" />' . "\n";
		$output .= '</label>' . "\n";
		$output .= '</p>' . "\n";
		$output .= '<p>' . "\n";
		$output .= '<label for="' . $this->get_field_id( 'tlink' ) . '">' . "\n";
		$output .= '<input class="checkbox" name="' . $this->get_field_name( 'tlink' ) . '" id="' . $this->get_field_id( 'tlink' ) . '" type="checkbox" value="1"';
		if ( $tlink == 1 ) {
			$output .= ' checked';
		}
		$output .= ' />' . "\n";
		$output .= __( 'A link to the title.', 'megumi' ) ."\n";
		$output .= '</label>' . "\n";
		$output .= '</p>' . "\n";
		$output .= '<p>' . "\n";
		$output .= '<label for="' . $this->get_field_id( 'tolink' ) . '-id">' . "\n";
		$output .= '<input class="checkbox" name="' . $this->get_field_name( 'tolink' ) . '" id="' . $this->get_field_id( 'tolink' ) . '-id" type="radio" value="1"';
		if ( $tolink == 1 ) {
			$output .= ' checked';
		}
		$output .= ' />' . "\n";
		$output .= __( ':By ID', 'megumi') ."\n";
		$output .= '</label>' . "\n";
		$output .= '<label for="' . $this->get_field_id( 'tolink' ) . '-url">' . "\n";
		$output .= '<input class="checkbox" name="' . $this->get_field_name( 'tolink' ) . '" id="' . $this->get_field_id( 'tolink' ) . '-url" type="radio" value="2"';
		if ( $tolink == 2 ) {
			$output .= ' checked';
		}
		$output .= ' />' . "\n";
		$output .= __( ':ByURL', 'megumi') ."\n";
		$output .= '</label>' . "\n";
		$output .= '</p>' . "\n";
		$output .= '<p>' . "\n";
		$output .= '<label for="' . $this->get_field_id( 'pid' ) . '">' . "\n";
		$output .= __( 'Specifies the ID:', 'megumi' ) ."\n";
		$output .= '<input class="widefat" name="' . $this->get_field_name( 'pid' ) . '" id="' . $this->get_field_id( 'pid' ) . '" type="text" value="' . $pid . '" />' . "\n";
		$output .= '</label>' . "\n";
		$output .= '</p>' . "\n";
		
		$output .= '<p>' . "\n";
		$output .= '<label for="' . $this->get_field_id( 'href' ) . '">' . "\n";
		$output .= __( 'Specify URL:', 'megumi' ) ."\n";
		$output .= '<input class="widefat" name="' . $this->get_field_name( 'href' ) . '" id="' . $this->get_field_id( 'href' ) . '" type="text" value="' . $href . '" />' . "\n";
		$output .= '</label>' . "\n";
		$output .= '</p>' . "\n";
		$output .= '<p>' . "\n";
		$output .= '<label for="' . $this->get_field_id( 'title' ) . '">' . "\n";
		$output .= __( 'Link Title:', 'megumi' ) ."\n";
		$output .= '<input class="widefat" name="' . $this->get_field_name( 'title' ) . '" id="' . $this->get_field_id( 'title' ) . '" type="text" value="' . $title . '" />' . "\n";
		$output .= '</label>' . "\n";
		$output .= '</p>' . "\n";
		$output .= '<p>' . "\n";
		$output .= '<label for="' . $this->get_field_id( 'target' ) . '">' . "\n";
		$output .= '<input class="checkbox" name="' . $this->get_field_name( 'target' ) . '" id="' . $this->get_field_id( 'target' ) . '" type="checkbox" value="1"';
		if ( $target == 1 ) {
			$output .= ' checked';
		}
		$output .= ' />' . "\n";
		$output .= __( 'Open link in a new window/tab', 'megumi' ) ."\n";
		$output .= '</label>' . "\n";
		$output .= '</p>' . "\n";
		$output .= '<p>' . "\n";
		$output .= '<label for="' . $this->get_field_id( 'src' ) . '">' . "\n";
		$output .= __( 'Images SRC:', 'megumi' ) ."\n";
		$output .= '<input class="widefat" name="' . $this->get_field_name( 'src' ) . '" id="' . $this->get_field_id( 'src' ) . '" type="text" value="' . $src . '" />' . "\n";
		$output .= '</label>' . "\n";
		$output .= '</p>' . "\n";
		$output .= '<p>' . "\n";
		$output .= '<label for="' . $this->get_field_id( 'width' ) . '">' . "\n";
		$output .= __( 'Width:', 'megumi' ) ."\n";
		$output .= '<input class="widefat" name="' . $this->get_field_name( 'width' ) . '" id="' . $this->get_field_id( 'width' ) . '" type="text" value="' . $width . '" />' . "\n";
		$output .= '</label>' . "\n";
		$output .= '</p>' . "\n";
		$output .= '<p>' . "\n";
		$output .= '<label for="' . $this->get_field_id( 'height' ) . '">' . "\n";
		$output .= __( 'Height:', 'megumi' ) ."\n";
		$output .= '<input class="widefat" name="' . $this->get_field_name( 'height' ) . '" id="' . $this->get_field_id( 'height' ) . '" type="text" value="' . $height . '" />' . "\n";
		$output .= '</label>' . "\n";
		$output .= '</p>' . "\n";
		$output .= '<p>' . "\n";
		$output .= '<label for="' . $this->get_field_id( 'alt' ) . '">' . "\n";
		$output .= __( 'alt:', 'megumi' ) ."\n";
		$output .= '<input class="widefat" name="' . $this->get_field_name( 'alt' ) . '" id="' . $this->get_field_id( 'alt' ) . '" type="text" value="' . $alt . '" />' . "\n";
		$output .= '</label>' . "\n";
		$output .= '</p>' . "\n";
		$output .= '<p>' . "\n";
		$output .= '<label for="' . $this->get_field_id( 'class' ) . '">' . "\n";
		$output .= __( 'class:', 'megumi' ) ."\n";
		$output .= '<input class="widefat" name="' . $this->get_field_name( 'class' ) . '" id="' . $this->get_field_id( 'class' ) . '" type="text" value="' . $class . '" />' . "\n";
		$output .= '</label>' . "\n";
		$output .= '</p>' . "\n";
		echo $output;
	}

	function update( $new_instance, $old_instance ) {
		$instance            = $old_instance;
		$instance['on']      = $new_instance['on'];
		$instance['tsrc']    = esc_html( $new_instance['tsrc'] );
		$instance['twidth']  = (int) $new_instance['twidth'];
		$instance['theight'] = (int) $new_instance['theight'];
		$instance['ttitle']  = strip_tags( $new_instance['ttitle'] );
		$instance['talt']    = strip_tags( $new_instance['talt'] );
		$instance['tlink']   = (int) $new_instance['tlink'];
		$instance['tolink']  = (int) $new_instance['tolink'];
		$instance['pid']     = (int) $new_instance['pid'];
		$instance['href']    = esc_html( $new_instance['href'] );
		$instance['title']   = strip_tags( $new_instance['title'] );
		$instance['target']  = (int) $new_instance['target'];
		$instance['src']     = esc_html( $new_instance['src'] );
		$instance['width']   = (int) $new_instance['width'];
		$instance['height']  = (int) $new_instance['height'];
		$instance['alt']     = strip_tags( $new_instance['alt'] );
		$instance['class']   = strip_tags( $new_instance['class'] );
		return $instance;
	}

	function widget( $args, $instance ) {
		extract( $args );
		$on      = ( $instance['on'] ) ? $instance['on'] : '';
		$tsrc    = ( $instance['tsrc'] ) ? esc_html( $instance['tsrc'] ) : '';
		$twidth  = ( $instance['twidth'] ) ? (int) $instance['twidth'] : '';
		$theight = ( $instance['theight'] ) ? (int) $instance['theight'] : '';
		$ttitle  = ( $instance['ttitle'] ) ? strip_tags( $instance['ttitle'] ) : '';
		$talt    = ( $instance['talt'] ) ? strip_tags( $instance['talt'] ) : '';
		$tlink   = ( $instance['tlink'] ) ? (int) $instance['tlink'] : '';
		$tolink  = ( $instance['tolink'] ) ? (int) $instance['tolink'] : 1;
		$pid     = ( $instance['pid'] ) ? (int) $instance['pid'] : '';
		$href    = ( $instance['href'] ) ? esc_html( $instance['href'] ) : '';
		$title   = ( $instance['title'] ) ? strip_tags( $instance['title'] ) : '';
		$target  = ( $instance['target'] ) ? '_blank' : '';
		$src     = ( $instance['src'] ) ? esc_html( $instance['src'] ) : '';
		$width   = ( $instance['width'] ) ? (int) $instance['width'] : '';
		$height  = ( $instance['height'] ) ? (int) $instance['height'] : '';
		$alt     = ( $instance['alt'] ) ? strip_tags( $instance['alt'] ) : '';
		$class   = ( $instance['class'] ) ? strip_tags( $instance['class'] ) : '';
		echo $before_widget;
		megumi_content_banner( 'on=' . $on . '&tsrc=' . $tsrc . '&twidth=' . $twidth . '&theight=' . $theight . '&ttitle=' . $ttitle . '&talt=' . $talt . '&tlink=' . $tlink . '&tolink=' . $tolink . '&id=' . $id . '&href=' . $href . '&title=' . $title . '&target=' . $target . '&src=' . $src . '&width=' . $width . '&height=' . $height . '&alt=' . $alt . '&class=' . $class );
		echo $after_widget;
	}
}

/* *** megumi include page *** */
add_action( 'widgets_init', 'Add_Megumi_Widget_Megumi_Include_Page' );
function Add_Megumi_Widget_Megumi_Include_Page() {
	register_widget( 'Megumi_Widget_Megumi_Include_Page' );
}
class Megumi_Widget_Megumi_Include_Page extends WP_Widget {
	function Megumi_Widget_Megumi_Include_Page() {
		$widget_ops = array(
			'classname'   => 'megumi_include_page',
			'description' => __( 'View the page with the specified ID.', 'megumi' ),
		);
		$this->WP_Widget( 'megumi_include_page', __( 'Megumi Include Page', 'megumi' ), $widget_ops );
	}

	function form( $instance ) {
		global $post, $_wp_additional_image_sizes;
		$instance = wp_parse_args(
						(array) $instance, array(
							'id'           => '',
							'page'         => '',
							'pid'          => '',
							'type'         => '',
							'image_size'   => '',
							'content_type' => '',
							'class'        => '',
						)
					);
		$title        = intval( $instance['id'] );
		$page         = intval( $instance['page'] );
		$pid          = intval( $instance['pid'] );
		$type         = intval( $instance['type'] );
		$image_size   = esc_attr( $instance['image_size'] );
		$content_type = intval( $instance['content_type'] );
		$class        = esc_attr( $instance['class'] );
		$output = '<p>' . "\n";
		$output .= '<label for="' . $this->get_field_id( 'page' ) . '-page">' . "\n";
		$output .= '<input class="checkbox" name="' . $this->get_field_name( 'page' ) . '" id="' . $this->get_field_id( 'page' ) . '-page" type="radio" value="1"';
		if ( $page == 1 ) {
			$output .= ' checked';
		}
		$output .= ' />' . "\n";
		$output .= __( ':Page', 'megumi') ."\n";
		$output .= '</label>' . "\n";
		$output .= '<label for="' . $this->get_field_id( 'page' ) . '-post">' . "\n";
		$output .= '<input class="checkbox" name="' . $this->get_field_name( 'page' ) . '" id="' . $this->get_field_id( 'page' ) . '-post" type="radio" value="2"';
		if ( $page == 2 ) {
			$output .= ' checked';
		}
		$output .= ' />' . "\n";
		$output .= __( ':Post', 'megumi') ."\n";
		$output .= '</label>' . "\n";
		$output .= '</p>' . "\n";
		$output .= '<p>' . "\n";
		$output .= '<label for="' . $this->get_field_id( 'pid' ) . '">' . "\n";
		$output .= __( 'ID:', 'megumi' ) ."\n";
		$output .= '<input class="widefat" name="' . $this->get_field_name( 'pid' ) . '" id="' . $this->get_field_id( 'pid' ) . '" type="text" value="' . $pid . '" />' . "\n";
		$output .= '</label>' . "\n";
		$output .= '</p>' . "\n";
		$output .= '<p>' . "\n";
		$output .= '<label for="' . $this->get_field_id( 'type' ) . '">' . __( 'Select View Type', 'megumi' ) . '</label>' . "\n";
		$output .= '<select class="widefat" id="' . $this->get_field_id( 'type' ) . '" name="' . $this->get_field_name( 'type' ) . '">' . "\n";
		$output .= '<option value="1"' . ( $type == 1 ? ' selected' : '' ) . '>' . __( 'Text and Image', 'megumi' ) . '</option>' . "\n";
		$output .= '<option value="2"' . ( $type == 2 ? ' selected' : '' ) . '>' . __( 'Text Only', 'megumi' ) . '</option>' . "\n";
		$output .= '<option value="3"' . ( $type == 3 ? ' selected' : '' ) . '>' . __( 'Image Only', 'megumi' ) . '</option>' . "\n";
		$output .= '</select>' . "\n";
		$output .= '</label>' . "\n";
		$output .= '</p>' . "\n";
		$output .= '<p>' . "\n";
		$output .= '<label for="' . $this->get_field_id( 'image_size' ) . '">' . "\n";
		$output .= __( 'Select Image Size:', 'megumi' ) ."\n";
		$output .= '<select class="widefat" id="' . $this->get_field_id( 'image_size' ) . '" name="' . $this->get_field_name( 'image_size' ) . '">' . "\n";
		$output .= '<option value=""' . ( !$image_size ? ' selected' : '' ) . '>' . __( 'None Select', 'megumi' ) . '</option>' . "\n";
		foreach ( get_intermediate_image_sizes() as $s ) {
			if ( $s == 'thumbnail' ) {
				$size = get_option('thumbnail_size_w');
			} elseif ( $s == 'medium' ) {
				$size = get_option('medium_size_w');
			} elseif ( $s == 'large' ) {
				$size = get_option('large_size_w');
			} else {
				$size = intval( $_wp_additional_image_sizes[$s]['width'] );
			}
			if ( $s != 'mobile-archives' ) {
				$output .= '<option value="' . $s . '"' . ( $image_size == $s ? ' selected' : '' ) . '>' . $s . '(' . $size . ')</option>' . "\n";
			}
		}
		$output .= '</select>' . "\n";
		$output .= '</label>' . "\n";
		$output .= '</p>' . "\n";
		$output .= '<p>' . "\n";
		$output .= '<label for="' . $this->get_field_id( 'content_type' ) . '">' . __( 'Select Content Type', 'megumi' ) . '</label>' . "\n";
		$output .= '<select class="widefat" id="' . $this->get_field_id( 'content_type' ) . '" name="' . $this->get_field_name( 'content_type' ) . '">' . "\n";
		$output .= '<option value="1"' . ( $content_type == 1 ? ' selected' : '' ) . '>' . __( 'Excerpt', 'megumi' ) . '</option>' . "\n";
		$output .= '<option value="2"' . ( $content_type == 2 ? ' selected' : '' ) . '>' . __( 'Content', 'megumi' ) . '</option>' . "\n";
		$output .= '</select>' . "\n";
		$output .= '</label>' . "\n";
		$output .= '</p>' . "\n";
		$output .= '<p>' . "\n";
		$output .= '<label for="' . $this->get_field_id( 'class' ) . '">' . "\n";
		$output .= __( 'class:', 'megumi' ) ."\n";
		$output .= '<input class="widefat" name="' . $this->get_field_name( 'class' ) . '" id="' . $this->get_field_id( 'class' ) . '" type="text" value="' . $class . '" />' . "\n";
		$output .= '</label>' . "\n";
		$output .= '</p>' . "\n";
		$output .= '<input name="' . $this->get_field_name( 'title' ) . '" type="hidden" value="' . $title . '" />' . "\n";
		echo $output;
	}

	function update( $new_instance, $old_instance ) {
		$instance                 = $old_instance;
		$instance['title']        = get_the_title( (int) $new_instance['id'] );
		$instance['page']         = (int) $new_instance['page'];
		$instance['pid']          = (int) $new_instance['pid'];
		$instance['type']         = (int) $new_instance['type'];
		$instance['image_size']   = strip_tags( $new_instance['image_size'] );
		$instance['content_type'] = (int) $new_instance['content_type'];
		$instance['class']        = strip_tags( $new_instance['class'] );
		return $instance;
	}

	function widget( $args, $instance ) {
		extract( $args );
		$page         = ( $instance['page'] ) ? (int) $instance['page'] : '';
		$pid          = ( $instance['pid'] ) ? (int) $instance['pid'] : '';
		$type         = ( $instance['type'] ) ? (int) $instance['type'] : '';
		$image_size   = ( $instance['image_size'] ) ? strip_tags( $instance['image_size'] ) : '';
		$content_type = ( $instance['content_type'] ) ? (int) $instance['content_type'] : '';
		$class        = ( $instance['class'] ) ? strip_tags( $instance['class'] ) : '';
		echo $before_widget;
		megumi_include_page( 'page=' . $page . '&id=' . $pid . '&type=' . $type . '&image_size=' . $image_size . '&content_type=' . $content_type . '&class=' . $class . '&widget=' . $id );
		echo $after_widget;
	}
}

/* *** megumi post list *** */
add_action( 'widgets_init', 'Add_Megumi_Widget_Megumi_Post_List' );
function Add_Megumi_Widget_Megumi_Post_List() {
	register_widget( 'Megumi_Widget_Megumi_Post_List' );
}
class Megumi_Widget_Megumi_Post_List extends WP_Widget {
	function Megumi_Widget_Megumi_Post_List() {
		$widget_ops = array(
			'classname'   => 'megumi_post_list',
			'description' => __( 'The specified categories of posts.', 'megumi' ),
		);
		$this->WP_Widget( 'megumi_post_list', __( 'Megumi Post List', 'megumi' ), $widget_ops );
	}

	function form( $instance ) {
		global $post, $_wp_additional_image_sizes;
		$instance = wp_parse_args(
						(array) $instance, array(
							'view_home'   => 'post_title',
							'catid'       => '',
							'type'        => '',
							'image_size'  => '',
							'sticky'      => '',
							'limit'       => '5',
							'orderby'     => 'date',
							'order'       => 'DESC',
							'meta_key'    => '',
							'meta_value'  => '',
							'title'       => '',
							'title_class' => 'new_post_title',
							'list_class'  => 'new_post_list',
							'more'        => '',
						)
					);
		$view_home   = intval( $instance['view_home'] );
		$catid       = intval( $instance['catid'] );
		$type        = intval( $instance['type'] );
		$image_size  = esc_attr( $instance['image_size'] );
		$sticky      = intval( $instance['sticky'] );
		$limit       = intval( $instance['limit'] );
		$orderby     = esc_attr( $instance['orderby'] );
		$order       = esc_attr( $instance['order'] );
		$meta_key    = esc_attr( $instance['meta_key'] );
		$meta_value  = esc_attr( $instance['meta_value'] );
		$title       = esc_attr( $instance['title'] );
		$title_class = esc_attr( $instance['title_class'] );
		$list_class  = esc_attr( $instance['list_class'] );
		$more        = intval( $instance['more'] );
		$output = '<p>' . "\n";
		$output .= '<label for="' . $this->get_field_id( 'view_home' ) . '">' . "\n";
		$output .= '<input class="checkbox" name="' . $this->get_field_name( 'view_home' ) . '" id="' . $this->get_field_id( 'view_home' ) . '" type="checkbox" value="1"';
		if ( $view_home == 1 ) {
			$output .= ' checked';
		}
		$output .= ' />' . "\n";
		$output .= __( ':View HOME', 'megumi' ) ."\n";
		$output .= '</label>' . "\n";
		$output .= '</p>' . "\n";
		$output .= '<p>' . "\n";
		$output .= '<label for="' . $this->get_field_id( 'catid' ) . '">' . "\n";
		$output .= __( 'Category ID:', 'megumi' ) . '<br />' . "\n";
		$output .= wp_dropdown_categories( 'show_option_none=' . __( 'Select all', 'megumi' ) . '&show_count=1&hide_empty=0&selected=' . esc_attr( $catid ) . '&name=' . $this->get_field_name( 'catid' ) . '&hierarchical=1&echo=0') . "\n";
		$output .= '</label>' . "\n";
		$output .= '</p>' . "\n";
		$output .= '<p>' . "\n";
		$output .= '<label for="' . $this->get_field_id( 'type' ) . '">' . __( 'Select View Type', 'megumi' ) . '</label>' . "\n";
		$output .= '<select class="widefat" id="' . $this->get_field_id( 'type' ) . '" name="' . $this->get_field_name( 'type' ) . '">' . "\n";
		$output .= '<option value="1"' . ( $type == 1 ? ' selected' : '' ) . '>' . __( 'Title and date', 'megumi' ) . '</option>' . "\n";
		$output .= '<option value="2"' . ( $type == 2 ? ' selected' : '' ) . '>' . __( 'Date and Title', 'megumi' ) . '</option>' . "\n";
		$output .= '<option value="3"' . ( $type == 3 ? ' selected' : '' ) . '>' . __( 'Category and date and title', 'megumi' ) . '</option>' . "\n";
		$output .= '<option value="4"' . ( $type == 4 ? ' selected' : '' ) . '>' . __( 'Date and category and title', 'megumi' ) . '</option>' . "\n";
		$output .= '<option value="5"' . ( $type == 5 ? ' selected' : '' ) . '>' . __( 'Date and title and category', 'megumi' ) . '</option>' . "\n";
		$output .= '<option value="6"' . ( $type == 6 ? ' selected' : '' ) . '>' . __( 'Title Only', 'megumi' ) . '</option>' . "\n";
		$output .= '<option value="7"' . ( $type == 7 ? ' selected' : '' ) . '>' . __( 'Image and title and excerpt', 'megumi' ) . '</option>' . "\n";
		$output .= '<option value="8"' . ( $type == 8 ? ' selected' : '' ) . '>' . __( 'Title and Image and excerpt', 'megumi' ) . '</option>' . "\n";
		$output .= '<option value="9"' . ( $type == 9 ? ' selected' : '' ) . '>' . __( 'Image and date and excerpt', 'megumi' ) . '</option>' . "\n";
		$output .= '<option value="10"' . ( $type == 10 ? ' selected' : '' ) . '>' . __( 'Image and excerpt', 'megumi' ) . '</option>' . "\n";
		$output .= '<option value="11"' . ( $type == 11 ? ' selected' : '' ) . '>' . __( 'Image Only', 'megumi' ) . '</option>' . "\n";
		$output .= '</select>' . "\n";
		$output .= '</label>' . "\n";
		$output .= '</p>' . "\n";
		$output .= '<p>' . "\n";
		$output .= '<label for="' . $this->get_field_id( 'image_size' ) . '">' . "\n";
		$output .= __( 'Select Image Size:', 'megumi' ) ."\n";
		$output .= '<select class="widefat" id="' . $this->get_field_id( 'image_size' ) . '" name="' . $this->get_field_name( 'image_size' ) . '">' . "\n";
		$output .= '<option value=""' . ( !$image_size ? ' selected' : '' ) . '>' . __( 'None Select', 'megumi' ) . '</option>' . "\n";
		foreach ( get_intermediate_image_sizes() as $s ) {
			if ( $s == 'thumbnail' ) {
				$size = get_option('thumbnail_size_w');
			} elseif ( $s == 'medium' ) {
				$size = get_option('medium_size_w');
			} elseif ( $s == 'large' ) {
				$size = get_option('large_size_w');
			} else {
				$size = intval( $_wp_additional_image_sizes[$s]['width'] );
			}
			if ( $s != 'mobile-archives' ) {
				$output .= '<option value="' . $s . '"' . ( $image_size == $s ? ' selected' : '' ) . '>' . $s . '(' . $size . ')</option>' . "\n";
			}
		}
		$output .= '</select>' . "\n";
		$output .= '</label>' . "\n";
		$output .= '</p>' . "\n";
		$output .= '<p>' . "\n";
		$output .= '<label for="' . $this->get_field_id( 'sticky' ) . '">' . "\n";
		$output .= '<input class="checkbox" name="' . $this->get_field_name( 'sticky' ) . '" id="' . $this->get_field_id( 'sticky' ) . '" type="checkbox" value="1"';
		if ( $sticky == 1 ) {
			$output .= ' checked';
		}
		$output .= ' />' . "\n";
		$output .= __( ':Show Sticky', 'megumi' ) ."\n";
		$output .= '</label>' . "\n";
		$output .= '</p>' . "\n";
		$output .= '<p>' . "\n";
		$output .= '<label for="' . $this->get_field_id( 'limit' ) . '">' . "\n";
		$output .= __( 'Number Display:', 'megumi' ) ."\n";
		$output .= '<input class="widefat" name="' . $this->get_field_name( 'limit' ) . '" id="' . $this->get_field_id( 'limit' ) . '" type="text" value="' . $limit . '" />' . "\n";
		$output .= '</label>' . "\n";
		$output .= '</p>' . "\n";
		$output .= '<p>' . "\n";
		$output .= '<label for="' . $this->get_field_id( 'orderby' ) . '">' . __( 'Order By', 'megumi' ) . '</label>' . "\n";
		$output .= '<select class="widefat" id="' . $this->get_field_id( 'orderby' ). '" name="' . $this->get_field_name( 'orderby', 'megumi' ) . '">' . "\n";
		$output .= '<option value="date"' . ( $orderby == 'date' ? ' selected' : '' ) . '>' . __( 'Order by date.', 'megumi' ) . '</option>' . "\n";
		$output .= '<option value="ID"' . ( $orderby == 'ID' ? ' selected' : '' ) . '>' . __( 'Order by post id.', 'megumi' ) . '</option>' . "\n";
		$output .= '<option value="rand"' . ( $orderby == 'rand' ? ' selected' : '' ) . '>' . __( 'Random order.', 'megumi' ) . '</option>' . "\n";
		$output .= '<option value="comment_count"' . ( $orderby == 'comment_count' ? ' selected' : '' ) . '>' . __( 'Sort Comments.', 'megumi' ) . '</option>' . "\n";
		$output .= '</select>' . "\n";
		$output .= '</p>' . "\n";
		$output .= '<p>' . "\n";
		$output .= '<label for="' . $this->get_field_id( 'order' ) . '">' . __( 'Order', 'megumi' ) . '</label>' . "\n";
		$output .= '<select class="widefat" id="' . $this->get_field_id( 'order' ) . '" name="' . $this->get_field_name( 'order' ) . '">' . "\n";
		$output .= '<option value="ASC"' . ( ( $order == 'ASC' ) ? ' selected' : '' ) . '>' . __( 'ASC', 'megumi' ) . '</option>' . "\n";
		$output .= '<option value="DESC"' . ( ( $order == 'DESC' ) ? ' selected' : '' ) . '>' . __( 'DESC', 'megumi' ) . '</option>' . "\n";
		$output .= '</select>' . "\n";
		$output .= '</p>' . "\n";
		$output .= '<p>' . "\n";
		$output .= '<label for="' . $this->get_field_id( 'meta_key' ) . '">' . "\n";
		$output .= __( 'Custom field key:', 'megumi' ) ."\n";
		$output .= '<input class="widefat" name="' . $this->get_field_name( 'meta_key' ) . '" id="' . $this->get_field_id( 'meta_key' ) . '" type="text" value="' . $meta_key . '" />' . "\n";
		$output .= '</label>' . "\n";
		$output .= '</p>' . "\n";
		$output .= '<p>' . "\n";
		$output .= '<label for="' . $this->get_field_id( 'meta_value' ) . '">' . "\n";
		$output .= __( 'Custom field value:', 'megumi' ) ."\n";
		$output .= '<input class="widefat" name="' . $this->get_field_name( 'meta_value' ) . '" id="' . $this->get_field_id( 'meta_value' ) . '" type="text" value="' . $meta_value . '" />' . "\n";
		$output .= '</label>' . "\n";
		$output .= '</p>' . "\n";
		$output .= '<p>' . "\n";
		$output .= '<label for="' . $this->get_field_id( 'title' ) . '">' . "\n";
		$output .= __( 'Title:', 'megumi' ) ."\n";
		$output .= '<input class="widefat" name="' . $this->get_field_name( 'title' ) . '" id="' . $this->get_field_id( 'title' ) . '" type="text" value="' . $title . '" />' . "\n";
		$output .= '</label>' . "\n";
		$output .= '</p>' . "\n";
		$output .= '<p>' . "\n";
		$output .= '<label for="' . $this->get_field_id( 'title_class' ) . '">' . "\n";
		$output .= __( 'Title Class:', 'megumi' ) ."\n";
		$output .= '<input class="widefat" name="' . $this->get_field_name( 'title_class' ) . '" id="' . $this->get_field_id( 'title_class' ) . '" type="text" value="' . $title_class . '" />' . "\n";
		$output .= '</label>' . "\n";
		$output .= '</p>' . "\n";
		$output .= '<p>' . "\n";
		$output .= '<label for="' . $this->get_field_id( 'list_class' ) . '">' . "\n";
		$output .= __( 'List Class:', 'megumi' ) ."\n";
		$output .= '<input class="widefat" name="' . $this->get_field_name( 'list_class' ) . '" id="' . $this->get_field_id( 'list_class' ) . '" type="text" value="' . $list_class . '" />' . "\n";
		$output .= '</label>' . "\n";
		$output .= '</p>' . "\n";
		$output .= '<p>' . "\n";
		$output .= '<label for="' . $this->get_field_id( 'more' ) . '">' . "\n";
		$output .= '<input class="checkbox" name="' . $this->get_field_name( 'more' ) . '" id="' . $this->get_field_id( 'more' ) . '" type="checkbox" value="1"';
		if ( $more == 1 ) {
			$output .= ' checked';
		}
		$output .= ' />' . "\n";
		$output .= __( 'Put a link to a list.', 'megumi' ) ."\n";
		$output .= '</label>' . "\n";
		$output .= '</p>' . "\n";
		echo $output;
	}

	function update( $new_instance, $old_instance ) {
		$instance                = $old_instance;
		$instance['view_home']   = (int) $new_instance['view_home'];
		$instance['catid']       = (int) $new_instance['catid'];
		$instance['type']        = (int) $new_instance['type'];
		$instance['image_size']  = strip_tags( $new_instance['image_size'] );
		$instance['sticky']      = (int) $new_instance['sticky'];
		$instance['limit']       = (int) $new_instance['limit'];
		$instance['orderby']     = strip_tags( $new_instance['orderby'] );
		$instance['order']       = strip_tags( $new_instance['order'] );
		$instance['meta_key']    = strip_tags( $new_instance['meta_key'] );
		$instance['meta_value']  = strip_tags( $new_instance['meta_value'] );
		$instance['title']       = strip_tags( $new_instance['title'] );
		$instance['title_class'] = strip_tags( $new_instance['title_class'] );
		$instance['list_class']  = strip_tags( $new_instance['list_class'] );
		$instance['more']        = (int)( $new_instance['more'] );
		return $instance;
	}

	function widget( $args, $instance ) {
		extract( $args );
		$view_home   = ( $instance['view_home'] ) ? (int) $instance['view_home'] : '';
		$get_catid   = ( $instance['catid'] ) ? (int) $instance['catid'] : '';
		$catid       = ( $get_catid == -1 ) ? 0 : $get_catid;
		$type        = ( $instance['type'] ) ? (int) $instance['type'] : '';
		$image_size  = ( $instance['image_size'] ) ? strip_tags( $instance['image_size'] ) : '';
		$sticky      = ( $instance['sticky'] ) ? (int) $instance['sticky'] : '';
		$limit       = ( $instance['limit'] ) ? (int) $instance['limit'] : '5';
		$orderby     = ( $instance['orderby'] ) ? strip_tags( $instance['orderby'] ) : 'date';
		$order       = ( $instance['order'] ) ? strip_tags( $instance['order'] ) : 'DESC';
		$meta_key    = ( $instance['meta_key'] ) ? strip_tags( $instance['meta_key'] ) : '';
		$meta_value  = ( $instance['meta_value'] ) ? strip_tags( $instance['meta_value'] ) : '';
		$title       = ( $instance['title'] ) ? strip_tags( $instance['title'] ) : '';
		$title_class = ( $instance['title_class'] ) ? strip_tags( $instance['title_class'] ) : 'new_post_title';
		$list_class  = ( $instance['list_class'] ) ? strip_tags( $instance['list_class'] ) : 'new_post_list';
		$more        = ( $instance['more'] ) ? strip_tags( $instance['more'] ) : '';
		$output = $before_widget;
		$output .= megumi_post_list( 'catid=' . $catid . '&type=' . $type . '&image_size=' . $image_size . '&callback=' . $callback . '&sticky=' . $sticky . '&limit=' . $limit . '&orderby=' . $orderby . '&order=' . $order . '&meta_key=' . $meta_key . '&meta_value=' . $meta_value . '&title=' . $title . '&title_class=' . $title_class . '&list_class=' . $list_class . '&widget=' . $id . '&more=' . $more . '&echo=0' );
		$output .= $after_widget;
		if ( $view_home ) {
			echo $output;
		} else {
			if ( !is_home() || !is_front_page() ) {
				echo $output;
			}
		}
	}
}

/* *** megumi post list *** */
add_action( 'widgets_init', 'Add_Megumi_Widget_Megumi_Page_Nav' );
function Add_Megumi_Widget_Megumi_Page_Nav() {
	register_widget( 'Megumi_Widget_Megumi_Page_Nav' );
}
class Megumi_Widget_Megumi_Page_Nav extends WP_Widget {
	function Megumi_Widget_Megumi_Page_Nav() {
		$widget_ops = array(
			'classname' => 'megumi_page_content_nav',
			'description' => __( 'Page Content Nav', 'megumi' ),
		);
		$this->WP_Widget( 'megumi_page_content_nav', __( 'Page Content Nav', 'megumi' ), $widget_ops );
	}

	function form( $instance ) {
		global $post;
		$instance = wp_parse_args(
						(array) $instance, array(
							'title'      => '',
							'multi_pid'  => '',
							'page_sort'  => '',
							'page_order' => '',
						)
					);
		$title      = esc_attr( $instance['title'] );
		$multi_pid  = $instance['multi_pid'];
		$page_sort  = esc_attr( $instance['page_sort'] );
		$page_order = esc_attr( $instance['page_order'] );
		$get_page   = get_pages();
		$output = '<p>' . "\n";
    	$output .= '<label for="' . $this->get_field_id( 'title' ) . '">' . "\n";
        $output .= __( 'Title:', 'megumi' ) . "\n";
    	$output .= '<input class="widefat" name="' . $this->get_field_name( 'title' ) . '" id="' . $this->get_field_id( 'title' ) . '" type="text" value="' . esc_attr($title) . '" />' . "\n";
        $output .= '</label>' . "\n";
        $output .= '</p>' . "\n";
    	$output .= '<p>' . "\n";
		$output .= __( 'Page ID:', 'megumi' ) . "\n";
        $output .= '<select class="widefat" name="' . $this->get_field_name( 'multi_pid' ) . '[]" id="multi_pid" size="5" multiple="multiple" style="height:auto;">' . "\n";
		$output .= '<option value="">' . __('Reset','megumi') . '</option>' . "\n";
		$count = 0;
		foreach ( $get_page as $peges ) {
			$get_parent = $peges->post_parent;
			if( $get_parent == 0 ) {
				$count = 0;
			} else {
				$count++;
			}
			$spacer = str_repeat( '&nbsp;', $count * 3 );
			$output .= '<option value="' . $peges->ID . '"';
			if( $multi_pid ){
				foreach ( $multi_pid as $pageid ) {
					if ( $pageid == $peges->ID ) {
						$output .= ' selected="selected"';
					}
				}
			}
			$output .= ' class="level-' . $count . '">' . $spacer . $peges->post_title . '</option>' . "\n";
		}
		$output .= '</select>' . "\n";
		$output .= '</p>' . "\n";
		$output .= '<p>' . "\n";
		$output .= __('Sort:', 'megumi') . "\n";
		$output .= '<select class="widefat" name="' . $this->get_field_name( 'page_sort' ) . '" id="page_sort">' . "\n";
		$output .= '<option value="menu_order" ' . ( $page_sort == 'menu_order' ? 'selected="selected"' : '' ) . '>' . __( 'Menu Order', 'megumi' ) . '</option>' . "\n";
		$output .= '<option value="post_date" ' . ( $page_sort == 'post_date' ? 'selected="selected"' : '' ) . '>' . __( 'Post Date', 'megumi_zen' ) . '</option>' . "\n";
		$output .= '<option value="ID" ' . ( $page_sort == 'ID' ? 'selected="selected"' : '' ) . '>' . __( 'Post ID', 'megumi_zen' ) . '</option>' . "\n";
		$output .= '</select>' . "\n";
		$output .= '</p>' . "\n";
		$output .= '<p>' . "\n";
		$output .= __('Order:', 'megumi') . "\n";
		$output .= '<select class="widefat" name="' . $this->get_field_name( 'page_order' ) . '" id="page_order">' . "\n";
		$output .= '<option value="asc" ' . ( $page_order == 'asc' ? 'selected="selected"' : '' ) . '>' . __( 'Ascending', 'megumi_zen' ) . '</option>' . "\n";
		$output .= '<option value="desc" ' . ( $page_order == 'desc' ? 'selected="selected"' : '' ) . '>' . __( 'Descending', 'megumi_zen' ) . '</option>' . "\n";
		$output .= '</select>' . "\n";
		$output .= '</p>' . "\n";
		echo $output;
	}

	function update( $new_instance, $old_instance ) {
		$instance               = $old_instance;
		$instance['title']      = strip_tags( $new_instance['title'] );
		$instance['multi_pid']  = $new_instance['multi_pid'];
		$instance['page_sort']  = strip_tags( $new_instance['page_sort'] );
		$instance['page_order'] = strip_tags( $new_instance['page_order'] );
		return $instance;
	}

	function widget( $args, $instance ) {
		extract( $args );
		if ( $instance['multi_pid'] ) {
			$get_include_page = implode(',',$instance['multi_pid']);
			$get_page_sort    = strip_tags( $instance['page_sort'] );
			$page_order       = $instance['page_order'];
			$page_sort        = get_pages( 'sort_order=' . $get_page_sort . '&sort_order=' . $page_order . '&include=' . $get_include_page );
			foreach ( $page_sort as $peges ) {
				$page[] = $peges->ID;
			}
			$include_page = implode( ',', $page );
			echo $before_widget;
			echo megumi_page_content_nav( 'include=' . $include_page );
			echo $after_widget;
		}
	}
}
