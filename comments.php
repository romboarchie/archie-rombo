<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * 
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
<div class="comments-wrapper"><!-- comments-wrapper -->
	<div class="comments" id="comments"><!-- comments -->
		<div class="comments-header"><!-- .comments-header -->
			<h2 class="comment-reply-title"><!-- .comments-title -->
				<?php
					if(!have_comments()){
						echo "Leave A Comment";
					}else{			
						echo get_comments_number()."&nbsp;Comments";			
					}
				?>
			</h2><!-- .comments-title -->
		</div><!-- .comments-header -->
		<div class="comments-inner"><!-- .comments-inner -->
			<?php
				wp_list_comments(
					array(
						'style' => 'ol',
						'short_ping' => true,
						'avatar_size' => 56,
						'per_page' => 10,
						'type'	=> 'comment',
						 )
							  );
			?>
		</div><!-- .comments-inner -->
	</div><!-- comments -->
	<hr class="" aria-hidden="true">
		<?php
			if(comments_open()){
				comment_form( 
					array(
						'class_form' => '',
						'title_reply' => '<span>' . esc_html__( 'Leave a Reply', 'archie-rombo' ) . '</span>',
						'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title">',
						'title_reply_after' => '</h3>',
						 )
							);
					           }
		?>
</div><!-- comments-wrapper -->