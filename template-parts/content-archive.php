<div  id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="container-fluid">
		<div class="row ">
			<div class="col-sm-4">
				<?php if(has_post_thumbnail()): ?>
				<a href="<?php the_permalink();?>" title="<?php the_title(); ?>">
					<img src="<?php the_post_thumbnail_url('blog-large');  ?>" class="img-fluid" alt="<?php the_title(); ?>">
				</a>
				
			
			<?php else:
				echo 'No Thumbail Found';
			endif;
			?>
			</div>
			<div class="col-sm-8" style="padding-left: 1rem;">
				<div class="meta mb-1">
					<span class="date"><?php the_date(); ?></span>
					<span class="comment"><a href="#"><?php comments_number();?></a></span>
					<span class="meta-category"> <?php  the_category( ', ' );?> </span>
				</div>
				<h2 class="entry-title mb-1"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h2>
				
				<div class="entry-content entry-excerpt clearfix" style="text-align: justify;"><?php the_excerpt(); ?>
				<a class="more-link" href="<?php the_permalink();?>"><?php echo esc_html(get_option('archie_rombo_read_more_text', 'Read More')); ?> &rarr;</a>
				</div>
			</div>
		</div>
	</div>
</div>

<hr>