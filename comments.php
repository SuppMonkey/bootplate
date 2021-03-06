<?php
/**
 * The template for displaying comments
 * Updated to use Bootstrap 3.3.x classes
 * 
 * Requires bootplate_comment_nav() in function.php
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div class="row">
	<div class="col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">

		<div id="comments" class="comments-area">

			<?php if ( have_comments() ) : 
				$commentsnum = get_comments_number();
				if($commentsnum > 2) {$commentsclass = 'text-success';} else {$commentsclass = 'text-normal';}
			?>
				
				<h4 class="comments-title"><strong class="<?php echo $commentsclass; ?>"><?php echo get_comments_number(); ?></strong> <?php _e('Comment', 'bootplate'); ?><?php if($commentsnum > 1 && $commentsnum != 0){echo 's';} ?></h4>
		
				<?php //if($commentsnum > 2) { bootplate_comment_nav(); } ?>
		
				<div class="comment-list">
					<?php
						wp_list_comments( array(
							'style'			=> 'div',
							'short_ping'	=> true,
							'reply_text'	=> 'reply',
							'max_depth'		=> 2,
							'avatar_size'	=> 80,
							'callback'		=> 'bootplate_comments',
							'end-callback'	=> 'bootplate_comments_end'
						) );
					?>
				</div><!-- .comment-list -->
		
				<?php if($commentsnum > 2) { bootplate_comment_nav(); } ?>
		
			<?php endif; // have_comments() ?>
		
			<?php
				// If comments are closed and there are comments...
				//if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
				
				if ( !comments_open() && get_comments_number() ) :
			?>
				<p class="no-comments text-danger">Comments are now closed.</p>
			<?php endif; ?>
		
			<?php
				$commenter = wp_get_current_commenter();
				$req = get_option( 'require_name_email' );
				$aria_req = ( $req ? " aria-required='true'" : '' );
				
				if(get_theme_mod( 'bootplate_enable_comments_url', '') != 1) {
					// Disable Website URL in Comments Template - DEFAULT
					$fields =  array(
						'author' 	=> '<div class="row"><fieldset class="form-group col-sm-6 commentname"><label for="author">Name:</label> ' .( $req ? '<span class="required">*</span>' : '' ) .'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .'" class="form-control form-control-lg" ' . $aria_req . ' /></fieldset>',
						'email' 	=> '<fieldset class="form-group col-sm-6 commentemail"><label for="email">Email:</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .    '<input id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) .    '" class="form-control form-control-lg" ' . $aria_req . ' /></fieldset>',
						'url' 		=> '<fieldset class="form-group col-sm-4 commenturl hidden"><label for="url">Website:</label>' .'<input id="url" name="url" type="hidden" value="' . esc_attr( $commenter['comment_author_url'] ) .'" class="form-control form-control-lg" /></fieldset></div><!--/row 67-->',
					);

				} else {
					// Enable Website URL in Comments Template
					$fields =  array(
						'author' 	=> '<div class="row"><fieldset class="form-group col-sm-4 commentname"><label for="author">Name:</label> ' .( $req ? '<span class="required">*</span>' : '' ) .'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .'" class="form-control form-control-lg" ' . $aria_req . ' /></fieldset>',
						'email' 	=> '<fieldset class="form-group col-sm-4 commentemail"><label for="email">Email:</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .    '<input id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) .    '" class="form-control form-control-lg" ' . $aria_req . ' /></fieldset>',
						'url' 		=> '<fieldset class="form-group col-sm-4 commenturl"><label for="url">Website:</label>' .'<input id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) .'" class="form-control form-control-lg" /></fieldset></div><!--/row 67-->',
					);
				}
				
				
			 
				$comments_args = array(
					// change the title of send button 
					'label_submit'=>'Comment',
					// change the title of the reply section
					'title_reply'=>'Reply',
					// remove "Text or HTML to be displayed after the set of comment fields"
					'comment_notes_after' => '',
					// redefine input fields
					'class_submit'	=> 'btn btn-fw btn-success btn-process',
					'fields' => apply_filters( 'comment_form_default_fields', $fields ),
					'comment_field'	=> '<fieldset class="form-group"><label for="comment">Comment:</label><textarea id="comment" name="comment" aria-required="true" class="form-control form-control-lg" rows="3"></textarea></fieldset>',
					'logged_in_as'	=> '<p class="logged-in-as">' . sprintf( 'Logged in as <b>%1$s</b>. <a href="%2$s" class="logout-link text-danger">Log out?</a>', $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>'
					
				);
		
				if ( comments_open()) { comment_form($comments_args); } 
			?>
		</div><!-- #comments .comments-area -->

	</div><!--/col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2-->
</div><!--/row-->
