<?php
/**
 * Functionality to hook in the WordPress theme updater. Included in 
 * PressWork but only really needed for child themes.
 *
 * @since PressWork 1.0
 */
function check_for_megumi_update() {
	$contents = wp_remote_fopen('http://megumi-store.com/wp-content/downloads/megumi.txt');
	if(version_compare($contents, MEGUMI_VERSION, '>'))
		return $contents;
}
add_filter('pre_set_site_transient_update_themes', 'megumi_theme_updater');

function megumi_theme_updater($checked_data) {
	global $wp_version;
	
	$new_version = check_for_megumi_update();

	if (empty($checked_data->checked) && !empty($new_version)) {
		$response = array(
			'new_version' => $new_version,
			'url' => 'http://www.10press.net/theme/3967',
			'package' => 'http://megumi-store.com/wp-content/downloads/megumi_' . $new_version . '.zip'
			);
		$checked_data->checked['megumi'] = $new_version;
		$checked_data->response['megumi'] = $response;
	
		return $checked_data;
	}

	if(!empty($new_version)) {
		$response = array(
			'new_version' => $new_version,
			'url' => 'http://www.10press.net/theme/3967',
			'package' => 'http://megumi-store.com/wp-content/downloads/megumi_' . $new_version . '.zip'
			);
		$checked_data->response['megumi'] = $response;
	}		
	return $checked_data;
}

if (is_admin())
	$current = get_transient('update_themes');