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

// Default Background images
$defaultImage = '';
$defaultImages = '';

// Recent Posts 
$numPostsPerPage = 8;
$numRecommendedPosts = 3;



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
	$form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
	<label class="screen-reader-text" for="s">' . __( 'Search for:', 'bonestheme' ) . '</label>
	<input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="' . esc_attr__( 'Search the Site...', 'bonestheme' ) . '" />
	<input type="submit" id="searchsubmit" value="' . esc_attr__( 'Search' ) .'" />
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

function get_excerpt_by_chars($count, $language){
  
  // Set a default count if none is provided
  if ($count == "" || $count == null) {
	$count = 250;		
  }
  
  // Get content and strip tags
  $excerpt = get_the_excerpt();
  $excerpt = strip_tags($excerpt);
  $excerpt = substr($excerpt, 0, $count);
  //$excerpt = substr(  Need to remove "read More"
  
  // Trim the text by word if it's English
  if ($language == 'en') {
  	  $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
  }
  
  // Add <p> tags
  $excerpt = '<p>'.$excerpt.'...</p>';
  
  // Return content
  return $excerpt;
}


/************* CREATE AUTHOR BIO BOX *************/
/** Requires the 'Advanced Custom Fields' plugin to be installed to work
 ** properly. 
 */

function the_author_bio($authorID) {
	
	// Special formatting to get custom fields
	$customFieldAuthorID = 'user_'.$authorID;

	// Get primary author bio values
	$authorName = get_the_author_meta('display_name', $authorID);
	$authorPostsURL = get_author_posts_url($authorID);
	$authorCompany = get_field('company', $customFieldAuthorID);			// Custom Field
	$authorCompanyURL = get_field('company_url', $customFieldAuthorID);		// Custom Field
	$authorPosition = get_field('position', $customFieldAuthorID);			// Custom Field
	$authorBio = get_the_author_meta('description', $authorID);
	
	// Get author social media values
	$authorWebsite = get_the_author_meta('user_url', $authorID);
	$authorTwitter = get_the_author_meta('twitter', $authorID);
	$authorGooglePlus = get_the_author_meta('googleplus', $authorID);
	$authorLinkedIn = get_field('linkedin', $customFieldAuthorID);			// Custom Field
	
	// Assemble author bio box parts
	$authorBioBoxName = '<h2 class="author-bio-box-name"><a href="'.$authorPostsURL.'">'.$authorName.'</a></h2>';
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
								<a href="'.$authorPostsURL.'">'.
									get_avatar($authorID , 180 ).
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


/************* CREATE AUTHOR BIO BOX *************/
/** Requires the 'Advanced Custom Fields' plugin to be installed to work
 ** properly. 
 */

function ls_navigation() {
	
}

function ls_navigation_details($navRegionParent) {
	
		
	if ($navRegionParent == 'categories') {
		
	}
}

/************* TRANSLATION *************/
/** Requires the 'qTranslate' plugin to be installed to work
 ** properly. Outputs the appropriate string based on the user's
 ** currently set language.
 */

function qtrans_TextTranslate($engString, $jpnString) {
	if (qtrans_getLanguage() == 'en') {
		echo $engString;
			
	} elseif (qtrans_getLanguage() == 'ja') {
		echo $jpnString;
	}
}

?>
		
