<?php
/**
 * Single Event Meta (Additional Fields) Template
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe-events/pro/modules/meta/additional-fields.php
 *
 * @package TribeEventsCalendarPro
 */

if ( ! isset( $fields ) || empty( $fields ) || ! is_array( $fields ) ) {
	return;
}

?>



<div class="tribe-events-meta-group tribe-events-meta-group-other">
	<h3 class="tribe-events-single-section-title"> Hashtag
</h3>
	<dl>
		<?php foreach ( $fields as $name => $value ): ?>
			<dt>  </dt>
			<dd class="tribe-meta-value">
				<?php
				// This can hold HTML. The values are cleansed upstream
				echo "#".$value;
				?>
			</dd>

			<!-- Twitter button  and search display (generic at the moment)-->
			 <a href="https://twitter.com/share" class="twitter-share-button"{count} data-url="<?php tribe_get_events_link() ?>" data-text="I'm at <?php the_title();?>" data-via="RVA2Z" data-size="large" data-hashtags="rvarts, <?php echo $value;?> ">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
<a class="twitter-timeline" href="https://twitter.com/hashtag/rvarts" data-widget-id="684094335009320960">#rvarts Tweets</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		<?php endforeach ?>
	</dl>
</div>

<div class="tribe-events-meta-group tribe-events-meta-group-details">
	<h3 class="tribe-events-single-section-title"> Reviews </h3>
		<dl>
			<dd class="tribe-meta-value">
				<?php

					// The Reviews Query + the hashtag - shows only the first two submitted
					$args = array( 
						'category_name' => 'reviews',
						'tag' => $value,
						'posts_per_page' => 2,
						'order' => 'ASC',
						);
					

					$the_query = new WP_Query( $args );
					//only display option to write a post if user is logged in	
					if ( is_user_logged_in() ) {

						$found_posts = $the_query->found_posts;
						$writesomething = 'We need 2 posts but found ' . $found_posts . '. You should write one.';

							if ($found_posts < 2) {
								$formurl = site_url('/wp-content/themes/rvarts/create_post.php');
								echo $writesomething;
								echo '<br/>
								<form action="'. $formurl .'" method="post">
								<input type="hidden" name="postcategory" value="reviews"> 
								<input type="hidden" name="posttag" value="'. $value .'"> 
								<input type="submit" class="button" name="submit" value="Write a review" />
								</form>
								';

							}
							else{
								//just roll on
							}
					}
					// The Loop
					if ( $the_query->have_posts() ) {
						while ( $the_query->have_posts() ) {
							$the_query->the_post();
							echo '<a href="' . get_the_permalink() . '"><div class="review">';
							echo  the_post_thumbnail('thumbnail' , array( 'class' => 'alignleft' )) . '<h3>' . get_the_title() . '</h3>' . get_the_excerpt();
							echo '</div></a>';
						}
					} else {
						// no posts found
						echo 'No posts found';
					}
					/* Restore original Post Data */
					wp_reset_postdata();

					?>
			</dd>
		</dl>
</div>	

<div class="tribe-events-meta-group tribe-events-meta-group-details">
	<h3 class="tribe-events-single-section-title"> Interviews </h3>
		<dl>
			<dd class="tribe-meta-value">
				<?php

					// The interviews Query + the hashtag - shows only the first two submitted
					$args = array( 
						'category_name' => 'interviews',
						'tag' => $value,
						'posts_per_page' => 2,
						'order' => 'ASC',
						);

					$the_query = new WP_Query( $args );
					//only display option to write a post if user is logged in	
					if ( is_user_logged_in() ) {

						$found_posts = $the_query->found_posts;
						$writesomething = 'We need 2 posts but found ' . $found_posts . '. You should write one.';

							if ($found_posts < 2) {
								$formurl = site_url('/wp-content/themes/rvarts/create_post.php');
								echo $writesomething;
								echo '<br/>
								<form action="'. $formurl .'" method="post">
								<input type="hidden" name="postcategory" value="interviews"> 
								<input type="hidden" name="posttag" value="'. $value .'"> 
								<input type="submit" class="button" name="submit" value="Write an interview" />
								</form>
								';

							}
							else{
								//just roll on
							}
					}

					// The Loop
					if ( $the_query->have_posts() ) {
						while ( $the_query->have_posts() ) {
							$the_query->the_post();
							echo '<a href="' . get_the_permalink() . '"><div class="review">';
							echo  the_post_thumbnail('thumbnail' , array( 'class' => 'alignleft' )) . '<h3>' . get_the_title() . '</h3>' . get_the_excerpt();
							echo '</div></a>';

						}
					} else {
						// no posts found
						echo 'No posts found';						
					}
					/* Restore original Post Data */
					wp_reset_postdata();

					?>
			</dd>
		</dl>
</div>	

<div class="tribe-events-meta-group tribe-events-meta-group-details">
	<h3 class="tribe-events-single-section-title"> Features </h3>
		<dl>
			<dd class="tribe-meta-value">
				<?php

					// The features Query + the hashtag - shows only the first two submitted
					$args = array( 
						'category_name' => 'features',
						'tag' => $value,
						'posts_per_page' => 2,
						'order' => 'ASC',
						);

					$the_query = new WP_Query( $args );
					//only display option to write a post if user is logged in	
					if ( is_user_logged_in() ) {

						$found_posts = $the_query->found_posts;
						$writesomething = 'We need 2 posts but found ' . $found_posts . '. You should write one.';
							$formurl = site_url('/wp-content/themes/rvarts/create_post.php');
								echo $writesomething;
								echo '<br/>
								<form action="'. $formurl .'" method="post">
								<input type="hidden" name="postcategory" value="features"> 
								<input type="hidden" name="posttag" value="'. $value .'"> 
								<input type="submit" class="button" name="submit" value="Write a feature" />
								</form>
								';

							}
							else{
								//just roll on
							}
					

					// The Loop
					if ( $the_query->have_posts() ) {
						while ( $the_query->have_posts() ) {
							$the_query->the_post();
							echo '<a href="' . get_the_permalink() . '"><div class="review">';
							echo  the_post_thumbnail('thumbnail' , array( 'class' => 'alignleft' )) . '<h3>' . get_the_title() . '</h3>' . get_the_excerpt();
							echo '</div></a>';
						}
					} else {
						// no posts found
						echo ' No posts found';						
					}
					/* Restore original Post Data */
					wp_reset_postdata();

					?>
			</dd>
		</dl>
</div>	