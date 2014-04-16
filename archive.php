<?php get_header(); ?>

			<div id="content">
			
				<!-- IMAGE HEADER -->
				<?php
					if (has_post_thumbnail()) {
					$thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full-size');
					?> 	
					<header id="post-header-image" class="header-image short-header-image" style="background-image:url('<?php echo $thumb[0]; ?>');"></header>
				<?php } else { ?>
					<header id="post-header-image" class="header-image short-header-image" style="background-image:url('<?php echo $defaultImage ?>');"></header>
				<?php } ?>

				<!-- BEGIN MAIN CONTENT -->
				<div id="inner-content" class="wrap clearfix">
				
						<!-- TAGLINE -->
						<aside id="tagline">
							On Pace. On Target. IT Industry Insights.<br>
							<span>Powered by KVH</span>
						</aside>
					
						<!-- MAIN -->
						<div id="main" class="twelvecol first clearfix archives" role="main">

							<?php if (is_category()) { ?>
								<h1 class="archive-title">
									<?php single_cat_title(); ?>
								</h1>
								
								<!-- CATEGORY DESCRIPTION -->
								<div class="archives-info-box">
									<?php echo category_description(); ?> 
								</div>
								
								

							<?php } elseif (is_tag()) { ?>
								<h1 class="archive-title">
									<span><?php _e( 'Articles Tagged:', 'bonestheme' ); ?></span> <?php single_tag_title(); ?>
								</h1>

							<?php } elseif (is_author()) {
								global $post;
								$author_id = $post->post_author;
							?>
							
								<!-- AUTHOR BIO BOX -->
								<div class="archives-info-box">
									<?php the_author_bio(get_the_author_meta( 'ID' )); ?>
								</div>
								
								<!-- AUTHOR POSTS TITLE -->
								<h1 class="archive-title h2">
									<span><?php _e( 'Articles by ', 'bonestheme' ); ?></span> <?php the_author_meta('display_name', $author_id); ?>
								</h1>
							<?php } elseif (is_day()) { ?>
								<h1 class="archive-title">
									<span><?php _e( 'Daily Archives:', 'bonestheme' ); ?></span> <?php echo mysql2date('l, F j, Y', get_the_date()); ?>
								</h1>

							<?php } elseif (is_month()) { ?>
									<h1 class="archive-title">
										<span><?php _e( 'Monthly Archives:', 'bonestheme' ); ?></span> <?php echo mysql2date('F Y', get_the_date()); ?>
									</h1>

							<?php } elseif (is_year()) { ?>
									<h1 class="archive-title">
										<span><?php _e( 'Yearly Archives:', 'bonestheme' ); ?></span> <?php echo mysql2date('Y', get_the_date()); ?>
									</h1>
							<?php } ?>

							
							<!-- BEGIN LOOP -->
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
							
								<?php /* Create Article Boxes */ ?>
								<?php create_article_box($noSidebar = true, $showExcerpt = true, $showDate = false, $showCategories = false, $excerptLength = null); ?>
								
							<?php endwhile; ?>
							<!-- END LOOP -->

									<?php if ( function_exists( 'bones_page_navi' ) ) { ?>
										<?php bones_page_navi(); ?>
									<?php } else { ?>
										<nav class="wp-prev-next">
											<ul class="clearfix">
												<li class="prev-link"><?php next_posts_link( __( '&laquo; Older Entries', 'bonestheme' )) ?></li>
												<li class="next-link"><?php previous_posts_link( __( 'Newer Entries &raquo;', 'bonestheme' )) ?></li>
											</ul>
										</nav>
									<?php } ?>

							<?php else : ?>

									<article id="post-not-found" class="hentry clearfix">
										<header class="article-header">
											<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
										</header>
										<section class="entry-content">
											<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
										</section>
										<footer class="article-footer">
												<p><?php _e( 'This is the error message in the archive.php template.', 'bonestheme' ); ?></p>
										</footer>
									</article>

							<?php endif; ?>

						</div>
				</div>
			</div>

<?php get_footer(); ?>
