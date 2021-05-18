<?php
    

	add_filter('use_block_editor_for_post','__return_false');

	add_action( 'wp_print_styles',     'my_deregister_styles', 100 );

	function my_deregister_styles()    { 
		wp_deregister_style( 'dashicons' ); 
	}


	// Placeholder Function 
	function rocketPlaceholder($atts){
		// Default Values
		$return_string = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. ';

		extract(shortcode_atts(array(
			'length' => $length
			), $atts));
		
		if($length>='121'){
			$return_string = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. "Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?';
		}

		$return_string = mb_strimwidth($return_string, 0, $length, '.');
		return $return_string; 
	}
	function rocketPlaceholderCounter(){
		$post_ids = get_posts(array( 
			'posts_per_page'=> -1,
			'fields'        => 'ids', // Only get post IDs
		));
		$query = new WP_Query($post_ids);
		if($query->have_posts()){
			while($query->have_posts()){
				echo '<ul>'
				if(has_shortcode( $query->post_content, '[placeholder]')){
					echo '<li><a href="'.get_the_permalink().'">'.get_the_title().'</a></li>';
				}
			}
		}
		wp_reset_query();
		echo '</ul>';
	}
	function rocketPlaceholderShortcode() { 
		add_shortcode( 'placeholder', 'rocketPlaceholder' ); //[placeholder length="30"]
	}

	