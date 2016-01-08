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
 */

get_header(); ?>

	<?php if ( have_posts() ) : ?>

		<?php /* Start the Loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<div class="container">
			    <div class="row">			       
			<?php

					// The Reviews Query + the hashtag - shows only the first two submitted
					$args = array( 
						'order' => 'ASC',
						);
					

					$the_query = new WP_Query( $args );
					
					// The Loop
					if ( $the_query->have_posts() ) {
						while ( $the_query->have_posts() ) {
							$the_query->the_post();
							echo ' <div class="col-md-4">';
							echo '<a href="' . get_the_permalink() . '">' . the_post_thumbnail('full-size',array( 'class' => 'img-responsive' )); 
							echo '<div class="carousel-caption"><h1>' . get_the_title() . '</h1></div></a></div>' ;
						}
					} else {
						// no posts found
						echo 'No posts found';
					}
					/* Restore original Post Data */
					wp_reset_postdata();

					?>
				</div>
			</div>
		<?php endwhile; ?>

		<?php _tk_content_nav( 'nav-below' ); ?>

	<?php else : ?>

		<?php get_template_part( 'no-results', 'index' ); ?>

	<?php endif; ?>

<?php get_footer(); ?>
