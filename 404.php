<?php get_header(); ?>

			<div id="content">
			
				<!-- IMAGE HEADER -->
				<header id="post-header-image" class="header-image short-header-image" style="background-image:url('<?php echo $defaultImage ?>');"></header>

				<div id="inner-content" class="wrap clearfix">
				
					<!-- TAGLINE -->
					<aside id="tagline">
						On Pace. On Target. IT Industry Insights.<br>
						<span>Powered by KVH</span>
					</aside>

					<!-- MAIN -->
					<div id="main" class="twlevecol first clearfix" role="main">

						<article id="post-not-found" class="hentry clearfix">

							<header class="article-header">

								<h1><?php _e( 'Epic 404 - Article Not Found', 'bonestheme' ); ?></h1>

							</header>

							<section class="entry-content">

								<p><?php _e( 'The article you were looking for was not found, but maybe try looking again! Or perhaps one of the articles below might interest you.', 'bonestheme' ); ?></p>

							</section>

							<section class="search">

									<p><?php get_search_form(); ?></p>

							</section>

							<footer class="article-footer">

							</footer>

						</article>
						
						<?php /* Adding this class is somewhat of a hack to get the separator line */ ?>
						<div class="related-content">
							<h2><?php qtrans_TextTranslate('Other Recommended Articles', 'お薦め記事', $showText = true); ?></h2>
							<?php 
								$args=array(
									'posts_per_page' => 6, 
									'update_post_meta_cache' => false,
									'orderby' => 'rand', 
									'meta_query' => array(
										array(
											'key' => 'recommended',
											'value' => 'yes',
										)
									)
								);
								$recommended = new WP_Query($args);
									
								// Start loop
								if($recommended->have_posts()) : while($recommended->have_posts()) : $recommended->the_post();
											
									create_article_box($noSidebar = true, $showExcerpt = true, $showDate = false, $showCategories = false, $excerptLength = null);
										
								endwhile; endif; ?>
							<?php wp_reset_postdata(); ?>
						</div>
					</div><!-- CLOSE #main -->

				</div>

			</div>

<?php get_footer(); ?>
