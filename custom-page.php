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
    $now = date("Y-m-d");
$proj_events = tribe_get_events( array(
		'start_date'     => date( 'Y-m-d' . 'T00:00:01'),
		'end_date'       => date( 'Y-m-d' . 'T23:59:59'),
		'eventDisplay'   => 'custom',
		'posts_per_page' => -1,
		'tax_query'=> array(
                array(
                    'taxonomy' => 'tribe_events_cat',
                    'field' => 'slug',
                    'terms' => 'long-term',
                    'operator' => 'NOT IN',
                )
            )
		//'eventDisplay' => 'list' // only upcoming
	), true ); 
	?>

	<?php 
	if( $proj_events->have_posts()) :
	?>

	<div class="container" title="content">
	        <div class="row">
	            <?php while( $proj_events->have_posts() ) : $proj_events->the_post(); ?>
		            <div class="col-md-4 col-xs-12">
			            <div class="front-card">
			                <a href="<?php the_permalink(); ?>"> 
			                <?php the_post_thumbnail('front-page-thumb',array( 'class' => 'img-front front-page-thumb' ));?>
			                </a>
			                <a href="<?php the_permalink(); ?>"> 
			                <div class="row front-date-row">
			                    <div class="col-md-3">
			                        <div class="front-day">
			                            <?php echo tribe_get_start_date(null, false, 'd');?>
			                        </div>
			                        <div class="front-month">
			                            <?php echo tribe_get_start_date(null, false, 'M');?>
			                        </div>			                        
			                    </div>
			                    <div class="col-md-9 front-event-title">
			                        <?php 			                        	
			                        	echo substr(the_title($before = "", $after = "", FALSE),0, 35);?> 			                        	
			                        	<br>
			                        <span class="front-location">
			                        <?php echo tribe_get_full_address(); ?></span>

			                    </div>
			                </div>
			                </a>
			            </div>
		            </div>
		        <?php endwhile; ?>
	        </div>
	    </div>

	<?php else: ?>
		<p>There are currently no upcoming events for <? current_time( 'Y-m-d' ); ?>.</p>
</div>


	<?php endif; wp_reset_postdata(); ?>

	<?php 
$now = date("Y-m-d G:i:s");

$proj_events = tribe_get_events( array(
		'start_date'     => date( 'Y-m-d H:i:s', strtotime( '+1 day') ),
		'end_date'       => date( 'Y-m-d H:i:s', strtotime( '+1 week' ) ),
		'eventDisplay'   => 'custom',
		'posts_per_page' => -1,
		'tax_query'=> array(
                array(
                    'taxonomy' => 'tribe_events_cat',
                    'field' => 'slug',
                    'terms' => 'long-term',
                    'operator' => 'NOT IN',
                )
            )

		//'eventDisplay' => 'list' // only upcoming
	), true ); ?>
	<?php if( $proj_events->have_posts() ) :
	    $countposts = $proj_events->found_posts;

	?>
<div class="container">
	<div class="row">	
		<h3><?php echo $countposts; ?> Events This Week</h3>
		<?php while( $proj_events->have_posts() ) : $proj_events->the_post(); ?>
		<div class="col-md-2">
			<div class="front-card">
			<a href="<?php the_permalink(); ?>"> 
		    	<?php the_post_thumbnail('thumbnail',array( 'class' => 'img-front' ));?>
		    </a>
		    <a href="<?php the_permalink(); ?>"> 
		        <div class="row front-date-row week">
		            <div class="col-md-12 front-date">
		                <div class="front-day">
		                    <?php echo tribe_get_start_date(null, false, 'd');?>
		                </div>
		                <div class="front-month">
		                    <?php echo tribe_get_start_date(null, false, 'M');?>
		                </div>
		            </div>
		            <div class="col-md-12 front-event-title">
		                	<?php echo substr(the_title($before = "", $after = "", FALSE),0, 20);?><br>
		                <span class="front-location">
		                    <?php echo tribe_get_full_address(); ?>
		                </span>
		            </div>
		        </div>
		    </a> 
		   </div>
		</div>
			<?php endwhile; ?>
	</div>
</div>
	<?php else: ?>
		<p>There are currently no upcoming events for the next seven days</p>
</div>
	<?php endif; wp_reset_postdata(); ?>


<?php get_footer(); ?>
