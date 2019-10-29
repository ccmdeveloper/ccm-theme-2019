<?php get_header(); ?>
<section class="default-page">
    <div class="container">
        <div class="row">

            <div class="col-12 order-1  order-lg-2 col-lg-8 col-xl-8">
                <?php
                    if ( get_the_content() ) {
                        echo apply_filters( "the_content", get_the_content() );
                    } else {
                        echo "<p>Content not found.</p>";
                    }
                ?>
            </div>
            <div class="col-12 order-2 order-lg-1 col-lg-4 col-xl-4">
                <div class="default-sidebar">
                    <?php dynamic_sidebar( "Sidebar-default" ); ?>
                    <?php 
                    $args = array(
                        'post_type' => 'services',   
                        'post_status' => 'publish', 
                        'posts_per_page' => -1,  
                        'orderby' => 'menu_order', 
                        'order' => 'ASC',
                    );
                    $the_query = new WP_Query( $args );
                    // The Loop
                    if ( $the_query->have_posts() ) {
                    ?>
                    <div class="services-widget">
                        <ul class="services-list">
                             <?php 
                            while ( $the_query->have_posts() ) {
                                
                            $the_query->the_post();

                            ?>
                            <li><a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>"><?php the_title(); ?><i class="fas fa-chevron-right"></i></a></li>
                            <?php 
                            }
                            ?>
                        </ul>
                    </div>
                    <?php 
                    } 
                    wp_reset_postdata();
                    ?>
                    <div class="company-info-widget">
                        <?php if(get_field('company_name','option')){ ?>
                        <div class="item light name">
                             <?php echo get_field('company_name','option'); ?>  
                        </div>
                        <?php } ?> 
                        <?php if(get_field('company_address','option')){ ?>
                        <div class="item light address">
                             <?php echo get_field('company_address','option'); ?>  
                        </div>
                        <?php } ?> 
                        <?php 
                        if(get_field('phone_number','option')){
                             $phone = filterString(get_field('phone_number','option'));
                        ?>
                        <a class="item medium phone" href="tel:<?php echo $phone; ?> " title="<?php echo get_field('phone_number','option'); ?> ">
                             Ph <?php echo get_field('phone_number','option'); ?>  
                        </a>
                        <?php } ?>
                        <?php if(get_field('email_address','option')){

                            $email = preg_replace('/\?\//', '?', get_field('email_address','option'));
                            $email = preg_replace('/\s+/', '', $email);
                        ?>
                        <a class="item email medium" href="<?php echo $email; ?>" title="<?php echo get_field('email_address','option'); ?> ">
                           <?php echo get_field('email_address','option'); ?>  
                        </a>
                        <?php } ?>
                      <a href="javascript:;" class="btn bordered gq-ctrl">Get Your Quote Now</a>
                  </div>

                </div>
            </div>

        </div>
    </div>
</section>
<?php get_footer(); ?>