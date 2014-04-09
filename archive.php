<?php get_header(); ?>

			<div id="content">
			
				<!-- IMAGE HEADER -->
				<?php
					if (has_post_thumbnail()) {
					$thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full-size');
					?> 	
					<header id="post-header-image" class="header-image short-header-image" style="background-image:url('<?php echo $thumb[0]; ?>');"></header>
				<?php } else {
					$thumb = $defaultImage;
					?>
					<header id="post-header-image" class="header-image short-header-image" style="background-image:url('<?php echo $defaultImage ?>');"></header>
				<? } ?>

				<!-- BEGIN MAIN CONTENT -->
				<div id="inner-content" class="wrap clearfix">
				
						<!-- TAGLINE -->
						<aside id="tagline">On Pace. On Target. IT Industry Insights.</aside>
					
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
									<span><?php _e( 'Daily Archives:', 'bonestheme' ); ?></span> <?php the_time('l, F j, Y'); ?>
								</h1>

							<?php } elseif (is_month()) { ?>
									<h1 class="archive-title">
										<span><?php _e( 'Monthly Archives:', 'bonestheme' ); ?></span> <?php the_time('F Y'); ?>
									</h1>

							<?php } elseif (is_year()) { ?>
									<h1 class="archive-title">
										<span><?php _e( 'Yearly Archives:', 'bonestheme' ); ?></span> <?php the_time('Y'); ?>
									</h1>
							<?php } ?>

							
							<!-- BEGIN LOOP -->
							<?php if (have_posts()) : while (have_posts()) : the_post(); 
							
								$postImage = get_the_post_thumbnail($id, 'medium');
								$authorName = get_the_author_meta('display_name');
								$authorURL = get_author_posts_url( get_the_author_meta( 'ID' ) );
								$postImage;
								$postImageLarge;
				
								if (has_post_thumbnail()) {
									$postImage = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium');
									$postImageLarge = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full-size');
								} else {
									$postImage = $defaultImagePath; 
									$postImageLarge = $defaultImagePath;
								}
							?>

								
								<!-- ARTICLE BOX -->
								<article class="article-excerpt-box no-sidebar" role="article">
									
									<!-- POST IMAGE -->
									<a href="<?php the_permalink(); ?>" title="Read the article &quot;<?php the_title(); ?>&quot;">
										<header class="article-excerpt-image" style="background-image:url('<?php echo $postImage[0] ?>');"></header>	
									</a>
											
									<!-- EXCERPT -->
									<div class="article-excerpt-text">
										<h3><a href="<?php the_permalink(); ?>" title="Read the article &quot;<?php the_title(); ?>&quot;"><?php the_title(); ?></a></h3>
														
										<!-- POST EXCERPT AND READ MORE LINK -->
										<?php echo get_excerpt_by_chars($numCharsExcerpt, qtrans_getLanguage() ); ?>
										
										<!-- POST AUTHOR -->
										<p class="article-author">By <a href="<?php echo $authorURL ?>"><?php echo $authorName ?></a></p>
									</div>
								</article>

							<?php endwhile; ?>

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
