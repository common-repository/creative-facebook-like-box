<?php
/*
Plugin Name: Creative Like Box
Plugin URI: http://profiles.wordpress.org/mnaopu
Description: This is a simple Facebook Like Box Plugin. By this plugin you can add a widget for your Facebook page.
Author: Md. Naeem Ahmed Opu
Version: 2.2
Author URI: http://profiles.wordpress.org/mnaopu
*/

//Admin Notice
function cflbox_notice() {
    ?>
    <div class="notice notice-success is-dismissible">
        <p><?php _e( 'Thanks! For Using <strong>Creative Like Box</strong> Plugin', '' ); ?></p>
    </div>
    <?php
}
add_action( 'admin_notices', 'cflbox_notice' );

// Additing Action hook
add_action( 'widgets_init', 'cflbox_widget'); 

//Register Widget
function cflbox_widget() {
register_widget( 'cflbox_info' );
}

//Main Class
class cflbox_info extends WP_Widget {


//Widget Function
function cflbox_info () {
	$this->WP_Widget('cflbox_info', 'Creative Like Box', $widget_ops );        
}

public function form( $instance ) {

if ( isset( $instance[ 'title' ]) && isset( $instance[ 'pageid' ]) && isset ($instance[ 'pageurl' ]) && isset($instance[ 'height' ]) && isset($instance[ 'width' ]) ) {
$title = $instance[ 'title' ];
$pageurl = $instance[ 'pageurl' ];
$height = $instance[ 'height' ];
$width = $instance[ 'width' ];
$pageid = $instance[ 'pageid' ];
}
else {
$title = __( '', 'cflbox_widget_title' );
$pageurl = __( '', 'cflbox_widget_page_url' );
$height = __( '', 'cflbox_widget_height' );
$width = __( '', 'cflbox_widget_width' );
$pageid = __( '', 'cflbox_widget_pageid' );
} ?>

<p>Page Title: <input class="widefat" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title );?>" /></p>

<p>Facebook Page URL: <input class="widefat" name="<?php echo $this->get_field_name( 'pageurl' ); ?>" type="text" value="<?php echo esc_attr( $pageurl ); ?>" /></p>

<p>Facebook Page ID: <input class="widefat" name="<?php echo $this->get_field_name( 'pageid' ); ?>" type="text" value="<?php echo esc_attr( $pageid ); ?>" /></p>

<p>Page Height: <input class="widefat" name="<?php echo $this->get_field_name( 'height' ); ?>" type="text" value="<?php echo esc_attr( $height ); ?>" /></p>

<p>Page Width: <input class="widefat" name="<?php echo $this->get_field_name( 'width' ); ?>" type="text" value="<?php echo esc_attr( $width ); ?>" /></p>

<?php

}

function update($new_instance, $old_instance) {

$instance = $old_instance;

$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

$instance['pageurl'] = ( ! empty( $new_instance['pageurl'] ) ) ? strip_tags( $new_instance['pageurl'] ) : '';

$instance['height'] = ( ! empty( $new_instance['height'] ) ) ? strip_tags( $new_instance['height'] ) : '';

$instance['width'] = ( ! empty( $new_instance['width'] ) ) ? strip_tags( $new_instance['width'] ) : '';

$instance['pageid'] = ( ! empty( $new_instance['pageid'] ) ) ? strip_tags( $new_instance['pageid'] ) : '';

return $instance;

}

function widget($args, $instance) {

extract($args);

echo $before_widget; 

$title = apply_filters( 'widget_title', $instance['title'] );

$pageurl = empty( $instance['pageurl'] ) ? '&nbsp;' : $instance['pageurl'];

$height = empty( $instance['height'] ) ? '&nbsp;' : $instance['height'];

$width = empty( $instance['width'] ) ? '&nbsp;' : $instance['width'];

$pageid = empty( $instance['pageid'] ) ? '&nbsp;' : $instance['pageid'];

if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
?>

<!--Load Facebook JS-->

<div id="fb-root"></div>

<script> (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&appId=549966225039884&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk')); </script>

<div class="fb-like-box" data-href="<?php echo $pageurl; ?>" data-width="<?php echo $width; ?>" data-height="<?php echo $height; ?>" data-colorscheme="dark" data-header="true" data-stream="false" data-show-border="true" data-show-faces="true"></div>
<?php 
} }

?>