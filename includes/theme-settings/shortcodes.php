<?php 

function rocketShortcodes(){
    add_shortcode( 'rocketmenu', 'getMenuNavigation' ); //[rocketmenu]
    add_shortcode( 'year', 'getPresentYear' ); //[year]
    add_shortcode( 'social-media', 'socialMediaShortcode' ); //[social-media mode="facebook"]
    add_shortcode( 'copyright', 'copyrightShortcode' ); //[copyright]
    add_shortcode( 'developer', 'developerShortcode' ); //[developer]
    add_shortcode( 'phonenumber', 'phoneShortcode' ); //[phonenumber]
    add_shortcode( 'address1', 'address1Shortcode' ); //[address1]
    add_shortcode( 'address2', 'address2Shortcode' ); //[address2]
    add_shortcode( 'emailaddress', 'emailAddressShortcode' ); //[address2]
    add_shortcode('recent-posts', 'pull_blog_posts'); //[recent-posts post=5 template=news ]
    add_shortcode( 'placeholder', 'rocketPlaceholder' ); //[placeholder length="30"]
    add_shortcode( 'siteinfo', 'siteInfoShortcode' ); //[siteinfo type=url/name]
}

//Theme Options Shortcodes
/**
 * Social Media Shortcode
 */
function socialMediaShortcode( $atts ) {
    // Assign default values
    
    $mode   = "";
    $return = "Invalid value!";
    
    extract( shortcode_atts( array(
        'mode' =>  $mode
    ), $atts ) );
    
    if($mode == "facebook"){
        $return = get_option('facebook');
    }
    else if($mode == "twitter"){
        $return = get_option('twitter');
    }
    else if($mode == "google_plus"){
        $return = get_option('google_plus');
    }
    else if($mode == "linkedin"){
        $return = get_option('linkedin');
    }
    else if($mode == "youtube"){
        $return = get_option('youtube');
    }
    else if($mode == "instagram"){
        $return = get_option('instagram');
    }
    else if($mode == "pinterest"){
        $return = get_option('pinterest');
    }
    
    return $return;
}
function developerShortcode( $atts ) { 
    return do_shortcode(get_option('developer'));
}
function copyrightShortcode( $atts ) { 
    return do_shortcode(get_option('copyright'));
}
function phoneShortcode( $atts ) { 
    return get_option('phonenumber');
}
function address1Shortcode( $atts ) { 
    return do_shortcode(get_option('address1'));
}
function address2Shortcode( $atts ) { 
    return do_shortcode(get_option('address2'));
}
function emailAddressShortcode( $atts ) { 
    return do_shortcode(get_option('email-address'));
}
//Get Present Year
function getPresentYear( $atts ){
    return date('Y');
}
// Site URL Shortcode
function siteInfoShortcode( $atts ){
    $type = '';
    extract(shortcode_atts(array(
        'type' => $type,				
    ), $atts));

    $return_string = '';

    if($type=='url'){
        $return_string = home_url();;
    }
    if($type=='name'){
        $return_string = get_bloginfo();;
    }
    
    return $return_string;
}
//Pull Blogpost
function pull_blog_posts($atts, $content = null){
    extract(shortcode_atts(array(
        'posts' => 1,
        'cat' => 1,
        'template'  => 'blogs'
    ), $atts));

    $return = '';

    $args = array(
        'orderby' => 'date',
        'order' => 'DESC' ,
        'showposts' => $posts,
        'cat' => $cat
    );

    $query = new WP_Query($args);

    $return = array();

    if($query->have_posts()){
        while($query->have_posts()){
        $query->the_post();
            /*Pull news template*/
                $return['news'] .= '
                    <a href="'.get_the_permalink().'">'.get_the_post_thumbnail(get_the_ID(), array(300,300)).'</a>
                    <h4 class="title">'.get_the_title().'</h4>
                    <p>'.rocket_excerpt(200).'</p>
                    <a class="btn btn-primary" href="'.get_the_permalink().'">Learn More</a>
                ';
            /*End Pull news template*/

        }
    }
    switch($template){
        case 'news' :
            $return = $return['news'];
        break;
    }
    wp_reset_query();
    return $return;
}
//Get Rocket Navigation
function getMenuNavigation(){
    $nav =  wp_nav_menu(
                array(
                    'menu'              => 'primary',
                    'theme_location'    => 'primary',
                    'depth'             => 4,
                    'container'         => 'div',
                    'container_class'   => 'navbar-collapse desktop collapse',
                    'container_id'      => 'bs-navbar-collapse',
                    'menu_class'        => 'nav navbar-nav',
                    'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                    'walker'            => new wp_bootstrap_navwalker()
                )
            );
    return $nav;
}
// Rocket Excerpt
function rocket_excerpt($length) {
    if(strlen(get_the_excerpt()) >= $length){
        $excerpt =  substr(get_the_excerpt(),0,$length).'...';
    }else{
        $excerpt = get_the_excerpt();
    }
    return $excerpt;
}
// Rocket Placeholder
function rocketPlaceholder($atts){
    // Default Values
    $return_string = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. ';
    $length = 0;
    extract(shortcode_atts(array(
        'length' => $length
        ), $atts));
    
    if($length>='121'){
        $return_string = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. "Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?';
    }

    $return_string = mb_strimwidth($return_string, 0, $length, '.');
    return $return_string; 
}
// Placeholder Counter
function rocketPlaceholderCounter(){
    $post_ids = get_posts(array( 
        'posts_per_page'=> -1,
        'fields'        => 'ids', // Only get post IDs
    ));
    $query = new WP_Query($post_ids);
    if($query->have_posts()){
        while($query->have_posts()){
            echo '<ul>';
            if(has_shortcode( $query->post_content, '[placeholder]')){
                echo '<li><a href="'.get_the_permalink().'">'.get_the_title().'</a></li>';
            }
        }
    }
    wp_reset_query();
    echo '</ul>';
}
