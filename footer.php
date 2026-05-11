<?php if ( is_active_sidebar( 'footer-widget-1' ) && is_active_sidebar('footer-widget-2') && is_active_sidebar('footer-widget-3') && is_active_sidebar('footer-widget-4') ) : ?>
<div class="container-fluid bg-light-subtle" style="padding-left: 1rem;padding-right: 1rem;padding-top: 2rem;padding-bottom: 2rem;">
	<div class="row">
		<div class="col-lg-3 col-sm-12"><?php dynamic_sidebar('footer-widget-1'); ?></div>
		<div class="col-lg-3 col-sm-12"><?php dynamic_sidebar('footer-widget-2'); ?></div>
		<div class="col-lg-3 col-sm-12"><?php dynamic_sidebar('footer-widget-3'); ?></div>
		<div class="col-lg-3 col-sm-12"><?php dynamic_sidebar('footer-widget-4'); ?></div>
	</div>
</div>
<?php elseif(is_active_sidebar( 'footer-widget-1' ) && is_active_sidebar('footer-widget-2') && is_active_sidebar('footer-widget-3')): ?>
<div class="container-fluid " style="padding-left: 1rem;padding-right: 1rem;padding-top: 2rem;padding-bottom: 2rem;">
	<div class="row">
		<div class="col-lg-4 col-sm-12"><?php dynamic_sidebar('footer-widget-1'); ?></div>
		<div class="col-lg-3 col-sm-12"><?php dynamic_sidebar('footer-widget-2'); ?></div>
		<div class="col-lg-3 col-sm-12"><?php dynamic_sidebar('footer-widget-3'); ?></div>	
	</div>
</div>
<?php elseif(is_active_sidebar( 'footer-widget-2' ) && is_active_sidebar('footer-widget-3') && is_active_sidebar('footer-widget-4')): ?>
<div class="container-fluid" style="padding-left: 1rem;padding-right: 1rem;padding-top: 2rem;padding-bottom: 2rem;">
	<div class="row">
		<div class="col-lg-3 col-sm-12"><?php dynamic_sidebar('footer-widget-2'); ?></div>
		<div class="col-lg-3 col-sm-12"><?php dynamic_sidebar('footer-widget-3'); ?></div>
		<div class="col-lg-3 col-sm-12"><?php dynamic_sidebar('footer-widget-4'); ?></div>
	</div>
</div>
<?php elseif(is_active_sidebar( 'footer-widget-1' ) && is_active_sidebar('footer-widget-2') && is_active_sidebar('footer-widget-4')): ?>
<div class="container-fluid" style="padding-left: 1rem;padding-right: 1rem;padding-top: 2rem;padding-bottom: 2rem;">
	<div class="row">
		<div class="col-lg-3 col-sm-12"><?php dynamic_sidebar('footer-widget-1'); ?></div>
		<div class="col-lg-3 col-sm-12"><?php dynamic_sidebar('footer-widget-2'); ?></div>
		<div class="col-lg-3 col-sm-12"><?php dynamic_sidebar('footer-widget-4'); ?></div>
		
	</div>
</div>
<?php elseif(is_active_sidebar( 'footer-widget-1' ) && is_active_sidebar('footer-widget-3') && is_active_sidebar('footer-widget-4')): ?>
<div class="container-fluid" style="padding-left: 1rem;padding-right: 1rem;padding-top: 2rem;padding-bottom: 2rem;">
	<div class="row">
		<div class="col-lg-3 col-sm-12"><?php dynamic_sidebar('footer-widget-1'); ?></div>
		<div class="col-lg-3 col-sm-12"><?php dynamic_sidebar('footer-widget-3'); ?></div>
		<div class="col-lg-3 col-sm-12"><?php dynamic_sidebar('footer-widget-4'); ?></div>
	</div>
</div>
<?php elseif(is_active_sidebar( 'footer-widget-1' ) && is_active_sidebar('footer-widget-2')): ?>
<div class="container-fluid" style="padding-left: 1rem;padding-right: 1rem;padding-top: 2rem;padding-bottom: 2rem;">
	<div class="row">
		<div class="col-lg-6 col-sm-12"><?php dynamic_sidebar('footer-widget-1'); ?></div>
		<div class="col-lg-6 col-sm-12"><?php dynamic_sidebar('footer-widget-2'); ?></div>	
	</div>
</div>
<?php elseif(is_active_sidebar( 'footer-widget-1' ) && is_active_sidebar('footer-widget-3')): ?>
<div class="container-fluid" style="padding-left: 1rem;padding-right: 1rem;padding-top: 2rem;padding-bottom: 2rem;">
	<div class="row">
		<div class="col-lg-6 col-sm-12"><?php dynamic_sidebar('footer-widget-1'); ?></div>
		<div class="col-lg-6 col-sm-12"><?php dynamic_sidebar('footer-widget-3'); ?></div>		
	</div>
</div>
<?php elseif(is_active_sidebar( 'footer-widget-1' ) && is_active_sidebar('footer-widget-4')): ?>
<div class="container-fluid" style="padding-left: 1rem;padding-right: 1rem;padding-top: 2rem;padding-bottom: 2rem;">
	<div class="row">
		<div class="col-lg-6 col-sm-12"><?php dynamic_sidebar('footer-widget-1'); ?></div>
		<div class="col-lg-6 col-sm-12"><?php dynamic_sidebar('footer-widget-4'); ?></div>	
	</div>
</div>
<?php elseif(is_active_sidebar( 'footer-widget-2' ) && is_active_sidebar('footer-widget-3')): ?>
<div class="container-fluid" style="padding-left: 1rem;padding-right: 1rem;padding-top: 2rem;padding-bottom: 2rem;">
	<div class="row">
		<div class="col-lg-6 col-sm-12"><?php dynamic_sidebar('footer-widget-2'); ?></div>
		<div class="col-lg-6 col-sm-12"><?php dynamic_sidebar('footer-widget-3'); ?></div>	
	</div>
</div>
<?php elseif(is_active_sidebar( 'footer-widget-2' ) && is_active_sidebar('footer-widget-4')): ?>
<div class="container-fluid " style="padding-left: 1rem;padding-right: 1rem;padding-top: 2rem;padding-bottom: 2rem;">
	<div class="row">
		<div class="col-sm-6"><?php dynamic_sidebar('footer-widget-2'); ?></div>
		<div class="col-sm-6"><?php dynamic_sidebar('footer-widget-4'); ?></div>	
	</div>
</div>
<?php elseif(is_active_sidebar( 'footer-widget-3' ) && is_active_sidebar('footer-widget-4')): ?>
<div class="container-fluid" style="padding-left: 1rem;padding-right: 1rem;padding-top: 2rem;padding-bottom: 2rem;">
	<div class="row">
		<div class="col-lg-6 col-sm-12"><?php dynamic_sidebar('footer-widget-3'); ?></div>
		<div class="col-lg-6 col-sm-12"><?php dynamic_sidebar('footer-widget-4'); ?></div>	
	</div>
</div>
<?php elseif(is_active_sidebar( 'footer-widget-1' ) ): ?>
<div class="container">
	<div class="row">
		<div class="col-sm-6 offset-md-3"><?php dynamic_sidebar('footer-widget-1'); ?></div>	
	</div>
</div>
<?php elseif(is_active_sidebar( 'footer-widget-2' ) ): ?>
<div class="container ">
	<div class="row">
		<div class="col-sm-6 offset-md-3"><?php dynamic_sidebar('footer-widget-2'); ?></div>	
	</div>
</div>
<?php elseif(is_active_sidebar( 'footer-widget-3' ) ): ?>
<div class="container">
	<div class="row">
		<div class="col-sm-6 offset-md-3"><?php dynamic_sidebar('footer-widget-3'); ?></div>	
	</div>
</div>
<?php elseif(is_active_sidebar( 'footer-widget-4' ) ): ?>
<div class="container ">
	<div class="row">
		<div class="col-sm-6 offset-md-3"><?php dynamic_sidebar('footer-widget-4'); ?></div>		
	</div>
</div>
<?php endif; ?>
<footer class="footer mt-auto py-3 bg-body-tertiary" >
	<div class="row">
		<div class="col-md-4 col-sm-12">
			<span class="mb-3 mb-md-0">
				<?php 
				$footer_copyright = get_option('archie_rombo_footer_copyright');
				if ($footer_copyright) {
					echo wp_kses_post($footer_copyright);
				} else {
					echo '<i class="fa fa-copyright"></i>&nbsp;2014 - ' . date('Y') . ' ' . esc_html(get_bloginfo('name'));
				}
				?>
			</span> 
		</div>
		<div class="col-md-4 col-sm-12 text-center" >
			<?php 
            $facebook_url = get_option('archie_rombo_facebook_url');
            $twitter_url = get_option('archie_rombo_twitter_url');
            $instagram_url = get_option('archie_rombo_instagram_url');
            $linkedin_url = get_option('archie_rombo_linkedin_url');

            if ( $facebook_url ) {
                echo '<a href="' . esc_url($facebook_url) . '" target="_blank" class="social-link"><i class="fa-brands fa-facebook" aria-hidden="true"></i></a>';
            }
            if ( $twitter_url ) {
                echo '<a href="' . esc_url($twitter_url) . '" target="_blank" class="social-link"><i class="fa-brands fa-twitter" aria-hidden="true"></i></a>';
            }
            if ( $instagram_url ) {
                echo '<a href="' . esc_url($instagram_url) . '" target="_blank" class="social-link"><i class="fa-brands fa-instagram" aria-hidden="true"></i></a>';
            }
            if ( $linkedin_url ) {
                echo '<a href="' . esc_url($linkedin_url) . '" target="_blank" class="social-link"><i class="fa-brands fa-linkedin" aria-hidden="true"></i></a>';
            }
			?>
		</div>
		<div class="col-md-4 col-sm-12 text-end" >
			<?php
			// translators: Theme Name and Link to ArchieRombo.
			printf(esc_html__( 'WordPress Theme: %1$s by %2$s.', 'archie-rombo' ),esc_html__( 'archie-rombo', 'archie-rombo' ),'Archie Rombo');
		    ?>
		</div>
	</div>		
</footer>
    <?php if (get_option('archie_rombo_back_to_top', 1)) : ?>
    <button id="back-to-top" title="<?php esc_attr_e('Go to top', 'archie-rombo'); ?>">
        <i class="fa fa-chevron-up"></i>
    </button>
    <?php endif; ?>

<?php wp_footer();?>
</body>
</html>