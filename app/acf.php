<?php 
/** Option Page
 * ===================================== */
if( function_exists( 'acf_add_options_page' ) ) {
        $option_page = acf_add_options_page(array(
        'page_title' => 'General Settings',
        'menu_title' => 'Theme Options',
        'menu_slug'  => 'theme-general-settings',
        'capability' => 'edit_posts',
        'redirect'   => false,
        'icon_url'   => ( get_field('theme_option_icon','options') ) ? get_field('theme_option_icon','options') : 'dashicons-admin-site'
    ));
}
/** Sub Option Page
 * ===================================== */
if ( function_exists( 'acf_add_options_sub_page' ) ){
    acf_add_options_sub_page(array(
        'page_title'      => 'Page Default Settings',
        'parent_slug'     => 'edit.php?post_type=page'
    ));

    acf_add_options_sub_page(array(
        'page_title'      => 'Post Default Settings',
        'parent_slug'     => 'edit.php'
    ));
}


/** MAP
 * ===================================== */
function my_acf_google_map_api( $api ){
    $api['key'] = get_field('google_map_key','options');
    return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

function my_acf_init() {
    acf_update_setting('google_api_key', get_field('google_map_key','options'));
}
add_action('acf/init', 'my_acf_init');

/** Make acf field readonly options available
 * ===================================== */
add_action('acf/render_field_settings/type=text', 'add_readonly_and_disabled_to_text_field');
function add_readonly_and_disabled_to_text_field($field) {
    acf_render_field_setting( $field, array(
        'label'         => __('Read Only?','acf'),
        'instructions'  => '',
        'type'          => 'radio',
        'name'          => 'readonly',
        'default_value' => 0,
        'choices'       => array(
                1 => __("Yes",'acf'),
                0 => __("No",'acf'),
            ),
        'layout'        =>  'horizontal',
    ));
    acf_render_field_setting( $field, array(
        'label'         => __('Disabled?','acf'),
        'instructions'  => '',
        'type'          => 'radio',
        'name'          => 'disabled',
        'default_value' => 0,
        'choices'       => array(
                1 => __("Yes",'acf'),
                0 => __("No",'acf'),
            ),
        'layout'        =>  'horizontal',
    ));
}




