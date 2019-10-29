<?php 

/** CHANGE LOGIN LOGO
 * ===================================== */
function my_login_logo() {
    $logo = get_field( "company_image_logo", "option" );
    ?>
    <style type="text/css">
        #login h1 a,
        .login h1 a {
            background-image: url(<?php echo $logo['url']; ?>);
            height:65px;
            width:320px;
            background-size: contain;
            background-repeat: no-repeat;
            padding-bottom: 30px;
            margin-bottom:15px;
        }
        body.login {
            background-color:<?php the_field('background_color','options'); ?>;
        }
        <?php
            if(get_field('form_background_color','options')) {
                ?>
                    body.login div#login form#loginform {
                        background-color:<?php the_field('form_background_color','options'); ?>;
                    }
                    body.login div#login form#loginform p label {
                        color:<?php the_field('form_label_color','options'); ?>;
                    }
                <?php
            }
        ?>
        body.login div#login form#loginform p.submit input#wp-submit {
            border:2px solid <?php the_field('button_background_color','options'); ?>;
            box-shadow:none;
            border-radius:0;
            background-color:<?php the_field('button_background_color','options'); ?>;
            color:<?php the_field('button_color','options'); ?>;
            height:40px;
            line-height:40px;
            line-height: 36px;
            padding: 0 15px;
            text-shadow: none;
            font-weight:bold;
            text-transform:uppercase;
            transition:.3s;
        }
        body.login div#login form#loginform p.submit input#wp-submit:hover {
            background-color:transparent;
            color:<?php the_field('button_background_color','options'); ?>;
        }
        </style>
    <?php
}
add_action( 'login_enqueue_scripts', 'my_login_logo' );

function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
    return 'Your Site Name and Info';
}
add_filter( 'login_headertext', 'my_login_logo_url_title' );