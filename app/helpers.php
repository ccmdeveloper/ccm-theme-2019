<?php

/**
 * =====================================
 * Excerpts
 * =====================================
 */

/** set Phone Number
 * ===================================== */
function setPhoneNumber($phone) {
    
    $string = false;
    if($phone){
        $string = preg_replace('/[^A-Za-z0-9\-]/','', $phone);
    }
    return $string;
}

/** Custom Excerpt
 * ===================================== */
function excerpt_content_clean($contents,$limit) {
    $content = explode(' ', $contents, $limit);
    if (count($content)>=$limit) {
        array_pop($content);
        $content = implode(" ",$content).'...';
    } else {
        $content = implode(" ",$content);
    }
    $content = preg_replace('/\[.+\]/','', $content);
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    return $content;
}

function get_excerpt_acf($acfField,$count){
    global $post;
    $excerpt = $acfField;
    $excerpt = strip_tags($excerpt);
    $excerpt = substr($excerpt, 0, $count);
    return $excerpt.'...';
}

function dump($data) {
    echo '<pre>';
        var_dump($data);
    echo '</pre>';
}

function filterString($text = ''){
    
    $string = preg_replace("/[^0-9]/", "", $text );
    $string = preg_replace('/\?\//', '?', $string);
    $string = preg_replace('/\s+/', '', $string);

    return $string;
}


function getSocialMedia(){

    $content = "";

    if(get_field('social_media','option')){

        $content .= '<div class="social-media-wrapper"><ul class="social-media">';

        foreach(get_field('social_media','option') as $key => $value){

             $content .= '<li><a href="'.$value['url'].'" target="_blank" rel="nofollow">';

            switch ($value['type']) {

                case "fb":
                    $content .= '<i class="fab fa-facebook-f"></i>';
                    break;
                case "tw":
                    $content .= '<i class="fab fa-twitter"></i>';
                    break;
                case "li":
                    $content .= '<i class="fab fa-linkedin-in"></i>';
                    break;
                case "in":
                    $content .= '<i class="fab fa-instagram"></i>';
                    break;
                case "gp":
                    $content .= '<i class="fab fa-google-plus-g"></i>';
                    break;
                default:
                    $content .= '<i class="fab fa-facebook-f"></i>';
            }

            $content .= '<span class="hexagon"></span></a></li>';
        }

         $content .= '</ul></div>';

    }else{
        $content = "";
    }

    return $content;

}