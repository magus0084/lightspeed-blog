<?php global $defaultImage; ?>
				
				<div id="sidebar1" class="sidebar fourcol last clearfix" role="complementary">

					<?php if ( is_active_sidebar( 'sidebar1' ) ) : ?>

						<?php dynamic_sidebar( 'sidebar1' ); ?>

					<?php else : ?>

						<?php /* Content to show if there are no widgets */ ?>

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
						
						$editorials = wp_get_recent_posts($args, OBJECT);
						
						
						if (isset($editorials)) { ?>
								<?php shuffle($editorials); ?>
								
								<div class="widget" id="widget-recommended">
									<h4 class="widgettitle">
										<?php qtrans_TextTranslate('Features', 'お薦め記事', $showText = true); ?>
									</h4>
									
									<ul class="no-bullets">
									<?php for ( $i=0; $i<3; $i++ ) {
										$postID = $editorials[$i]->ID; ?>
										
										
										<?php /*while($editorials->have_posts() || $i<3 ) : $editorials->the_post(); $i++;*/ ?>
														
											<!-- RECOMMENDED POST -->
											<li class="recommended-post">
											
												<!-- IMAGE -->
												<a href="<?php echo get_permalink( $postID ); ?>" title="<?php echo get_the_title( $postID ); ?>">
													<?php
														$photo = get_the_post_thumbnail($postID, 'recommended-post-img');
																	
														if ($photo != '') echo $photo;
														else echo '<img width="550" height="375" src="'.$defaultImage.'" class="attachment-recommended-post-img wp-post-image" alt="'.get_the_title( $postID ).'">';
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