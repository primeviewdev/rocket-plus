<?php 

// Creating the widget 
class collapsible_widget extends WP_Widget {
 
    // The construct part  
    function __construct() {
        parent::__construct(
  
            // Base ID of your widget
            'collapsible_widget', 
              
            // Widget name will appear in UI
            __('Collapsible', 'collapsible_widget_domain'), 
              
            // Widget description
            array( 'description' => __( 'Add Bootstrap Collapsible to your sidebars', 'collapsible_widget_domain' ), ) 
        );
    }
      
    // Creating widget front-end
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
        $title_tag =  apply_filters( 'widget_title', $instance['title_tag'] );
        $identifier = apply_filters( 'widget_title', $instance['identifier'] );
        $widget_id = $args['id'];
        $content = $instance['content'];
  
        // before and after widget arguments are defined by themes
        echo '<div class="collapsible-header">';
            echo '<button type="button" data-toggle="collapse" data-target="#'.$identifier.'" aria-expanded="false" aria-controls="'.$identifier.'">';
            if ( ! empty( $title ) )
                echo '<'.$title_tag.' class="card-title">' . $title . '</'.$title_tag.'>';
            echo '</button>';
        echo '</div>';
        echo '<div id="'.$identifier.'" class="collapse">';
            echo '<div class="card-content">';  
            echo apply_filters('the_content',$content); 
            echo '</div>';            
        echo '</div>';
        
    }
              
    // Creating widget Backend 
    public function form( $instance ) {
        if ( !empty( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        if ( !empty( $instance[ 'title_tag' ] ) ) {
            $title_tag = $instance[ 'title_tag' ];
        }
        if ( !empty( $instance[ 'identifier' ] ) ) {
            $identifier = $instance[ 'identifier' ];
        }
        if ( !empty( $instance[ 'content' ] ) ) {
            $content = $instance[ 'content' ];
        }
        else {
            $title = __( 'Collapsible Header', 'collapsible_widget_domain' );
            $title_tag = __( 'span', 'collapsible_widget_domain' );
            $identifier = __( 'collapsible-identifier', 'collapsible_widget_domain' );
            $content = __( 'Collapsible Content', 'collapsible_widget_domain' );
        }
        // Widget admin form
        ?>
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
                <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'title_tag' ); ?>"><?php _e( 'Title HTML Tag:' ); ?></label> 
                <input 
                class="widefat" 
                id="<?php echo $this->get_field_id( 'title_tag' ); ?>" 
                name="<?php echo $this->get_field_name( 'title_tag' ); ?>" 
                type="text" 
                value="<?php echo esc_attr( $title_tag ); ?>" 
                />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'identifier' ); ?>"><?php _e( 'Identifier:' ); ?></label> 
                <input class="widefat" id="<?php echo $this->get_field_id( 'identifier' ); ?>" name="<?php echo $this->get_field_name( 'identifier' ); ?>" type="text" value="<?php echo esc_attr( $identifier ); ?>" required />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'content' ); ?>"><?php _e( 'Content:' ); ?></label> 
                <textarea class="widefat" id="<?php echo $this->get_field_id( 'content' ); ?>" name="<?php echo $this->get_field_name( 'content' ); ?>" rows="8" cols="10"><?php echo esc_textarea( $content ); ?></textarea>
            </p>

            
        <?php 
    }
          
    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['title_tag'] = ( ! empty( $new_instance['title_tag'] ) ) ? strip_tags( $new_instance['title_tag'] ) : '';
        $instance['identifier'] = ( ! empty( $new_instance['identifier'] ) ) ? strip_tags( $new_instance['identifier'] ) : '';
        $instance['content'] = $new_instance['content'];
        return $instance;
    }
     
    // Class collapsible_widget ends here
} 
// Register Widget
function collapsible_load_widget() {
    register_widget( 'collapsible_widget' );
}
add_action( 'widgets_init', 'collapsible_load_widget' );