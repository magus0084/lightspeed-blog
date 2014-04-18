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

				<!-- #inner-content -->
				<div id="inner-content" class="wrap clearfix">

						<!-- MAIN -->
						<div id="main" class="eightcol first clearfix" role="main">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<!-- ARTICLE #post -->
							<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<header class="article-header">

									<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>
									
								</header>

								<section class="entry-content clearfix" itemprop="articleBody">
									<?php the_content(); ?>
								</section>

								<footer class="article-footer">
									<?php the_tags( '<span class="tags">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '' ); ?>

								</footer>

								<!-- REMOVED COMMENTS FOR PAGES -->
								<?php /* comments_template(); */ ?>

							</article><!-- CLOSE ARTICLE #post -->

							<?php endwhile; else : ?>

									<article id="post-not-found" class="hentry clearfix">
										<header class="article-header">
											<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
										</header>
										<section class="entry-content">
											<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
										</section>
										<footer class="article-footer">
												
										</footer>
									</article>

							<?php endif; ?>

						</div> <!-- CLOSE #main -->

						<?php get_sidebar(); ?>

				</div> <!-- CLOSE #inner-content -->

			</div> <!-- CLOSE #content -->

<?php get_footer(); ?>
