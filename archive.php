
    <?php get_header();?>
    
    <?php 
    $sidebar_pos = get_option('archie_rombo_sidebar_position', 'right');
    $container_width = get_option('archie_rombo_container_width', 'fluid');
    $sidebar_width_opt = get_option('archie_rombo_sidebar_width', '3');
    $container_class = ($container_width === 'boxed') ? 'container' : 'container-fluid';
    
    $content_columns = 12 - absint($sidebar_width_opt);
    $sidebar_columns = absint($sidebar_width_opt);

    $content_class = 'col-lg-' . $content_columns . ' col-md-12';
    $sidebar_class = 'col-lg-' . $sidebar_columns . ' col-md-12';
    
    if ($sidebar_pos === 'none' || !is_active_sidebar('blog-sidebar')) {
        $content_class = 'col-12';
    }
    ?>

    <div class="<?php echo esc_attr($container_class); ?> mb-5" style="padding-left: 2rem;padding-right: 2rem;">
        <div class="row">
            <?php if ($sidebar_pos === 'left' && is_active_sidebar('blog-sidebar')) : ?>
                <aside class="<?php echo esc_attr($sidebar_class); ?> order-2 order-lg-1" id="sidebar">
                    <?php dynamic_sidebar('blog-sidebar'); ?>
                </aside>
            <?php endif; ?>

            <main class="<?php echo esc_attr($content_class); ?> order-1 <?php echo ($sidebar_pos === 'left') ? 'order-lg-2' : ''; ?>">
                <?php
                if(have_posts()){
                    while(have_posts()){
                        the_post();
                        get_template_part('template-parts/content','archive');
                    }
                } 
                
                the_posts_pagination(
                    array(
                     'mid_size'  => 2,
                     'prev_text' => __( '<<', 'archie-rombo' ),
                     'next_text' => __( '>>', 'archie-rombo' ),
                    )
                );
                ?>
            </main>

            <?php if ($sidebar_pos === 'right' && is_active_sidebar('blog-sidebar')) : ?>
                <aside class="<?php echo esc_attr($sidebar_class); ?> order-2" id="sidebar">
                    <?php dynamic_sidebar('blog-sidebar'); ?>
                </aside>
            <?php endif; ?>
        </div>
    </div>
	    
<?php get_footer();?>