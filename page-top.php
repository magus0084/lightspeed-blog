<?php
/*
Template Name: Top Page
*/

?>

<?php get_header(); ?>

	<div id="content">
		<?php
			// Create a new loop
			$args=array(
				'posts_per_page' => $numPostsPerPage,
				'orderby' => 'date'
			);
			$editorials = new WP_Query($args);

			// Start Loop
			if($editorials->have_posts()) : while($editorials->have_posts()) : $editorials->the_post();

				$postImageLarge;

				if (has_post_thumbnail()) {
					$postImageLarge = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full-size');
				} else {
					$postImageLarge = $defaultImage;
				}
				
				// If this is the first post, add header image using and content space tags
				if( $editorials->current_post == 0 && !is_paged() ) { ?>
					<!-- IMAGE HEADER -->
					<header id="top-page-header-image" class="header-image short-header-image" style="background-image:url('<?php echo $postImageLarge[0] ?>');"></header>
						
						<!-- BEGIN inner-content -->
						<div id="inner-content" class="wrap clearfix post-select-page">
	
							<!-- TAGLINE -->
							<aside id="tagline">
								On Pace. On Target. IT Industry Insights.<br>
								<span>Powered by KVH</span>
							</aside>
					
							<!-- BEGIN main -->
							<div id="main" class="eightcol first clearfix" role="main">
				<?php }?>
								<?php /* Create Article Boxes */ ?>
								<?php create_article_box($noSidebar = false, $showExcerpt = true, $showDate = false, $showCategories = false); ?>
								
			<?php endwhile; endif; ?>

							</div> <!-- CLOSE main -->
							<?php get_sidebar(); ?>
						</div> <!-- CLOSE inner-content -->
	</div> <!-- CLOSE content -->
<?php get_footer(); ?>
