<?php
 // BRINGS SCRIPTS OF GRAVITY FORM TO FOOTER
//add_filter('gform_init_scripts_footer', '__return_true');

// GFORMS TAB INDEX FUNCTION
add_filter( 'gform_tabindex', '__return_false' );

// DISABLE AUTO SCROLLING UPON SUBMISSION OF GRAVITY FORM
add_filter('gform_confirmation_anchor', '__return_false');


// Fixed Gravity Form Async Issues
add_filter( 'gform_cdata_open', 'wrap_gform_cdata_open' );
function wrap_gform_cdata_open( $content = '' ) {
    $content = 'document.addEventListener( "DOMContentLoaded", function() { ';
    return $content;
}
add_filter( 'gform_cdata_close', 'wrap_gform_cdata_close' );
function wrap_gform_cdata_close( $content = '' ) {
    $content = ' }, false );';
    return $content;
}
add_filter( 'gform_confirmation', 'cs_gform_ajax_redirect', 10, 4);
function cs_gform_ajax_redirect( $confirmation, $form, $entry, $ajax ) {
    if ( $ajax && $form['confirmation']['type'] == 'page' ) {
        $confirmation = "<script>function gformRedirect(){document.location.href='" . get_permalink($form['confirmation']['pageId']) . "';}</script>";
    } elseif ( $ajax && $form['confirmation']['type'] == 'redirect' ) {
        $confirmation = "<script>function gformRedirect(){document.location.href='" . $form['confirmation']['url'] . "';}</script>";
    }
    return $confirmation;
}