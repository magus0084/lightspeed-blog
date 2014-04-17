<?php
/*
The comments page for Bones
*/

// Do not delete these lines
	if ( ! empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) )
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<div class="alert alert-help">
			<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'bonestheme' ); ?></p>
		</div>
	<?php
		return;
	}
?>

<?php /* You can start editing here. */ ?>

<div id="comments-section">

<?php if ( have_comments() ) : ?>
	<h3 id="comments" class="h2"><?php comments_number( __( '<span>No</span> Responses', 'bonestheme' ), __( '<span>One</span> Response', 'bonestheme' ), _n( '<span>%</span> Response', '<span>%</span> Responses', get_comments_number(), 'bonestheme' ) );?> to &#8220;<?php the_title(); ?>&#8221;</h3>

	<nav id="comment-nav">
		<ul class="clearfix">
				<li><?php previous_comments_link() ?></li>
				<li><?php next_comments_link() ?></li>
		</ul>
	</nav>

	<ol class="commentlist">
		<!-- HELLO -->
		<?php wp_list_comments( 'type=comment&callback=bones_comments' ); ?>
	</ol>

	<nav id="comment-nav">
		<ul class="clearfix">
				<li><?php previous_comments_link() ?></li>
				<li><?php next_comments_link() ?></li>
		</ul>
	</nav>

	<?php else : /* this is displayed if there are no comments so far */ ?>

	<?php if ( comments_open() ) : ?>
			<?php /* If comments are open, but there are no comments. */ ?>

	<?php else : /* comments are closed */ ?>

	<?php /* If comments are closed. */ ?>
	<!--p class="nocomments"><?php _e( 'Comments are closed.', 'bonestheme' ); ?></p-->

	<?php endif; ?>

<?php endif; ?>


<?php if ( comments_open() ) : ?>

<section id="respond" class="respond-form">

	<h3 id="comment-form-title" class="h2"><?php comment_form_title( __( 'Discussion', 'bonestheme' ), __( 'Leave a Reply to %s', 'bonestheme' )); ?></h3>

	<div id="cancel-comment-reply">
		<?php cancel_comment_reply_link('<i class="fa fa-times fa-2x"></i>'); ?>
	</div>

	<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
		<div class="alert alert-help">
			<p><?php printf( __( 'You must be %1$slogged in%2$s to post a comment.', 'bonestheme' ), '<a href="<?php echo wp_login_url( get_permalink() ); ?>">', '</a>' ); ?></p>
		</div>
	<?php else : ?>

	<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

	<?php if ( is_user_logged_in() ) : ?>

	<p class="comments-logged-in-as"><?php _e( 'Logged in as', 'bonestheme' ); ?> <a href="<?php echo get_option( 'siteurl' ); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url( get_permalink() ); ?>" title="<?php _e( 'Log out of this account', 'bonestheme' ); ?>"><?php _e( 'Log out', 'bonestheme' ); ?> <?php _e( '&raquo;', 'bonestheme' ); ?></a></p>

	<?php else : ?>

	<ul id="comment-form-elements" class="clearfix">

		<li>
			<label for="author" class="no-placeholder"><?php _e( '[:en]Name[:ja]名前', 'bonestheme' ); ?> <?php if ($req) _e( '(required)'); ?></label>
			<input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" placeholder="<?php _e( '[:en]Your Name*[:ja]名前*', 'bonestheme' ); ?>" <?php if ($req) echo "aria-required='true'"; ?> />
		</li>

		<li>
			<label for="email" class="no-placeholder"><?php _e( '[:en]Email[:ja]メール', 'bonestheme' ); ?> <?php if ($req) _e( '(required)'); ?></label>
			<input type="email" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" placeholder="<?php _e( '[:en]Your E-Mail*[:ja]メール*', 'bonestheme' ); ?>" <?php if ($req) echo "aria-required='true'"; ?> />
			<small><?php _e("(will not be published)", 'bonestheme' ); ?></small>
		</li>

		<li>
			<label for="url" class="no-placeholder"><?php _e( '[:en]Website[:ja]ホームページ', 'bonestheme' ); ?></label>
			<input type="url" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" placeholder="<?php _e( '[:en]Got a website?[:ja]ホームページ', 'bonestheme' ); ?>" />
		</li>

	</ul>

	<?php endif; ?>

	<p>
		<label for="comment" class="no-placeholder"><?php _e( '[:en]Comments[:ja]コメント', 'bonestheme' ); ?></label>
		<textarea name="comment" id="comment" placeholder="<?php _e( '[:en]Share your thoughts...[:ja]コメント', 'bonestheme' ); ?>"></textarea>
	</p>

	<p>
	<input name="submit" type="submit" id="submit" class="button" value="<?php _e( '[:en]Submit[:ja]送信', 'bonestheme' ); ?>" />
		<?php comment_id_fields(); ?>
	</p>

	<div id="allowed-tags-container" class="alert alert-info">
		<p id="allowed_tags" class="small"><strong>XHTML:</strong> <?php _e( 'You can use these tags', 'bonestheme' ); ?>: <code><?php echo allowed_tags(); ?></code></p>
	</div>

	<?php do_action( 'comment_form', $post->ID ); ?>

	</form>

	<?php endif; /* If registration required and not logged in */ ?>
</section>
</div> <!-- CLOSE "#Comments" DIV -->
<?php endif; /* if you delete this the sky will fall on your head */ ?>
