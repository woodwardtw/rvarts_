<?php
/**
 * Template Name: New Front Page
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
$now = date("Y-m-d G:i:s");

$proj_events = tribe_get_events( array(
		'posts_per_page' => 3,
		'start_date'     => date( 'Y-m-d H:i:s', strtotime( $now ) ),
		'end_date'       => date( 'Y-m-d H:i:s', strtotime( $now ) ),
		'eventDisplay'   => 'custom',
		'posts_per_page' => -1
		//'eventDisplay' => 'list' // only upcoming
	), true ); ?>
	<?php if( $proj_events->have_posts() ) :
	?>
<div class="container">
			    <div class="row">	
			    		<h3>Today</h3>
			<?php while( $proj_events->have_posts() ) : $proj_events->the_post(); ?>
				<div class="col-md-4">
					<?php the_post_thumbnail('medium',array( 'class' => 'img-responsive' ));?>
					<a href="<?php the_permalink(); ?>"><div class="carousel-caption"><h1><?php the_title(); ?></h1></div></a> <span class="entry-meta"><?php echo tribe_get_start_date( null, true, 'g:ia, F j' ); ?></span>
					</div>
			<?php endwhile; ?>
		</div>
	</div>
	<?php else: ?>
		<p>There are currently no upcoming events for <?php the_title(); ?>.</p>
	</div>
	<?php endif; wp_reset_postdata(); ?>

	<?php 
$now = date("Y-m-d G:i:s");

$proj_events = tribe_get_events( array(
		'posts_per_page' => 3,
		'start_date'     => date( 'Y-m-d H:i:s', strtotime( '+1 day') ),
		'end_date'       => date( 'Y-m-d H:i:s', strtotime( '+1 week' ) ),
		'eventDisplay'   => 'custom',
		'posts_per_page' => -1
		//'eventDisplay' => 'list' // only upcoming
	), true ); ?>
	<?php if( $proj_events->have_posts() ) :
	    $countposts = $proj_events->found_posts;

	?>
<div class="container">
			    <div class="row">	
			    		<h3><?php echo $countposts; ?> Events This Week</h3>
			<?php while( $proj_events->have_posts() ) : $proj_events->the_post(); ?>
				<div class="col-md-3">
					<?php the_post_thumbnail('medium',array( 'class' => 'img-responsive' ));?>
					<a href="<?php the_permalink(); ?>"><div class="carousel-caption"><h1><?php the_title(); ?></h1></div></a> <span class="entry-meta"><?php echo tribe_get_start_date( null, true, 'g:ia, F j' ); ?></span>
					</div>
			<?php endwhile; ?>
		</div>
	</div>
	<?php else: ?>
		<p>There are currently no upcoming events for <?php the_title(); ?>.</p>
	</div>
	<?php endif; wp_reset_postdata(); ?>


<?php get_footer(); ?>
