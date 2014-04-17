<?php
/*
Author: Eddie Machado
URL: htp://themble.com/bones/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images,
sidebars, comments, ect.
*/


/************* GLOBAL CONSTANTS ***************/

// Article Page Excerpt
$numCharsExcerptLong = 1000;
$numCharsExcerpt = 230;
$numCharsExcerptShort = 100;

// Default Background images
$defaultImage = get_bloginfo('template_url').'/library/images/default-images/default-image-1.jpg';
$defaultImages = '';
$defaultImageThumb = get_bloginfo('template_url').'/library/images/default-images/default-image-thumb-1.jpg';

// Recent Posts 
$numPostsPerPage = 8;
$numRecommendedPosts = 4;
$numPostsNavDetails = 5;
$numFeaturedPostsSidebar = 3;

// Author Box Presets
$avatarSize = 180;


/************* INCLUDE NEEDED FILES ***************/

/*
1. library/bones.php
	- head cleanup (remove rsd, uri links, junk css, ect)
	- enqueueing scripts & styles
	- theme support functions
	- custom menu output & fallbacks
	- related post function
	- page-navi function
	- removing <p> from around images
	- customizing the post excerpt
	- custom google+ integration
	- adding custom fields to user profiles
*/
require_once( 'library/bones.php' ); // if you remove this, bones will break
/*
2. library/custom-post-type.php
	- an example custom post type
	- example custom taxonomy (like categories)
	- example custom taxonomy (like tags)
*/
require_once( 'library/custom-post-type.php' ); // you can disable this if you like
/*
3. library/admin.php
	- removing some default WordPress dashboard widgets
	- an example custom dashboard widget
	- adding custom login css
	- changing text in footer of admin
*/
// require_once( 'library/admin.php' ); // this comes turned off by default
/*
4. library/translation/translation.php
	- adding support for other languages
*/
// require_once( 'library/translation/translation.php' ); // this comes turned off by default

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'bones-thumb-600', 600, 150, true );
add_image_size( 'bones-thumb-300', 300, 100, true );

/*
to add more sizes, simply copy a line from above
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 300 sized image,
we would use the function:
<?php the_post_thumbnail( 'bones-thumb-300' ); ?>
for the 600 x 100 image:
<?php the_post_thumbnail( 'bones-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

add_filter( 'image_size_names_choose', 'bones_custom_image_sizes' );

function bones_custom_image_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'bones-thumb-600' => __('600px by 150px'),
        'bones-thumb-300' => __('300px by 100px'),
    ) );
}

/*
The function above adds the ability to use the dropdown menu to select 
the new images sizes you have just created from within the media manager 
when you add media to your content blocks. If you add more image sizes, 
duplicate one of the lines in the array and name it according to your 
new image size.
*/

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function bones_register_sidebars() {
	register_sidebar(array(
		'id' => 'sidebar1',
		'name' => __( 'Sidebar 1', 'bonestheme' ),
		'description' => __( 'The first (primary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	/*
	to add more sidebars or widgetized areas, just copy
	and edit the above sidebar code. In order to call
	your new sidebar just use the following code:

	Just change the name to whatever your new
	sidebar's id is, for example:

	register_sidebar(array(
		'id' => 'sidebar2',
		'name' => __( 'Sidebar 2', 'bonestheme' ),
		'description' => __( 'The second (secondary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	To call the sidebar in your template, you can just copy
	the sidebar.php file and rename it to your sidebar's name.
	So using the above example, it would be:
	sidebar-sidebar2.php

	*/
} // don't remove this bracket!

/************* COMMENT LAYOUT *********************/

// Comment Layout
function bones_comments( $comment, $args, $depth ) {
   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="clearfix">
			<header class="comment-author vcard">
				<?php
				/*
					this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
					echo get_avatar($comment,$size='32',$default='<path_to_url>' );
				*/
				?>
				<?php // custom gravatar call ?>
				<?php
					// create variable
					$bgauthemail = get_comment_author_email();
				?>
				<img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5( $bgauthemail ); ?>?s=32" class="load-gravatar avatar avatar-48 photo" height="32" width="32" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
				<?php // end custom gravatar call ?>
				<?php printf(__( '<cite class="fn">%s</cite>', 'bonestheme' ), get_comment_author_link()) ?>
				<time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__( 'F jS, Y', 'bonestheme' )); ?> </a></time>
				<?php edit_comment_link(__( '(Edit)', 'bonestheme' ),'  ','') ?>
			</header>
			<?php if ($comment->comment_approved == '0') : ?>
				<div class="alert alert-info">
					<p><?php _e( 'Your comment is awaiting moderation.', 'bonestheme' ) ?></p>
				</div>
			<?php endif; ?>
			<section class="comment_content clearfix">
				<?php comment_text() ?>
			</section>
			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</article>
	<?php // </li> is added by WordPress automatically ?>
<?php
} // don't remove this bracket!

/************* SEARCH FORM LAYOUT *****************/

// Search Form
function bones_wpsearch($form) {
	$actionurl = get_bloginfo('home');
	$actionurl = qtrans_convertURL($actionurl, $locale);
	$actionurl = $actionurl.'/';

	$form = '<form role="search" method="get" class="search-form" action="' . $actionurl . '" >
	<label class="screen-reader-text no-placeholder" for="s">' . __( 'Search for:', 'bonestheme' ) . '</label>
	<input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="' . esc_attr__( '[:en]Search the Site...[:ja]サイトを検索', 'bonestheme' ) . '" />
	<input type="submit" class="search-submit" value="' . esc_attr__( 'Search' ) .'" />
	</form>';
	return $form;
} // don't remove this bracket!



/************* POST RECOMMENDED IMAGE *************/

// get the first image attached to the current post
function get_first_image($size) {
	
	global $post;
	$photos = get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID') );
	$default_attr = array(
		'alt'   => trim(strip_tags( $attachment->post_title )),
		'title' => ''
	);
	
	
	if ($photos) {
		$photo = array_shift($photos);
		return wp_get_attachment_image($photo->ID, $size, 0, $default_attr);
	}
	return false; 
}
// the html tag for the first image or false if no image is found
// $photo = get_first_image();
// end



/************* GET EXCERPT BY NUMBER OF CHARS *************/
/** Returns an excerpt of a specified length.  If no length
 ** is given, the ID calls
 ** Must to be called within the Loop
 */

function get_excerpt_by_chars($count, $appendingString, $showAutoExcerpt){
  global $numCharsExcerpt;
		
  // Set a default count if none is provided
  if ($count == "" || $count == null) {
  		  $count = $numCharsExcerpt;		
  }
  
  // Get content and strip tags
  $excerpt = qtranslate_filter(get_post_field('post_excerpt', get_the_ID()));
  if ($excerpt == '' && $showAutoExcerpt)	$excerpt = get_the_content();
  $excerpt = strip_tags($excerpt);
  
  // Trim the text by word if it's English
  if (qtrans_getLanguage() == 'en') {	
  		  $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
  		  $excerpt = substr($excerpt, 0, $count);
  		  
  // Trim the text for multibyte characters if Japanese
  } else if (qtrans_getLanguage() == 'ja') {
  		  $excerpt = mb_substr($excerpt, 0, $count/2, 'utf-8');
  }
  
  // Add <p> tags
  $excerpt = '<p class="article-excerpt">'.$excerpt.$appendingString.'</p>';
  
  // Return content
  return $excerpt;
}


/************* CREATE AUTHOR BIO BOX *************/
/** Requires the 'Advanced Custom Fields' plugin to be installed to work
 ** properly. 
 */

function the_author_bio($authorID) {
		
	global $avatarSize;
	
	// Special formatting to get custom fields
	$customFieldAuthorID = 'user_'.$authorID;

	// Get primary author bio values
	$authorName = get_the_author_meta('display_name', $authorID);
	$authorPostsURL = get_author_posts_url($authorID);
	$authorCompany = get_field('company', $customFieldAuthorID);			// Custom Field
	$authorCompanyURL = get_field('company_url', $customFieldAuthorID);		// Custom Field
	$authorPosition = get_field('position', $customFieldAuthorID);			// Custom Field
	$authorBio = qtrans_TextTranslate(get_the_author_meta('description', $authorID), 	// English Bio
			get_field('author_description_ja', $customFieldAuthorID), 					// Japanese Bio
			$showText = false);	
	
	// Get author social media values
	$authorWebsite = get_the_author_meta('user_url', $authorID);
	$authorTwitter = get_the_author_meta('twitter', $authorID);
	$authorGooglePlus = get_the_author_meta('googleplus', $authorID);
	$authorLinkedIn = get_field('linkedin', $customFieldAuthorID);			// Custom Field
	
	// Assemble author bio box parts
	$authorBioBoxName = '<h2 class="author-bio-box-name"><a href="'.$authorPostsURL.'" rel="author">'.$authorName.'</a></h2>';
	$authorBioBoxPosition = ($authorPosition?
								('<h4 class="author-bio-box-position">'.$authorPosition.($authorCompany?
									(' at '.($authorCompanyURL? 
											'<a href="'.$authorCompanyURL.'">'.$authorCompany.'</a></h4>': $authorCompany.'</h4>')):
									('</h4>'))):
								($authorCompany? 
										'<h4 class="author-bio-box-position">'.$authorCompany.'</h4>' : '')
							);
	$authorBioBoxDescription = ($authorBio? '<p>'.$authorBio.'</p>' : '');
	$authorBioBoxSocialMediaLinks = (($authorTwitter? '<li><a href="http://twitter.com/'.$authorTwitter.'">Twitter</a></li>' : '').
									($authorLinkedIn? '<li><a href="'.$authorLinkedIn.'">LinkedIn</a></li>' : '').
									($authorGooglePlus? '<li><a href="'.$authorGooglePlus.'">Google+</a></li>' : '').
									($authorWebsite? '<li><a href="'.$authorWebsite.'">Website</a></li>' : ''));
	$authorBioBoxSocialMedia = ($authorBioBoxSocialMediaLinks?
									'<ul class="author-bio-box-social-media clearfix">'.$authorBioBoxSocialMediaLinks.'</ul>' : 
									'');
	
	// Put it all together
	$authorBioBox = '<div class="author-bio-box clearfix">
							<div class="author-bio-box-avatar">
								<a href="'.$authorPostsURL.'" rel="author">'.
									get_avatar($authorID , $avatarSize ).
								'</a>
							</div>
							<div class="author-bio-box-text">'.
								$authorBioBoxName.
								$authorBioBoxPosition.
								$authorBioBoxDescription. 
								$authorBioBoxSocialMedia.
							'</div>
					</div>';
					
	// Print the formatted box
	echo $authorBioBox;
}


/************* CREATE ARTICLE BOX *************/
/** Creates a post box that's used to display a group of posts
 ** on the top page, archive pages, or the search results.
 ** Must be called within the loop.
 */
 
function create_article_box($noSidebar, $showExcerpt, $showDate, $showCategories, $excerptLength) {
		
	// Call in constants
	global $defaultImage;
	global $numCharsExcerpt;
	
	// Setup variables
	$authorName = get_the_author_meta('display_name');
	$authorURL = get_author_posts_url( get_the_author_meta( 'ID' ) );
	$postImage = array($defaultImage);
	
	// Set $postImage if an image exists for the post.
	if (has_post_thumbnail()) {
		$postImage = wp_get_attachment_image_src(get_post_thumbnail_id(), 'recommended-post-img'); 
	} 
	
	(isset($excerptLength)? : $excerptLength = $numCharsExcerpt); ?>
	
	<!-- ARTICLE BOX -->
	<article class="article-excerpt-box <?php echo ($noSidebar? 'no-sidebar': ''); ?>" role="article">
									
		<!-- POST IMAGE -->
		<a href="<?php the_permalink(); ?>" title="Read the article &quot;<?php the_title(); ?>&quot;">
			<header class="article-excerpt-image" style="background-image:url('<?php echo $postImage[0] ?>');"></header>	
		</a>
											
		<!-- EXCERPT -->
		<div class="article-excerpt-text">
			<h3><a href="<?php the_permalink(); ?>" title="Read the article &quot;<?php the_title(); ?>&quot;"><?php the_title(); ?></a></h3>
														
			<!-- POST EXCERPT -->
			<?php echo ($showExcerpt? get_excerpt_by_chars($excerptLength, '...', $showAutoExcerpt = true) : ''); ?>
										
			<!-- POST AUTHOR -->
			<p class="article-meta">
				By <a href="<?php echo $authorURL ?>"><?php echo $authorName ?></a>
			
				<!-- POST DATE -->
				<?php echo ($showDate? '<br><time class="updated" datetime="'.mysql2date('Y-m-j', get_the_date()).'" pubdate>'.mysql2date('F jS, Y', get_the_date()).'</time>' : '') ?>
			
				<!-- POST CATEGORIES -->
				<?php echo ($showCategories? '<br>'.get_the_category_list(', ') : '') ?>	
			</p>
		</div>
	</article>
<?php }

 
/************* CREATE NAVIGATION DETAILS *************/
/** Requires the 'Advanced Custom Fields' plugin to be installed to work
 ** properly. 
 */


/************* ls_navigation_about **************/

function ls_navigation_about($class) {
		
	// Set the class variable if not set
	isset($class)? $class : $class = "sub-menu";
		
	// Set Arguments for array
	$args = array(
		'child_of' => get_ID_by_slug('about-us')
	);
		
	// Get List
	$pages = get_pages($args); ?>
	 
	<ul class="<?php echo $class ?>">
		<li>
			<a href="<?php echo get_permalink( get_ID_by_slug('about-us') ); ?>">
				<?php echo get_the_title( get_ID_by_slug('about-us') ); ?>
			</a>
		</li>
				
		<!-- the loop -->
		<?php foreach ( $pages as $page ) { ?>
			<li>
				<a href="<?php echo get_permalink( $page->ID ); ?>">
					<?php echo $page->post_title; ?>
				</a>
			</li>
		<?php } ?>
		<!-- end of the loop -->
	</ul>
<?php }


/************* ls_navigation_features **************/

function ls_navigation_features($class) {
		
	// Set the class variable if not set
	isset($class)? $class : $class = "sub-menu";
	global $defaultImageThumb;
		
	// Set Arguments for array
	$args = array(
		'posts_per_page' => 5, 
		'orderby' => 'post_date', 
		'meta_query' => array(
			array(
				'key' => 'recommended',
				'value' => 'yes'
			)
		)
	);
		
	// Get list
	$featuredArticles = new WP_Query($args); ?>

	<ul class="<?php echo $class ?>">
		<!-- the loop -->
		<?php if($featuredArticles->have_posts()) : while($featuredArticles->have_posts()) : $featuredArticles->the_post(); ?>
			<li class="sub-menu-featured-article">
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="clearfix">
					<?php
						$photo = get_the_post_thumbnail(get_the_ID(), 'thumbnail');
					
						if ($photo != '') echo $photo;
						else echo '<img src="'.$defaultImageThumb.'">';
					?>
					<div><?php the_title(); ?></div>
				</a>
			</li>
		<?php endwhile; endif; ?>
		<!-- end of the loop -->
	</ul>	
	<?php wp_reset_postdata(); ?>
	
<?php }



/************* ls_navigation_categories **************/

function ls_navigation_categories($class) {
		
	// Set the class variable if not set
	isset($class)? $class : $class = "sub-menu";
	
	// Set Arguments for array
	$args = array(
		'hide_empty' => 1,
		'exclude' => array(
				get_cat_ID( 'Uncategorized' ), 
				get_cat_ID( 'KVH News' )
			)		
		);
	$categories = get_categories($args); ?>
		
	<ul class="<?php echo $class ?>">
		<!-- the loop -->
		<?php foreach ( $categories as $category ) { ?>
			<li>
				<a href="<?php echo get_category_link($category->cat_ID); ?>">
					<?php echo $category->name; ?>
				</a>
			</li>
		<?php } ?>
		<!-- end of the loop -->
	</ul>
<?php }


/************* TRANSLATION *************/
/** Requires the 'qTranslate' plugin to be installed to work
 ** properly. Outputs the appropriate string based on the user's
 ** currently set language.
 */

function qtrans_TextTranslate($engString, $jpnString, $showText) {
	
	// Default showText to true if not set
	isset($showText)? $showText = $showText : $showText = true;
	
	// If English
	if (qtrans_getLanguage() == 'en') {
		
		if ($showText) echo ($engString);
		else return $engString;
			
	// If Japanese
	} elseif (qtrans_getLanguage() == 'ja') {
		
		if ($showText) echo ($jpnString);
		else return $jpnString;
	}
}


/************* GET PAGE ID BY SLUG **************/
/** Gets a page's ID by referencing it's slug.
 */
 
function get_ID_by_slug($page_slug) {
    $page = get_page_by_path($page_slug);
    if ($page) {
        return $page->ID;
    } else {
        return null;
    }
}


/************ qtranslate_filter **************/
/** Adds in short codes for multilingual display.
 */

function qtranslate_filter($text) {
	return __($text);
}


// Enable qTranslate for WordPress SEO
add_filter('wpseo_title', 'qtranslate_filter', 10, 1);
add_filter('wpseo_metadesc', 'qtranslate_filter', 10, 1);
add_filter('wpseo_metakey', 'qtranslate_filter', 10, 1);




?>
