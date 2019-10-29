<?php 

// [bsbutton label="label here" target="_blank" class="" url="#"]
function bootstrap_button( $atts ) {
	
	$options = shortcode_atts( array(
		'label' => 'Label Here',
		'target' => '_self',
		'class' => '',
		'url' => '#',
	), $atts );

	$return = '<a class="btn '.$options['class'].'" target="'.$options['target'].'" url="'.$options['url'].'">'.$options['label'].'</a>';

	return $return;
}
add_shortcode( 'bsbutton', 'bootstrap_button' );


function post_slider( $atts ) {
	
	$options = shortcode_atts( array(
		'post_type' => 'post',
		'post_count' => 4,
		'xl' => 3,
		'lg' => 2,
		'xs' => 1,
		'arrow' => true,
		'dots' => true,
		'auto' => false,
		'swipe' => true,
		'speed' => 3,
		'scroll-xl' => 1,
		'scroll-lg' => 1,
		'scroll-xs' => 1,
		'meta' => 'true',
		'image' => 'true',
		'wrapper-class' => ''

	), $atts );

	global $post;

	$args = array(
		'posts_per_page'   => $options['post_count'],
		'offset'           => 0,
		'cat'         => '',
		'category_name'    => '',
		'orderby'          => 'date',
		'order'            => 'DESC',
		'include'          => '',
		'exclude'          => '',
		'meta_key'         => '',
		'meta_value'       => '',
		'post_type'        => $options['post_type'],
		'post_mime_type'   => '',
		'post_parent'      => '',
		'author'	   => '',
		'author_name'	   => '',
		'post_status'      => 'publish',
		'suppress_filters' => true,
		'fields'           => '',
	);
	
	$posts_array = get_posts( $args ); 

	
	//var_dump($posts_array);

	if($posts_array){

		$string = '<div class="post-slider-wrapper '.$options['wrapper-class'].'"><div class="post-slider" 
			data-xl="'.$options['xl'].'" 
			data-lg="'.$options['lg'].'" 
			data-xs="'.$options['xs'].'"  
			data-scroll-xl="'.$options['scroll-xl'].'" 
			data-scroll-lg="'.$options['scroll-lg'].'" 
			data-scroll-xs="'.$options['scroll-xs'].'"  
			data-arrow="'.$options['arrow'].'" 
			data-dots="'.$options['dots'].'" 
			data-auto="'.$options['auto'].'" 
			data-swipe="'.$options['swipe'].'" 
			data-speed="'.($options['speed']*1000).'">';

	foreach ( $posts_array as $post ) : setup_postdata( $post ); 

		
		$string .= '<div class="post-item"><div class="post-item-wrapper">';

		if($options['image']=='true'){
			$image = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(),'medium') : Placeholder['sizes']['medium'];
			$string .= '<div class="image-wrapper"><div class="image lazy background-image" data-src="'.$image.'"></div></div>';
		}

		$string .= '<h3 class="title">'.get_the_title().'</h3>';

		if($options['meta']=='true'){
			$string .= '<div class="meta"><i class="fal fa-clock"></i> '.get_the_time('F d, Y').' - <i class="fas fa-user-tie"></i> '.get_the_author().'</div>';
		}

		$string .= '<div class="excerpt">'.get_the_excerpt().'</div>';
		$string .= '</div></div>';

	endforeach; 

		$string .= '</div></div>';

	}else{
		
		$string = '<h2>No Content Available</h2>';

	}
	wp_reset_postdata();


	return $string;

}

add_shortcode( 'postslider', 'post_slider' );