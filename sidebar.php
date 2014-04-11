				<div id="sidebar1" class="sidebar fourcol last clearfix" role="complementary">

					<?php if ( is_active_sidebar( 'sidebar1' ) ) : ?>

						<?php dynamic_sidebar( 'sidebar1' ); ?>

					<?php else : ?>

						<?php // This content shows up if there are no widgets defined in the backend. ?>

						<div class="alert alert-help">
							<p><?php _e( 'Please activate some Widgets.', 'bonestheme' );  ?></p>
						</div>

					<?php endif; ?>
					
					<!-- RECOMMENDED POSTS -->
					<?php
						$args=array(
							'numberposts' => $numRecommendedPosts, 
							'orderby' => 'post_date', 
							'meta_query' => array(
								array(
									'key' => 'recommended',
									'value' => 'yes',
								)
							)
						);
						$i = 0;
						$editorials = new WP_Query($args);
								
						// If there are recommended posts add a recommended post widget
						if($editorials->have_posts()) { ?>
								<div class="widget" id="widget-recommended">
									<h4 class="widgettitle">
										Featured
									</h4>
									
									<ul>
										<?php while($editorials->have_posts()) : $editorials->the_post(); $i++; ?>
														
											<!-- RECOMMENDED POST -->
											<li class="recommended-post">
											
												<!-- IMAGE -->
												<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">		
													<?php
														$photo = get_the_post_thumbnail($id, 'recommended-post-img');
																	
														if (isset($photo)) { 
															echo $photo;
														}
													?>
												</a>
												
												<!-- TITLE -->
												<h5>
													<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
														<?php the_title(); ?>
													</a>
												</h5>
											</li>
										<?php endwhile; ?>
									</ul>
								</div>		
						<?php } ?>
				</div>