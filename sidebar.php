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
						$currentPostID = get_the_ID();
						$args = array(
							'numberposts' => 10,
							'meta_key' => 'recommended',
							'meta_value' => 'yes',
							'post__not_in' => array( $currentPostID ),
							'orderby' => 'post_date'
						);
						//$currentPostID = get_the_ID();
						/*$args=array(
							'posts_per_page' => 6, 
							'update_post_meta_cache' => false,
							'orderby' => 'rand', 
							'post__not_in' => array( $currentPostID ),
							'meta_query' => array(
								array(
									'key' => 'recommended',
									'value' => 'yes',
								)
							)
						); */
						//$i = 0;
						$editorials = wp_get_recent_posts($args, OBJECT);
						
						//$editorials = new WP_Query($args);
								
						// If there are recommended posts add a recommended post widget
						/*if($editorials->have_posts()) { ?>*/
						
						
						if (isset($editorials)) { ?>
								<?php shuffle($editorials); ?>
								
								<div class="widget" id="widget-recommended">
									<h4 class="widgettitle">
										<?php qtrans_TextTranslate('Features', 'お薦め記事'); ?>
									</h4>
									
									<ul>
									<?php for ( $i=0; $i<3; $i++ ) {
										$postID = $editorials[$i]->ID; ?>
										
										
										<?php /*while($editorials->have_posts() || $i<3 ) : $editorials->the_post(); $i++;*/ ?>
														
											<!-- RECOMMENDED POST -->
											<li class="recommended-post">
											
												<!-- IMAGE -->
												<a href="<?php echo get_permalink( $postID ); ?>" title="<?php echo get_the_title( $postID ); ?>">
													<?php
														$photo = get_the_post_thumbnail($postID, 'recommended-post-img');
																	
														if (isset($photo)) { 
															echo $photo;
														}
													?>
												</a>
												
												<!-- TITLE -->
												<h5>
													<a href="<?php echo get_permalink( $postID ); ?>" title="<?php echo get_the_title( $postID ); ?>">
														<?php echo get_the_title( $postID ); ?>
													</a>
												</h5>
											</li>
									<?php } ?>
										<?php /*endwhile;*/ ?>
									</ul>
								</div>		
						<?php } ?>
				</div>