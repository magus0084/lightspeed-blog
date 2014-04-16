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
				
				<div id="inner-content" class="wrap clearfix">

					<div id="main" class="twelvecol first clearfix" role="main">
					<h1 class="archive-title"><span><?php _e( '[:en]Search Results for:[:ja]検索結果：', 'bonestheme' ); ?></span> <?php echo esc_attr(get_search_query()); ?></h1>

						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<?php /* Create Article Boxes */ ?>
							<?php create_article_box($noSidebar = true, $showExcerpt = true, $showDate = true, $showCategories = true, $excerptLength = $numCharsExcerptShort); ?>	

						<?php endwhile; ?>

						<?php if (function_exists('bones_page_navi')) { ?>
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
									<h1><?php _e( 'Sorry, No Results.', 'bonestheme' ); ?></h1>
								</header>
								<section class="entry-content">
									<p><?php _e( 'Please try your search again, or maybe the following might interest you.', 'bonestheme' ); ?></p>
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
						<?php endif; ?>
					</div><!-- CLOSE #main -->
					
					
					
				</div><!-- CLOSE #inner-content -->
				
			</div><!-- CLOSE #content -->

<?php get_footer(); ?>
