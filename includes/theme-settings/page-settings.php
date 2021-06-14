<?php
/**
	 * Get Rocket Navigation
	 */
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


	/* Sidebar */
	function rocketHeader() {
		register_sidebar( array(
		   'name' => __( 'Header', 'rocket' ),
		   'id' => 'header-widget',
		   'description' => __( 'Contents of the Header', 'rocket' ),
		   'before_widget' => '<div id="%1$s" class="widget %2$s">',
		   'after_widget' => '</div>',
		) );
	 }
	 function rocketFooter() {
		register_sidebar( array(
		   'name' => __( 'Footer', 'rocket' ),
		   'id' => 'footer-widget',
		   'description' => __( 'Displays a 4 Column Widget(s)', 'rocket' ),
		   'before_widget' => '<div id="%1$s" class="widget col-md-3 %2$s">',
		   'after_widget' => '</div>',
		   'before_title' => '<h4 class="widget-title">',
		   'after_title' => '</h4>',
		) );
	 }
	 
	 function ctaBeforeFooter() {
		register_sidebar( array(
		   'name' => __( 'CTA Before Footer', 'rocket' ),
		   'id' => 'cta-before-footer',
		   'description' => __( 'CTA before footer section', 'rocket' ),
		   'before_widget' => '<div id="%1$s" class="widget %2$s col-lg-6">',
		   'after_widget' => '</div>',
		   'before_title' => '<h3 class="widget-title">',
		   'after_title' => '</h3>',
		) );
	 }
	
	function rocketSidebar() {
		register_sidebar( array(
			'name' => __( 'Sidebar', 'rocket' ),
			'id' => 'primary-sidebar',
			'description' => __( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'rocket' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<span class="h4 widget-title">',
			'after_title' => '</span>',
		) );
	}

	

	/*
	* Pull Blogpost
	*/
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

	/**
	 * Pagination
	 */

	function rocketPage() {
		global $wp_query;
		$big = 999999999; // need an unlikely integer

		echo paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, get_query_var('paged') ),
			'prev_text'          => __('«'),
			'next_text'          => __('»'),
			'total' => $wp_query->max_num_pages
		) );
	}
