<?php get_header(); ?>

			<div id="content">

				<!-- IMAGE HEADER -->
				<?php if (has_post_thumbnail()) {
						$thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full-size'); ?> 	
						<header id="post-header-image" class="header-image" style="background-image:url('<?php echo $thumb[0]; ?>');"></header>
				<?php } else { ?>
						<header id="post-header-image" class="header-image" style="background-image:url('<?php echo $defaultImage ?>');"></header>
				<?php } ?>
							
				<div id="inner-content" class="wrap clearfix article-page">
					
					<!-- TAGLINE -->
					<aside id="tagline">
						On Pace. On Target. IT Industry Insights.<br>
						<span>Powered by KVH</span>
					</aside>
					
					<!-- MAIN CONTENT -->
					<div id="main" class="eightcol first clearfix" role="main">

						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						
							<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<header class="article-header">

									<h1 class="entry-title single-title" itemprop="headline"><?php the_title(); ?></h1>
									<?php
										$entryExcerpt = get_excerpt_by_chars($numCharsExcerptLong, $appendingString = '', $showAutoExcerpt = false);
										//$entryExcerpt = get_the_excerpt();
										if ($entryExcerpt != '') {
											printf ( __('<p class="entry-excerpt single-excerpt" itemprop="summary">%1s</p>'), $entryExcerpt);
										} else {
											return;		
										}
									?>
									
									<!-- USER INFO -->
									<p id="writtenByBox"><?php
										printf( __( '<a href="%1$s" rel="author">%2$s</a>', 'bonestheme'), get_author_posts_url( get_the_author_meta( 'ID' ) ) , get_avatar( get_the_author_meta( 'ID' ) , 100 )); 
										printf( __( '<span class="written-by-text">By <span class="author">%1$s</span></span>', 'bonestheme' ), bones_get_the_author_posts_link() );
									?></p>

								</header>

								<!-- POST CONTENT -->
								<section class="entry-content clearfix" itemprop="articleBody">
									<?php the_content(); ?>
								</section>

								<footer class="article-footer">
									<?php the_tags( '<p class="tags"><span class="tags-title">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '</p>' ); ?>
									
									<!-- PUBLISHED DATE -->
									<?php
										printf( __( '<p class="published-date">Posted on <time class="updated" datetime="%1$s" pubdate>%2$s</time> <span class="amp">&amp;</span> filed under %3$s.</p>', 'bonestheme' ), get_the_date(), get_the_date( get_option('date_format')), get_the_category_list(', ') );
									?>
								</footer>
								
								<!-- AUTHOR BIO BOX -->
								<?php the_author_bio(get_the_author_meta( 'ID' )); ?>
								
								<nav class="related-content">
								
									<!-- RELATED ARTICLES -->
									<?php global $post;
										$categories = get_the_category();
										$category = $categories[rand(0, count($categories) - 1)]; ?>
										
										<h2>You Might Also Be Interested In</h2>
										<ul class="clearfix">
											<?php
												$currentPostID = get_the_ID();
												$args = array(
													'numberposts' => $numRecommendedPosts,
													'category' => $category->term_id,
													'post__not_in' => array( $currentPostID )
												);
												$posts = get_posts($args);
												$index = 0;
												foreach($posts as $post) : setup_postdata($post); $index++; ?>
												
													<li class="related-article threecol <?php if ($index==1) {echo 'first'; } ?>">
														<a href="<?php the_permalink(); ?>">
															<?php if (has_post_thumbnail()) {
																	$thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail'); ?> 	
																	<img class="related-article-img square-img" src="<?php echo $thumb[0]; ?>">
															<?php } else { ?>
																	<img class="related-article-img square-img" src="<?php echo $defaultImageThumb; ?>">
															<?php } ?>
															<h5><?php the_title(); ?></h5>
														</a>
													</li>
												<?php endforeach; 
												wp_reset_postdata(); ?>
										</ul>
								</nav>
								
								<!-- COMMENTS -->
								<?php comments_template(); ?>

							</article>

						<?php endwhile; ?>

						<?php else : ?>

							<article id="post-not-found" class="hentry clearfix">
									<header class="article-header">
										<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
									</header>
									<section class="entry-content">
										<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
									</section>
									<footer class="article-footer">
											<p><?php _e( 'This is the error message in the single.php template.', 'bonestheme' ); ?></p>
									</footer>
							</article>

						<?php endif; ?>

					</div> <!-- CLOSE #main -->

					<?php get_sidebar(); ?>

				</div><!-- CLOSE #inner-content -->

			</div><!-- CLOSE #content -->

<?php get_footer(); ?>
