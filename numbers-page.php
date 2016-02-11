<?php
/**
 * Template Name: list numbers
 * The template for displaying the RVArts Hashtag
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


	<div class="container front" title="content">
	<div class="row">
	<h2>count</h2>

<?php midea_list_authors('participant'); ?> 

	<h2>I am a failure</h2>
<?php $user_query = new WP_User_Query( array(
	'orderby'          => 'ID',
	'prefix_post_type' => 'blog'
) );
$users = $user_query->get_results();
foreach ( $users as $user ) {
	echo $user->display_name, '<br />';
}
	
?>

</div>

	
</div>

<?php get_footer(); ?>