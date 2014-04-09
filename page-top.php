<?php
/*
Template Name: Top Page
*/

?>

<?php get_header(); ?>

	<div id="content" class="top-page">
		<?php
			// Create a new loop
			$args=array(
				'posts_per_page' => $numPostsPerPage,
				'orderby' => 'date'
			);
			$editorials = new WP_Query($args);

			// Start Loop
			if($editorials->have_posts()) : while($editorials->have_posts()) : $editorials->the_post();
						
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
				
				// If this is the first post, add header image using and content space tags
				if( $editorials->current_post == 0 && !is_paged() ) { ?>
					<!-- IMAGE HEADER -->
					<header id="top-page-header-image" class="header-image short-header-image" style="background-image:url('<?php echo $postImageLarge[0] ?>');"></header>
						
						<!-- BEGIN inner-content -->
						<div id="inner-content" class="wrap clearfix top-page">
	
							<!-- TAGLINE -->
							<aside id="tagline">On Pace. On Target. IT Industry Insights.</aside>
					
							<!-- BEGIN main -->
							<div id="main" class="eightcol first clearfix" role="main">
				<?php }?>
								<!-- ARTICLE BOX -->
								<article class="article-excerpt-box">
									
									<!-- POST IMAGE -->
									<a href="<?php the_permalink(); ?>" title="Read the article &quot;<?php the_title(); ?>&quot;">
										<header class="article-excerpt-image" style="background-image:url('<?php echo $postImage[0] ?>');"></header>	
									</a>
											
									<!-- EXCERPT -->
									<div class="article-excerpt-text">
										<h3><a href="<?php the_permalink(); ?>" title="Read the article &quot;<?php the_title(); ?>&quot;"><?php the_title(); ?></a></h3>
														
										<!-- POST EXCERPT AND READ MORE LINK -->
										<?php echo get_excerpt_by_chars($numCharsExcerpt, 'en'); ?>
										
										<!-- POST AUTHOR -->
										<p class="article-author">By <a href="<?php echo $authorURL ?>"><?php echo $authorName ?></a></p>
									</div>
								</article>
			<?php endwhile; endif; ?>

							</div> <!-- CLOSE main -->
							<?php get_sidebar(); ?>
						</div> <!-- CLOSE inner-content -->
	</div> <!-- CLOSE content -->
<?php get_footer(); ?>
