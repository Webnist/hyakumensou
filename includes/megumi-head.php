<?php
add_action( 'wp_enqueue_scripts', 'megumi_enqueue_scripts' );
function megumi_enqueue_scripts() {

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

}

add_action( 'wp_head', 'megumi_head_script' );
function megumi_head_script() {
	$template_directory_uri = get_template_directory_uri();
	echo <<< EOT
<!--[if lt IE 9]>
	<script src="{$template_directory_uri}/js/html5shiv.js" type="text/javascript"></script>
<![endif]-->
EOT;
}