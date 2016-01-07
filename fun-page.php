<?php
/**
 * Template Name: Front Page
 * The template for displaying something RVArts related on the front page.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package _tk
 * @package TribeEventsCalendar
 */

get_header(); ?>

	<?php 
$args = array(
  'post_status'=>'publish',
  'post_type'=>array(Tribe__Events__Main::POSTTYPE),
  'posts_per_page'=>10,
  //order by startdate from newest to oldest
  'meta_key'=>'_EventStartDate',
  'orderby'=>'_EventStartDate',
  'order'=>'DESC',
  //required in 3.x
  'eventDisplay'=>'custom',
  //query events by category
 // 'tax_query' => array(
 //     array(
 //         'taxonomy' => 'tribe_events_cat',
 //         'field' => 'slug',
 //         'terms' => 'featured',
 //         'operator' => 'IN'
 //     ),
//  )
);
$get_posts = null;
$get_posts = new WP_Query();
$get_posts->query($args);
if($get_posts->have_posts()) : while($get_posts->have_posts()) : $get_posts->the_post(); ?>

  <a href="<?php the_permalink(); ?>">
    <?php the_title(); ?>
  </a><br />
  
  <?php if (tribe_get_start_date() !== tribe_get_end_date() ) { ?>
    <?php echo tribe_get_start_date(); ?> - <?php echo tribe_get_end_date(); ?>
  <?php } else { ?>
    <?php echo tribe_get_start_date(); ?>
  <?php } ?>
  
  <?php the_content(); ?>

<?php
  endwhile;
  endif;
  wp_reset_postdata();
?>

<?php get_footer(); ?>
