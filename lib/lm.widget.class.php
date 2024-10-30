<?php
class LugMap_Widget extends WP_Widget {
    
    function LugMap_Widget() {
        $widget_ops = array( 'classname' => 'lm_widget', 'description' => 'Widget displays Lug Map entries.' );
        $control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'lm_widget' );
        $this->WP_Widget( 'lm_widget', 'Lug Map Widget', $widget_ops, $control_ops );
        add_action('widgets_init', array(&$this, 'register'));
    }

    function widget( $args, $instance ) {
        extract( $args );
        global $lm_widget_content;
        $title = apply_filters('widget_title', $instance['title'] );
        echo $before_widget;
        if ( $title )
            echo $before_title . $title . $after_title;
        echo $lm_widget_content;
        echo $after_widget;
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags( $new_instance['title'] );
        return $instance;
    }

    function form( $instance ) {
        $defaults = array( 'title' => 'LugMap' );
        $instance = wp_parse_args( (array) $instance, $defaults ); ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?=__('Title')?>:</label>
            <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
        </p>
        <?php
    }
    
    function register() {
        register_widget( 'LugMap_Widget' );
    }
}
?>