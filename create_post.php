<?php

$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );

function makethepost() {
// Create post object

if(isset($_POST['postcategory'])){ $postcat = $_POST['postcategory']; } 
if(isset($_POST['posttag'])){ $posttag = $_POST['posttag']; } 

$location = site_url();

$post_ID = get_cat_ID($postcat);

$user_ID = get_current_user_id();
$my_post = array(
  'post_title'    => 'Make your own good title',
  'post_content' => 'Write something beautiful.',
  'post_name'      => $postcat . 'on' . $posttag ,
  'post_status'   => 'draft',
  'post_author'   => $user_ID,
  'post_category' => array($post_ID),
  'tags_input' => $posttag
);

// Insert the post into the database

$post_id = wp_insert_post( $my_post);

$location = $location . '/wp-admin/post.php?post=' . $post_id .'&action=edit' ;
echo '<script type="text/javascript">
           window.location = "'. $location .'"
      </script>';
}
makethepost();
?>