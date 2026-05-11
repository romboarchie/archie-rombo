<?php
/**
 * Archie-Rombo Theme Functions
 * 
 * Only works in WordPress 6.4 or later.
 */


if ( version_compare( $GLOBALS['wp_version'], '6.4', '<' ) ) {
	
	return;
}

// PHP Version Check for Production Environments
if ( version_compare( phpversion(), '7.2', '<' ) ) {
	wp_die( 'This theme requires PHP 7.2 or higher. Please contact your hosting provider to upgrade PHP.' );
}

if ( ! class_exists( 'Archie_Rombo_Bootstrap_Nav_Walker' ) ) :
	class Archie_Rombo_Bootstrap_Nav_Walker extends Walker_Nav_Menu {
		private $current_item;
		private $dropdown_menu_alignment_values = array(
			'dropdown-menu-start',
			'dropdown-menu-end',
			'dropdown-menu-sm-start',
			'dropdown-menu-sm-end',
			'dropdown-menu-md-start',
			'dropdown-menu-md-end',
			'dropdown-menu-lg-start',
			'dropdown-menu-lg-end',
			'dropdown-menu-xl-start',
			'dropdown-menu-xl-end',
			'dropdown-menu-xxl-start',
			'dropdown-menu-xxl-end',
		);

		public function start_lvl( &$output, $depth = 0, $args = null ) {
			$dropdown_menu_class = array();
			foreach ( $this->current_item->classes as $class ) {
				if ( in_array( $class, $this->dropdown_menu_alignment_values, true ) ) {
					$dropdown_menu_class[] = $class;
				}
			}
			$indent  = str_repeat( "\t", $depth );
			$submenu = ( $depth > 0 ) ? ' sub-menu' : '';
			$output .= "\n$indent<ul class=\"dropdown-menu$submenu " . esc_attr( implode( ' ', $dropdown_menu_class ) ) . " depth_$depth\">\n";
		}

		public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
			$this->current_item = $item;
			$indent             = $depth ? str_repeat( "\t", $depth ) : '';

			$li_attributes = '';
			$class_names   = $value = '';
			$classes       = empty( $item->classes ) ? array() : (array) $item->classes;

			$has_children = ! empty( $args->has_children );

			$classes[] = $has_children ? 'dropdown' : '';
			$classes[] = 'nav-item';
			$classes[] = 'nav-item-' . $item->ID;
			if ( $depth && $has_children ) {
				$classes[] = 'dropdown-menu dropdown-menu-end';
			}

			$class_names = implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
			$class_names = ' class="' . esc_attr( $class_names ) . '"';

			$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args );
			$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

			$output .= $indent . '<li ' . $id . $value . $class_names . $li_attributes . '>';

			$attributes  = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
			$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
			$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
			$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"' : '';

			$active_class   = ( $item->current || $item->current_item_ancestor || in_array( 'current_page_parent', $item->classes, true ) || in_array( 'current-post-ancestor', $item->classes, true ) ) ? 'active' : '';
			$nav_link_class = ( $depth > 0 ) ? 'dropdown-item ' : 'nav-link ';
			$attributes    .= $has_children ? ' class="' . $nav_link_class . $active_class . ' dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"' : ' class="' . $nav_link_class . $active_class . '"';

			$item_output  = $args->before;
			$item_output .= '<a' . $attributes . '>';
			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
			$item_output .= '</a>';
			$item_output .= $args->after;

			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	}
endif;

if ( ! function_exists( 'archie_rombo_setup' ) ) :
	function archie_rombo_setup() {
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 100,
				'width'       => 400,
				'flex-height' => true,
				'flex-width'  => true,
				'header-text' => array( 'site-title', 'site-description' ),
				'unlink-homepage-logo' => true,
			)
		);

		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails', array( 'post' ) );
		add_theme_support( 'widgets' );
		add_theme_support( 'woocommerce' );
		add_theme_support( 'customize-selective-refresh-widgets' );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'automatic-feed-links' );

		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => esc_html__( 'Orange', 'archie-rombo' ),
					'slug'  => 'orange',
					'color' => '#fd9c30',
				),
				array(
					'name'  => esc_html__( 'Black', 'archie-rombo' ),
					'slug'  => 'black',
					'color' => '#1d1d1d',
				),
				array(
					'name'  => esc_html__( 'Grey', 'archie-rombo' ),
					'slug'  => 'grey',
					'color' => '#82868b',
				),
			)
		);
		add_theme_support( 'align-wide' );
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => esc_html__( 'small', 'archie-rombo' ),
					'shortName' => esc_html__( 'S', 'archie-rombo' ),
					'size'      => 12,
					'slug'      => 'small',
				),
				array(
					'name'      => esc_html__( 'regular', 'archie-rombo' ),
					'shortName' => esc_html__( 'M', 'archie-rombo' ),
					'size'      => 16,
					'slug'      => 'regular',
				),
				array(
					'name'      => esc_html__( 'larger', 'archie-rombo' ),
					'shortName' => esc_html__( 'L', 'archie-rombo' ),
					'size'      => 36,
					'slug'      => 'larger',
				),
				array(
					'name'      => esc_html__( 'huge', 'archie-rombo' ),
					'shortName' => esc_html__( 'XL', 'archie-rombo' ),
					'size'      => 48,
					'slug'      => 'huge',
				),
			)
		);
		add_theme_support( 'editor-styles' );
		add_theme_support( 'wp-block-styles' );
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Add support for Block Templates (WordPress 5.9+)
		add_theme_support( 'block-templates' );

		// Add support for appearance tools in block editor
		add_theme_support( 'appearance-tools' );
	}
endif;
add_action( 'after_setup_theme', 'archie_rombo_setup' );

function archie_rombo_register_menus() {
	register_nav_menus(
		array(
			'main-menu'   => 'Main Menu',
			'footer-menu' => 'Footer Menu ',
		)
	);
}
add_action( 'init', 'archie_rombo_register_menus' );


function archie_rombo_custom_header_setup() {
	add_theme_support(
		'custom-header',
		array(
			'default-image'      => '',
			'default-text-color' => '343434',
			'width'              => 1000,
			'height'             => 250,
			'flex-height'        => true,
			'flex-width'         => true,
		)
	);
}
add_action( 'after_setup_theme', 'archie_rombo_custom_header_setup' );




/**
 * Register custom fonts.
 */
function archie_rombo_fonts_url() {
	$font_families   = array( 'Roboto:300,300i,400,400i,500,700' );
	$query_args      = array(
		'family' => urlencode( implode( '|', $font_families ) ),
		'subset' => urlencode( 'latin,latin-ext' ),
	);
	$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	return esc_url_raw( $fonts_url );
}

function archie_rombo_register_styles() {
	$version = wp_get_theme()->get( 'Version' );

	wp_enqueue_style( 'google-fonts', archie_rombo_fonts_url(), array(), null );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '5.3.2', 'all' );
	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/fontawesome-6.5.1-web-pro/css/all.min.css', array(), '6.5.1', 'all' );
	wp_enqueue_style( 'animate', get_template_directory_uri() . '/animate.css/animate.min.css', array(), '3.4.0', 'all' );
	wp_enqueue_style( 'component-css', get_template_directory_uri() . '/css/component.css', array(), '1.0.0', 'all' );
	// Dashboard Styles
	wp_enqueue_style( 'archie-rombo-style', get_stylesheet_uri(), array(), $version, 'all' );
}
add_action( 'wp_enqueue_scripts', 'archie_rombo_register_styles' );

/**
 * Generate Dynamic CSS for Theme Options.
 */
function archie_rombo_dynamic_css() {
	$primary_color = get_option( 'archie_rombo_primary_color', '#33bbcc' );
	$primary_color = sanitize_hex_color( $primary_color ) ?: '#33bbcc';

	$body_size = get_option( 'archie_rombo_body_font_size', 17 );
	$title_size = get_option( 'archie_rombo_heading_font_size', 36 );
	$body_font = get_option( 'archie_rombo_body_font_family', 'TitilliumWeb' );
	$title_font = get_option( 'archie_rombo_heading_font_family', 'Amaranth' );

	$body_lh = get_option( 'archie_rombo_body_line_height', '1.75' );
	$title_lh = get_option( 'archie_rombo_heading_line_height', '1.4' );
	$body_weight = get_option( 'archie_rombo_body_font_weight', 'normal' );
	$title_weight = get_option( 'archie_rombo_heading_font_weight', 'bold' );
	$title_transform = get_option( 'archie_rombo_heading_transform', 'none' );
	$body_ls = get_option( 'archie_rombo_body_letter_spacing', '0' );
	$title_ls = get_option( 'archie_rombo_heading_letter_spacing', '0' );

	$heading_color = get_option( 'archie_rombo_heading_color', '' );
	$heading_color = sanitize_hex_color($heading_color);

	$btn_radius = get_option( 'archie_rombo_button_radius', 4 );
	$btn_padding_v = get_option( 'archie_rombo_button_padding_v', 10 );
	$btn_padding_h = get_option( 'archie_rombo_button_padding_h', 20 );

	$overlay_color = get_option( 'archie_rombo_header_overlay_color', '#000000' );
	$overlay_opacity = get_option( 'archie_rombo_header_overlay_opacity', '0.5' );
	$social_style = get_option( 'archie_rombo_social_icon_style', 'none' );
	$social_color = get_option( 'archie_rombo_social_icon_color', '' );

	$navbar_height = get_option( 'archie_rombo_navbar_height', 80 );
	$navbar_shrink = get_option( 'archie_rombo_navbar_shrink', 0 );
	$hero_padding = get_option( 'archie_rombo_hero_padding', 100 );
	$back_to_top   = get_option( 'archie_rombo_back_to_top', 1 );
	$mobile_topbar_hide = get_option( 'archie_rombo_mobile_topbar_hide', 0 );

	$font_stacks = array(
		'TitilliumWeb' => '"TitilliumWeb", arial, helvetica, sans-serif',
		'Amaranth'     => '"Amaranth", arial, helvetica, sans-serif',
		'Roboto'       => '"Roboto", arial, helvetica, sans-serif',
		'Arial'        => 'Arial, Helvetica, sans-serif',
		'Georgia'      => 'Georgia, "Times New Roman", serif'
	);

	$body_stack = isset($font_stacks[$body_font]) ? $font_stacks[$body_font] : $font_stacks['TitilliumWeb'];
	$title_stack = isset($font_stacks[$title_font]) ? $font_stacks[$title_font] : $font_stacks['Amaranth'];

	?>
	<style type="text/css">
		:root {
			--primary-color: <?php echo esc_attr( $primary_color ); ?>;
			--button-color: <?php echo esc_attr( $primary_color ); ?>;
			--link-color: <?php echo esc_attr( $primary_color ); ?>;
			
			--text-font: <?php echo $body_stack; ?>;
			--title-font: <?php echo $title_stack; ?>;
			--navi-font: <?php echo $body_stack; ?>;
			--widget-title-font: <?php echo $title_stack; ?>;

			--text-line-height: <?php echo esc_attr($body_lh); ?>;
			--title-line-height: <?php echo esc_attr($title_lh); ?>;
			--title-font-weight: <?php echo esc_attr($title_weight); ?>;
			--title-text-transform: <?php echo esc_attr($title_transform); ?>;
			
			--text-letter-spacing: <?php echo esc_attr($body_ls); ?>px;
			--title-letter-spacing: <?php echo esc_attr($title_ls); ?>px;

			--button-radius: <?php echo absint($btn_radius); ?>px;
			--button-padding-v: <?php echo absint($btn_padding_v); ?>px;
			--button-padding-h: <?php echo absint($btn_padding_h); ?>px;

			--header-overlay-color: <?php echo esc_attr($overlay_color); ?>;
			--header-overlay-opacity: <?php echo esc_attr($overlay_opacity); ?>;
			--navbar-height: <?php echo absint($navbar_height); ?>px;
			--hero-padding: <?php echo absint($hero_padding); ?>px;
		}

		body {
			font-size: <?php echo absint($body_size); ?>px;
			font-weight: <?php echo esc_attr($body_weight); ?>;
			letter-spacing: var(--text-letter-spacing);
		}

		.page-title, .entry-title, h1, h2, h3, h4, h5, h6 {
			font-size: <?php echo absint($title_size); ?>px;
			letter-spacing: var(--title-letter-spacing);
			<?php if ($heading_color) : ?>
			color: <?php echo esc_attr($heading_color); ?>;
			<?php endif; ?>
		}

		.search-form .search-submit,
		button, .btn, input[type="button"], input[type="reset"], input[type="submit"],
		.more-link {
			border-radius: var(--button-radius);
			padding: var(--button-padding-v) var(--button-padding-h);
		}

		/* Hero Section Styling */
		.hero-section {
			position: relative;
			background-size: cover;
			background-position: center;
			padding: var(--hero-padding) 0;
			min-height: 300px;
			display: flex;
			align-items: center;
			margin-bottom: 2rem;
		}
		.hero-overlay {
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			background-color: var(--header-overlay-color);
			opacity: var(--header-overlay-opacity);
		}
		.hero-title {
			font-family: var(--title-font);
			text-shadow: 0 2px 4px rgba(0,0,0,0.3);
		}

		/* Navbar Shrink */
		<?php if ($navbar_shrink) : ?>
		.site-main-nav.is-sticky {
			min-height: calc(var(--navbar-height) * 0.75) !important;
			transition: all 0.3s ease;
		}
		.site-main-nav.is-sticky .navbar-brand img {
			max-height: calc(var(--navbar-height) * 0.75 - 15px) !important;
		}
		<?php endif; ?>

		/* Mobile Top Bar Optimization */
		<?php if ($mobile_topbar_hide) : ?>
		@media (max-width: 767px) {
			.top-bar {
				display: none !important;
			}
			header.is-transparent {
				position: relative !important;
			}
		}
		<?php endif; ?>

		/* Social Icons Styling */
		.footer .social-link {
			text-decoration: none !important;
			color: inherit;
		}
		.footer .fa-brands {
			<?php if ($social_color) : ?>
			color: <?php echo esc_attr($social_color); ?> !important;
			<?php endif; ?>
			
			<?php if ($social_style === 'square' || $social_style === 'round') : ?>
			background-color: var(--primary-color);
			color: #fff !important;
			width: 40px;
			height: 40px;
			line-height: 40px;
			text-align: center;
			display: inline-block;
			margin: 0 5px;
			transition: all 0.3s ease;
			<?php else : ?>
			margin: 0 10px;
			transition: all 0.3s ease;
			<?php endif; ?>

			<?php if ($social_style === 'round') : ?>
			border-radius: 50%;
			<?php elseif ($social_style === 'square') : ?>
			border-radius: 4px;
			<?php endif; ?>
		}
		.footer .social-link:hover .fa-brands {
			transform: translateY(-3px);
			<?php if ($social_style === 'square' || $social_style === 'round') : ?>
			box-shadow: 0 4px 8px rgba(0,0,0,0.2);
			<?php endif; ?>
		}

		<?php if ( $primary_color && $primary_color !== '#33bbcc' ) : ?>
		.search-form .search-submit,
		button, .btn, input[type="button"], input[type="reset"], input[type="submit"],
		.pagination .current,
		.more-link {
			background-color: <?php echo esc_attr( $primary_color ); ?>;
			border-color: <?php echo esc_attr( $primary_color ); ?>;
		}
		a,
		.reply .comment-reply-link,
		.logged-in-as a, .fn a, .comment-meta .commentmetadata, .comment-edit-link,
		.widget ul li a {
			color: <?php echo esc_attr( $primary_color ); ?>;
		}
		<?php endif; ?>

		/* Navbar Height */
		.site-main-nav {
			min-height: var(--navbar-height);
		}
		.site-main-nav .navbar-brand img {
			max-height: calc(var(--navbar-height) - 20px);
		}

		/* Back to Top Styling */
		#back-to-top {
			position: fixed;
			bottom: 30px;
			right: 30px;
			width: 45px;
			height: 45px;
			background-color: var(--primary-color);
			color: #fff;
			border: none;
			border-radius: 50%;
			cursor: pointer;
			display: none;
			z-index: 1000;
			box-shadow: 0 4px 10px rgba(0,0,0,0.3);
			transition: all 0.3s ease;
		}
		#back-to-top:hover {
			background-color: var(--secondary-color);
			transform: translateY(-5px);
		}

		/* Transparent Header Styles */
		header.is-transparent {
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			z-index: 1050;
		}
		header.is-transparent .top-bar,
		header.is-transparent .site-main-nav {
			background-color: transparent !important;
			box-shadow: none !important;
		}
		header.is-transparent .site-main-nav .nav-link,
		header.is-transparent .site-main-nav .navbar-brand,
		header.is-transparent .top-bar p,
		header.is-transparent .top-bar a,
		header.is-transparent .top-bar span {
			color: #ffffff !important;
		}
		header.is-transparent .site-main-nav .nav-link:hover {
			color: rgba(255,255,255,0.8) !important;
		}
		header.is-transparent .navbar-toggler {
			border-color: rgba(255,255,255,0.5) !important;
		}
		header.is-transparent .navbar-toggler-icon {
			filter: invert(1) grayscale(100%) brightness(200%);
		}
		
		/* Ensure Hero Section offsets the absolute header if needed */
		header.is-transparent + section.hero-section {
			padding-top: calc(var(--navbar-height) + 60px);
		}

		/* Reset when sticky */
		header.is-transparent .site-main-nav.sticky-top.is-sticky {
			background-color: var(--page-background-color) !important;
			box-shadow: 0 0 20px rgba(0,0,0,0.15) !important;
		}
		header.is-transparent .site-main-nav.sticky-top.is-sticky .nav-link,
		header.is-transparent .site-main-nav.sticky-top.is-sticky .navbar-brand {
			color: var(--navi-color) !important;
		}
	</style>
	<?php
}
add_action( 'wp_head', 'archie_rombo_dynamic_css' );


/*
 * This theme styles the visual editor to resemble the theme style,
 * specifically font, colors, and column width.
*/
add_editor_style( array( archie_rombo_fonts_url(), 'style.css' ) );



function archie_rombo_register_scripts() {
	wp_register_script( 'modernizr-custom-js', get_template_directory_uri() . '/js/modernizr.custom.js', array(), '2.6.2', true );
	wp_register_script( 'classie', get_template_directory_uri() . '/js/classie.js', array(), '', true );
	wp_register_script( 'uisearch', get_template_directory_uri() . '/js/uisearch.js', array(), '', true );
	wp_enqueue_script( 'jquery' );
	wp_register_script( 'color-modes', get_template_directory_uri() . '/js/color-modes.js', array(), '5.3.2', false ); // Load in head
	wp_register_script( 'bootstrap-bundle', get_template_directory_uri() . '/js/bootstrap.bundle.min.js', array(), '5.3.2', true ); // BS5 doesn't depend on jQuery
	wp_register_script( 'lazyload', get_template_directory_uri() . '/js/lazyload.js', array(), '2.0.0-rc.2', true );
	wp_register_script( 'searchscript', get_template_directory_uri() . '/js/search-script.js', array(), '', true );
	wp_register_script( 'theme-scripts', get_template_directory_uri() . '/js/theme-scripts.js', array('jquery'), '1.0.0', true );

	wp_enqueue_script( 'modernizr-custom-js' );
	wp_enqueue_script( 'classie' );
	wp_enqueue_script( 'uisearch' );
	wp_enqueue_script( 'color-modes' );
	wp_enqueue_script( 'bootstrap-bundle' );
	wp_enqueue_script( 'lazyload' );
	wp_enqueue_script( 'searchscript' );
	wp_enqueue_script( 'theme-scripts' );

	// Localize script data for AJAX and frontend functionality
	wp_localize_script( 'theme-scripts', 'archieRomboData', array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
		'nonce'   => wp_create_nonce( 'archie-rombo-nonce' ),
	) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'archie_rombo_register_scripts' );



add_image_size('blog-large', 800, 400, false);
add_image_size('blog-small', 300, 200, false);







//Register Sidebars Widgets
function archie_rombo_sidebars() {

	register_sidebar(

		array(
			'name' => 'Page Sidebar',
			'before_widget' => '<div class="widget %2$s">',
			'after_widget' => '</div>',
			'id' => 'page-sidebar',
			'before_title' => '<div class="widget-header"><h3 class="widget-title">',
			'after_title' => '</h3></div>',
		)

	);
	register_sidebar(

		array(
			'name' => 'Blog Sidebar',
			'before_widget' => '<div class="widget %2$s">',
			'after_widget' => '</div>',
			'id' => 'blog-sidebar',
			'before_title' => '<div class="widget-header"><h3 class="widget-title">',
			'after_title' => '</h3></div>',
		)

	);
}
add_action( 'widgets_init', 'archie_rombo_sidebars' );


//Registering Footer Widgets
function archie_rombo_footer_widgets() {
	register_sidebar(
		array(
			'name' => 'Footer Widget 1',
			'id' => 'footer-widget-1',
			'before_widget' => '<div class="widget widget_footer %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="widget-header"><h3 class="widget-title">',
			'after_title' => '</h3></div>',
		)
	);
	register_sidebar(
		array(
			'name' => 'Footer Widget 2',
			'id' => 'footer-widget-2',
			'before_widget' => '<div class="widget widget_footer %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="widget-header"><h3 class="widget-title">',
			'after_title' => '</h3></div>',
		)
	);
	register_sidebar(
		array(
			'name' => 'Footer Widget 3',
			'id' => 'footer-widget-3',
			'before_widget' => '<div class="widget widget_footer %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="widget-header"><h3 class="widget-title">',
			'after_title' => '</h3></div>',
		)
	);
	register_sidebar(
		array(
			'name' => 'Footer Widget 4',
			'id' => 'footer-widget-4',
			'before_widget' => '<div class="widget widget_footer  %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="widget-header"><h3 class="widget-title">',
			'after_title' => '</h3></div>',
		)
	);
	register_sidebar(
		array(
			'name' => 'Footer Social',
			'id' => 'footer-social',
			'before_widget' => '<div class="widget widget_footer %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="widget-header"><h3 class="widget-title">',
			'after_title' => '</h3></div>',
		)
	);
}
add_action( 'widgets_init', 'archie_rombo_footer_widgets' );


/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function archie_rombo_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'archie_rombo_pingback_header' );



/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function archie_rombo_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'archie_rombo_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'archie_rombo_customize_partial_blogdescription',
			)
		);
	}
}
add_action( 'customize_register', 'archie_rombo_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function archie_rombo_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function archie_rombo_customize_partial_blogdescription() {
	bloginfo( 'description' );
}





// Include Theme Dashboard
require get_template_directory() . '/includes/theme-dashboard.php';

// Include Meta Boxes
require get_template_directory() . '/includes/meta-boxes.php';

add_filter( 'wp_title', 'archie_rombo_custom_titles', 10, 2 );
function archie_rombo_custom_titles( $title, $sep ) {
	if ( function_exists( 'ot_get_option' ) && ot_get_option( 'enable_custom_titles' ) === 'on' ) {
		$title = 'Some other title' . $title;
	}

	return $title;
}

function archie_rombo_register_block_styles() {
	if ( function_exists( 'register_block_style' ) ) {
		register_block_style(
			'core/quote',
			array(
				'name'         => 'blue-quote',
				'label'        => __( 'Blue Quote', 'archie-rombo' ),
				'is_default'   => true,
				'inline_style' => '.wp-block-quote.is-style-blue-quote { color: blue; }',
			)
		);
	}
}
add_action( 'init', 'archie_rombo_register_block_styles' );
add_action( 'init', 'archie_rombo_register_block_pattern_categories' );

/**
 * Register custom block pattern category.
 *
 * @since 1.0.2
 */
function archie_rombo_register_block_pattern_categories() {
	if ( function_exists( 'register_block_pattern_category' ) ) {
		register_block_pattern_category(
			'archie-rombo',
			array(
				'label' => __( 'Archie Rombo', 'archie-rombo' ),
			)
		);
	}
}

function archie_rombo_register_block_patterns() {
	register_block_pattern(
		'archie-rombo/my-example',
		array(
			'title'         => __( 'My First Block Pattern', 'archie-rombo' ),
			'description'   => _x( 'This is my first block pattern', 'Block pattern description', 'archie-rombo' ),
			'content'       => '<!-- wp:paragraph --><p>A single paragraph block style</p><!-- /wp:paragraph -->',
			'categories'    => array( 'text' ),
			'keywords'      => array( 'cta', 'demo', 'example' ),
			'viewportWidth' => 800,
		)
	);

	register_block_pattern(
		'archie-rombo/hero-section-builder',
		array(
			'title'       => __( 'Hero Section Builder', 'archie-rombo' ),
			'description' => __( 'A hero banner with heading, text, buttons, and background image.', 'archie-rombo' ),
			'content'     => '<!-- wp:cover {"url":"https://via.placeholder.com/1920x900","dimRatio":50,"focalPoint":{"x":0.5,"y":0.5},"align":"full","minHeight":450,"customOverlayColor":"#000000"} --><div class="wp-block-cover alignfull has-background-dim has-background-dim-50" style="background-image:url(https://via.placeholder.com/1920x900);min-height:450px"><span aria-hidden="true" class="wp-block-cover__gradient-background has-background-color"></span><div class="wp-block-cover__inner-container"><!-- wp:group {"layout":{"type":"constrained","contentSize":"800px"}} --><div class="wp-block-group"><!-- wp:heading {"textAlign":"center","level":1,"className":"hero-title"} --><h1 class="has-text-align-center hero-title">Your next great project starts here</h1><!-- /wp:heading --><!-- wp:paragraph {"align":"center"} --><p class="has-text-align-center">Craft unforgettable experiences with a high-impact hero section designed for conversions.</p><!-- /wp:paragraph --><!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} --><div class="wp-block-buttons"><!-- wp:button {"style":{"border":{"radius":"999px"}},"className":"is-style-fill"} --><div class="wp-block-button is-style-fill"><a class="wp-block-button__link" href="#">Get Started</a></div><!-- /wp:button --><!-- wp:button {"style":{"spacing":{"padding":{"top":"0.9rem","bottom":"0.9rem","left":"1.6rem","right":"1.6rem"}}},"className":"is-style-outline"} --><div class="wp-block-button is-style-outline"><a class="wp-block-button__link" href="#">Learn More</a></div><!-- /wp:button --></div><!-- /wp:buttons --></div><!-- /wp:group --></div></div><!-- /wp:cover -->',
			'categories'  => array( 'archie-rombo', 'featured' ),
			'keywords'    => array( 'hero', 'banner', 'cta', 'header' ),
			'viewportWidth'=> 1200,
		)
	);
}
add_action( 'init', 'archie_rombo_register_block_patterns' );


/**
 * Output JSON-LD Structured Data for SEO
 * 
 * @since 1.0.1
 */
function archie_rombo_output_json_ld() {
	if ( ! get_theme_mod( 'archie_rombo_enable_structured_data', 1 ) ) {
		return;
	}

	if ( is_404() || is_admin() ) {
		return;
	}

	global $wp;
	$site_name = get_bloginfo( 'name' );
	$site_desc = get_bloginfo( 'description' );
	$home_url  = home_url( '/' );
	$current_url = home_url( add_query_arg( array(), $wp->request ) );

	$schema = array(
		'@context' => 'https://schema.org',
		'@graph'   => array(
			array(
				'@type' => 'WebSite',
				'@id'   => $home_url . '#website',
				'url'    => $home_url,
				'name'   => $site_name,
				'description' => $site_desc,
				'potentialAction' => array(
					'@type' => 'SearchAction',
					'target' => $home_url . '?s={search_term_string}',
					'query-input' => 'required name=search_term_string',
				),
			),
		),
	);

	if ( is_singular( 'post' ) ) {
		global $post;
		$author_name = get_the_author_meta( 'display_name', $post->post_author );
		$image_url = has_post_thumbnail( $post->ID ) ? get_the_post_thumbnail_url( $post->ID, 'large' ) : '';
		$schema['@graph'][] = array(
			'@type'           => 'Article',
			'@id'             => get_permalink( $post->ID ) . '#article',
			'url'             => get_permalink( $post->ID ),
			'headline'        => get_the_title( $post->ID ),
			'image'           => $image_url,
			'datePublished'   => get_the_date( DATE_W3C, $post->ID ),
			'dateModified'    => get_the_modified_date( DATE_W3C, $post->ID ),
			'author'         => array(
				'@type' => 'Person',
				'name'  => $author_name,
			),
			'publisher'       => array(
				'@type' => 'Organization',
				'name'  => $site_name,
				'logo'  => array(
					'@type' => 'ImageObject',
					'url'   => get_theme_mod( 'custom_logo' ) ? wp_get_attachment_image_url( get_theme_mod( 'custom_logo' ), 'full' ) : '',
				),
			),
			'description'     => get_the_excerpt( $post->ID ),
			'mainEntityOfPage' => get_permalink( $post->ID ),
		);
	} elseif ( is_singular( 'page' ) ) {
		global $post;
		$schema['@graph'][] = array(
			'@type' => 'WebPage',
			'@id'   => get_permalink( $post->ID ) . '#webpage',
			'url'    => get_permalink( $post->ID ),
			'name'   => get_the_title( $post->ID ),
			'description' => get_the_excerpt( $post->ID ),
		);
	} elseif ( is_front_page() || is_home() ) {
		$schema['@graph'][] = array(
			'@type' => 'WebPage',
			'@id'   => $home_url . '#homepage',
			'url'    => $home_url,
			'name'   => $site_name,
			'description' => $site_desc,
		);
	} elseif ( is_archive() || is_search() ) {
		$schema['@graph'][] = array(
			'@type' => 'CollectionPage',
			'@id'   => $current_url . '#collection',
			'url'    => $current_url,
			'name'   => wp_get_document_title(),
			'description' => $site_desc,
		);
	}

	echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT ) . '</script>';
}
add_action( 'wp_head', 'archie_rombo_output_json_ld' );


/**
 * Breadcrumb Navigation
 * Displays breadcrumbs for improved navigation and SEO
 * 
 * @since 1.0.1
 */
function archie_rombo_breadcrumbs() {
	// Check if breadcrumbs are enabled
	if ( ! get_theme_mod( 'archie_rombo_enable_breadcrumbs', 1 ) ) {
		return;
	}

	// Don't show breadcrumbs on homepage or 404 pages
	if ( is_front_page() || is_404() ) {
		return;
	}

	$breadcrumb = array();
	$show_on_home = 0; // set to 1 to show breadcrumbs on home page

	if ( is_home() || ( is_single() && get_post_type() != 'page' ) ) {
		if ( get_option('show_on_front') == 'page' ) {
			$home_link = home_url( '/' );
			$breadcrumb[] = '<a href="' . esc_url( $home_link ) . '">' . esc_html__( 'Home', 'archie-rombo' ) . '</a>';
			
			if ( is_single() ) {
				$cat = get_the_category();
				if ( $cat ) {
					$cat = $cat[0];
					$breadcrumb[] = '<a href="' . esc_url( get_category_link( $cat->term_id ) ) . '">' . esc_html( $cat->name ) . '</a>';
				}
				$breadcrumb[] = get_the_title();
			}
		}
	} elseif ( is_category() ) {
		$breadcrumb[] = '<a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'archie-rombo' ) . '</a>';
		$breadcrumb[] = esc_html__( 'Archive by category', 'archie-rombo' ) . ' "' . single_cat_title( '', false ) . '"';
	} elseif ( is_search() ) {
		$breadcrumb[] = '<a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'archie-rombo' ) . '</a>';
		$breadcrumb[] = esc_html__( 'Search results for', 'archie-rombo' ) . ' "' . get_search_query() . '"';
	} elseif ( is_page() ) {
		$breadcrumb[] = '<a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'archie-rombo' ) . '</a>';
		
		if ( $post_ancestors = get_post_ancestors( get_the_ID() ) ) {
			$post_ancestors = array_reverse( $post_ancestors );
			foreach ( $post_ancestors as $crumb ) {
				$breadcrumb[] = '<a href="' . esc_url( get_permalink( $crumb ) ) . '">' . esc_html( get_the_title( $crumb ) ) . '</a>';
			}
		}
		
		$breadcrumb[] = get_the_title();
	} elseif ( is_singular( 'portfolios' ) ) {
		$breadcrumb[] = '<a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'archie-rombo' ) . '</a>';
		$breadcrumb[] = '<a href="' . esc_url( home_url( '/portfolios/' ) ) . '">' . esc_html__( 'Portfolios', 'archie-rombo' ) . '</a>';
		$breadcrumb[] = get_the_title();
	} elseif ( is_archive() ) {
		$breadcrumb[] = '<a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'archie-rombo' ) . '</a>';
		$breadcrumb[] = get_the_archive_title();
	}

	if ( ! empty( $breadcrumb ) ) {
		echo '<nav class="breadcrumbs" aria-label="' . esc_attr__( 'Breadcrumb', 'archie-rombo' ) . '">';
		echo implode( ' <span class="breadcrumb-sep">/</span> ', $breadcrumb );
		echo '</nav>';
	}
}

// Add breadcrumb styling
function archie_rombo_breadcrumb_styles() {
	?>
	<style>
		.breadcrumbs {
			margin: 1rem 0;
			padding: 1rem 0;
			font-size: 0.9rem;
			color: #666;
		}
		.breadcrumbs a {
			color: var(--primary-color);
			text-decoration: none;
			transition: color 0.3s ease;
		}
		.breadcrumbs a:hover {
			text-decoration: underline;
		}
		.breadcrumb-sep {
			margin: 0 0.5rem;
			color: #999;
		}
	</style>
	<?php
}
add_action( 'wp_head', 'archie_rombo_breadcrumb_styles' );


/**
 * Portfolio grid filters
 * Adds category filters to the portfolios archive and ensures query support.
 *
 * @since 1.0.1
 */
function archie_rombo_get_portfolio_categories() {
    if ( ! taxonomy_exists( 'category' ) ) {
        return array();
    }

    $terms = get_terms(
        array(
            'taxonomy'   => 'category',
            'hide_empty' => true,
            'orderby'    => 'name',
            'order'      => 'ASC',
        )
    );

    return is_wp_error( $terms ) ? array() : $terms;
}

function archie_rombo_portfolio_filter_bar() {
    if ( ! is_post_type_archive( 'portfolios' ) ) {
        return;
    }

    $terms = archie_rombo_get_portfolio_categories();
    if ( empty( $terms ) ) {
        return;
    }

    $current_cat = isset( $_GET['cat'] ) ? absint( wp_unslash( $_GET['cat'] ) ) : 0;
    $archive_url  = get_post_type_archive_link( 'portfolios' );

    echo '<div class="portfolio-filter-bar mb-4">';
    echo '<div class="filter-label mb-2"><strong>' . esc_html__( 'Filter by category', 'archie-rombo' ) . '</strong></div>';
    echo '<div class="btn-toolbar flex-wrap">';
    echo '<a href="' . esc_url( $archive_url ) . '" class="btn btn-outline-primary mb-2 me-2' . ( $current_cat === 0 ? ' active' : '' ) . '">' . esc_html__( 'All', 'archie-rombo' ) . '</a>';

    foreach ( $terms as $term ) {
        $url    = add_query_arg( 'cat', $term->term_id, $archive_url );
        $active = $current_cat === $term->term_id ? ' active' : '';

        echo '<a href="' . esc_url( $url ) . '" class="btn btn-outline-secondary mb-2 me-2' . $active . '">' . esc_html( $term->name ) . '</a>';
    }

    echo '</div>';
    echo '</div>';
}

function archie_rombo_portfolio_filter_query( $query ) {
    if ( is_admin() || ! $query->is_main_query() ) {
        return;
    }

    if ( is_post_type_archive( 'portfolios' ) ) {
        if ( isset( $_GET['cat'] ) && absint( $_GET['cat'] ) ) {
            $query->set( 'cat', absint( wp_unslash( $_GET['cat'] ) ) );
        }
    }
}
add_action( 'pre_get_posts', 'archie_rombo_portfolio_filter_query' );


/**
 * Related Posts Feature
 * Display related posts on single post pages
 * 
 * @since 1.0.1
 */
function archie_rombo_related_posts( $num_posts = 3 ) {
	// Check if related posts are enabled
	if ( ! get_theme_mod( 'archie_rombo_enable_related_posts', 1 ) ) {
		return;
	}

	if ( ! is_single() || get_post_type() !== 'post' ) {
		return;
	}

	// Get number of posts from customizer if not passed as parameter
	if ( $num_posts === 3 ) {
		$num_posts = get_theme_mod( 'archie_rombo_related_posts_count', 3 );
	}

	$categories = get_the_category();
	if ( empty( $categories ) ) {
		return;
	}

	$category_ids = wp_list_pluck( $categories, 'term_id' );

	$args = array(
		'category__in'        => $category_ids,
		'posts_per_page'      => absint( $num_posts ),
		'post__not_in'        => array( get_the_ID() ),
		'orderby'             => 'date',
		'order'               => 'DESC',
		'tax_query'           => array(
			array(
				'taxonomy' => 'category',
				'field'    => 'term_id',
				'terms'    => $category_ids,
			),
		),
		'post_type'           => 'post',
		'post_status'         => 'publish',
		'suppress_filters'    => false,
	);

	$related_posts = new WP_Query( $args );

	if ( ! $related_posts->have_posts() ) {
		return;
	}

	?>
	<section class="related-posts mt-5 pt-5 border-top">
		<h3 class="mb-4"><?php esc_html_e( 'Related Posts', 'archie-rombo' ); ?></h3>
		<div class="row">
			<?php
			while ( $related_posts->have_posts() ) {
				$related_posts->the_post();
				?>
				<div class="col-lg-4 col-md-6 mb-4">
					<article class="card h-100 related-post-card">
						<?php if ( has_post_thumbnail() ) : ?>
							<a href="<?php the_permalink(); ?>" class="related-post-image">
								<?php the_post_thumbnail( 'blog-large', array( 'class' => 'card-img-top' ) ); ?>
							</a>
						<?php endif; ?>
						<div class="card-body">
							<h5 class="card-title">
								<a href="<?php the_permalink(); ?>" class="text-decoration-none">
									<?php the_title(); ?>
								</a>
							</h5>
							<p class="card-text text-muted small">
								<?php echo wp_trim_words( get_the_excerpt(), 15, '...' ); ?>
							</p>
							<div class="related-post-meta small text-muted">
								<?php echo esc_html( get_the_date( 'M d, Y' ) ); ?>
							</div>
						</div>
						<div class="card-footer bg-transparent border-top-0">
							<a href="<?php the_permalink(); ?>" class="btn btn-sm btn-outline-primary">
								<?php esc_html_e( 'Read More', 'archie-rombo' ); ?>
							</a>
						</div>
					</article>
				</div>
				<?php
			}
			wp_reset_postdata();
			?>
		</div>
	</section>
	<?php
}

// Styling for related posts
function archie_rombo_related_posts_styles() {
	?>
	<style>
		.related-posts {
			background: #f8f9fa;
			padding: 2rem;
			margin: 0 -2rem;
		}
		.related-post-card {
			transition: transform 0.3s ease, box-shadow 0.3s ease;
			border: 1px solid #dee2e6;
		}
		.related-post-card:hover {
			transform: translateY(-5px);
			box-shadow: 0 4px 12px rgba(0,0,0,0.1);
		}
		.related-post-image {
			display: block;
			overflow: hidden;
		}
		.related-post-image img {
			transition: transform 0.3s ease;
		}
		.related-post-card:hover .related-post-image img {
			transform: scale(1.05);
		}
		.related-post-meta {
			font-size: 0.85rem;
		}
		@media (max-width: 768px) {
			.related-posts {
				margin: 0 -1rem;
				padding: 1.5rem 1rem;
			}
		}
	</style>
	<?php
}
add_action( 'wp_head', 'archie_rombo_related_posts_styles' );


/**
 * Post Share Buttons Feature
 * Display social share buttons for posts
 * 
 * @since 1.0.1
 */
function archie_rombo_share_buttons() {
	// Check if share buttons are enabled
	if ( ! get_theme_mod( 'archie_rombo_enable_share_buttons', 1 ) ) {
		return;
	}

	if ( ! is_single() || get_post_type() !== 'post' ) {
		return;
	}

	$post_title = get_the_title();
	$post_url = get_permalink();
	$post_excerpt = wp_trim_words( get_the_excerpt(), 20 );
	
	// Prepare encoded data for URLs
	$encoded_url = rawurlencode( $post_url );
	$encoded_title = rawurlencode( $post_title );
	$encoded_excerpt = rawurlencode( $post_excerpt );

	$facebook_url = 'https://www.facebook.com/sharer/sharer.php?u=' . $encoded_url;
	$twitter_url = 'https://twitter.com/intent/tweet?url=' . $encoded_url . '&text=' . $encoded_title;
	$linkedin_url = 'https://www.linkedin.com/sharing/share-offsite/?url=' . $encoded_url;
	$whatsapp_url = 'https://wa.me/?text=' . $encoded_title . '%20' . $encoded_url;
	$email_url = 'mailto:?subject=' . $encoded_title . '&body=' . $encoded_excerpt . '%20' . $encoded_url;
	$pinterest_url = 'https://pinterest.com/pin/create/button/?url=' . $encoded_url . '&description=' . $encoded_title;

	?>
	<div class="share-buttons mt-4 pt-4 border-top">
		<h5 class="mb-3"><?php esc_html_e( 'Share this post', 'archie-rombo' ); ?></h5>
		<div class="share-buttons-list">
			<a href="<?php echo esc_url( $facebook_url ); ?>" target="_blank" rel="noopener noreferrer" class="share-btn share-facebook" title="<?php esc_attr_e( 'Share on Facebook', 'archie-rombo' ); ?>">
				<i class="fa-brands fa-facebook-f"></i>
				<span class="share-text"><?php esc_html_e( 'Facebook', 'archie-rombo' ); ?></span>
			</a>
			<a href="<?php echo esc_url( $twitter_url ); ?>" target="_blank" rel="noopener noreferrer" class="share-btn share-twitter" title="<?php esc_attr_e( 'Share on Twitter', 'archie-rombo' ); ?>">
				<i class="fa-brands fa-twitter"></i>
				<span class="share-text"><?php esc_html_e( 'Twitter', 'archie-rombo' ); ?></span>
			</a>
			<a href="<?php echo esc_url( $linkedin_url ); ?>" target="_blank" rel="noopener noreferrer" class="share-btn share-linkedin" title="<?php esc_attr_e( 'Share on LinkedIn', 'archie-rombo' ); ?>">
				<i class="fa-brands fa-linkedin-in"></i>
				<span class="share-text"><?php esc_html_e( 'LinkedIn', 'archie-rombo' ); ?></span>
			</a>
			<a href="<?php echo esc_url( $whatsapp_url ); ?>" target="_blank" rel="noopener noreferrer" class="share-btn share-whatsapp" title="<?php esc_attr_e( 'Share on WhatsApp', 'archie-rombo' ); ?>">
				<i class="fa-brands fa-whatsapp"></i>
				<span class="share-text"><?php esc_html_e( 'WhatsApp', 'archie-rombo' ); ?></span>
			</a>
			<a href="<?php echo esc_url( $pinterest_url ); ?>" target="_blank" rel="noopener noreferrer" class="share-btn share-pinterest" title="<?php esc_attr_e( 'Share on Pinterest', 'archie-rombo' ); ?>">
				<i class="fa-brands fa-pinterest-p"></i>
				<span class="share-text"><?php esc_html_e( 'Pinterest', 'archie-rombo' ); ?></span>
			</a>
			<a href="<?php echo esc_url( $email_url ); ?>" class="share-btn share-email" title="<?php esc_attr_e( 'Share via Email', 'archie-rombo' ); ?>">
				<i class="fa-solid fa-envelope"></i>
				<span class="share-text"><?php esc_html_e( 'Email', 'archie-rombo' ); ?></span>
			</a>
		</div>
	</div>
	<?php
}

// Styling for share buttons
function archie_rombo_share_buttons_styles() {
	?>
	<style>
		.share-buttons {
			padding: 1.5rem 0;
		}
		.share-buttons-list {
			display: flex;
			flex-wrap: wrap;
			gap: 1rem;
		}
		.share-btn {
			display: inline-flex;
			align-items: center;
			gap: 0.5rem;
			padding: 0.6rem 1.2rem;
			border: 2px solid #e0e0e0;
			border-radius: 4px;
			text-decoration: none;
			color: #333;
			font-size: 0.95rem;
			font-weight: 500;
			transition: all 0.3s ease;
			background: #f8f9fa;
		}
		.share-btn:hover {
			color: white;
			text-decoration: none;
		}
		.share-btn i {
			font-size: 1.2rem;
		}
		.share-facebook {
			border-color: #1877f2;
			color: #1877f2;
		}
		.share-facebook:hover {
			background: #1877f2;
		}
		.share-twitter {
			border-color: #1da1f2;
			color: #1da1f2;
		}
		.share-twitter:hover {
			background: #1da1f2;
		}
		.share-linkedin {
			border-color: #0a66c2;
			color: #0a66c2;
		}
		.share-linkedin:hover {
			background: #0a66c2;
		}
		.share-whatsapp {
			border-color: #25d366;
			color: #25d366;
		}
		.share-whatsapp:hover {
			background: #25d366;
		}
		.share-pinterest {
			border-color: #e60023;
			color: #e60023;
		}
		.share-pinterest:hover {
			background: #e60023;
		}
		.share-email {
			border-color: var(--primary-color);
			color: var(--primary-color);
		}
		.share-email:hover {
			background: var(--primary-color);
		}
		@media (max-width: 768px) {
			.share-btn {
				padding: 0.5rem 0.8rem;
				font-size: 0.85rem;
			}
			.share-btn i {
				font-size: 1rem;
			}
			.share-text {
				display: none;
			}
		}
	</style>
	<?php
}
add_action( 'wp_head', 'archie_rombo_share_buttons_styles' );


/**
 * Advanced Customizer Settings
 * Add more control options to the WordPress Customizer
 * 
 * @since 1.0.1
 */
function archie_rombo_advanced_customizer( $wp_customize ) {
	
	// Section: Additional Theme Options
	$wp_customize->add_section( 'archie_rombo_advanced_section', array(
		'title'       => __( 'Archie Rombo - Advanced Options', 'archie-rombo' ),
		'description' => __( 'Advanced customization options for Archie Rombo theme', 'archie-rombo' ),
		'priority'    => 30,
	) );

	// Setting: Enable/Disable Breadcrumbs
	$wp_customize->add_setting( 'archie_rombo_enable_breadcrumbs', array(
		'default'           => 1,
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 'archie_rombo_enable_breadcrumbs', array(
		'label'       => __( 'Enable Breadcrumb Navigation', 'archie-rombo' ),
		'section'     => 'archie_rombo_advanced_section',
		'type'        => 'checkbox',
	) );

	// Setting: Enable/Disable Related Posts
	$wp_customize->add_setting( 'archie_rombo_enable_related_posts', array(
		'default'           => 1,
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 'archie_rombo_enable_related_posts', array(
		'label'       => __( 'Enable Related Posts', 'archie-rombo' ),
		'section'     => 'archie_rombo_advanced_section',
		'type'        => 'checkbox',
	) );

	// Setting: Enable/Disable Share Buttons
	$wp_customize->add_setting( 'archie_rombo_enable_share_buttons', array(
		'default'           => 1,
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 'archie_rombo_enable_share_buttons', array(
		'label'       => __( 'Enable Social Share Buttons', 'archie-rombo' ),
		'section'     => 'archie_rombo_advanced_section',
		'type'        => 'checkbox',
	) );

	// Setting: Number of Related Posts
	$wp_customize->add_setting( 'archie_rombo_related_posts_count', array(
		'default'           => 3,
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 'archie_rombo_related_posts_count', array(
		'label'       => __( 'Number of Related Posts to Display', 'archie-rombo' ),
		'section'     => 'archie_rombo_advanced_section',
		'type'        => 'number',
		'input_attrs' => array(
			'min'  => 1,
			'max'  => 12,
			'step' => 1,
		),
	) );

	// Setting: Enable/Disable Reading Time
	$wp_customize->add_setting( 'archie_rombo_enable_reading_time', array(
		'default'           => 1,
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 'archie_rombo_enable_reading_time', array(
		'label'       => __( 'Enable Reading Time Estimate', 'archie-rombo' ),
		'section'     => 'archie_rombo_advanced_section',
		'type'        => 'checkbox',
	) );

	// Setting: Enable/Disable Structured Data
	$wp_customize->add_setting( 'archie_rombo_enable_structured_data', array(
		'default'           => 1,
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 'archie_rombo_enable_structured_data', array(
		'label'       => __( 'Enable Structured Data Markup', 'archie-rombo' ),
		'section'     => 'archie_rombo_advanced_section',
		'type'        => 'checkbox',
	) );

	// Setting: Words Per Minute for Reading Time
	$wp_customize->add_setting( 'archie_rombo_reading_speed', array(
		'default'           => 200,
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 'archie_rombo_reading_speed', array(
		'label'       => __( 'Average Reading Speed (words per minute)', 'archie-rombo' ),
		'section'     => 'archie_rombo_advanced_section',
		'type'        => 'number',
		'input_attrs' => array(
			'min'  => 100,
			'max'  => 400,
			'step' => 10,
		),
	) );

	// Section: Color & Typography
	$wp_customize->add_section( 'archie_rombo_colors_section', array(
		'title'       => __( 'Archie Rombo - Colors', 'archie-rombo' ),
		'priority'    => 31,
	) );

	// Setting: Link Hover Color
	$wp_customize->add_setting( 'archie_rombo_link_hover_color', array(
		'default'           => '#ff6b6b',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archie_rombo_link_hover_color', array(
		'label'   => __( 'Link Hover Color', 'archie-rombo' ),
		'section' => 'archie_rombo_colors_section',
	) ) );

	// Setting: Button Hover Color
	$wp_customize->add_setting( 'archie_rombo_button_hover_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archie_rombo_button_hover_color', array(
		'label'   => __( 'Button Hover Color (Leave blank for auto-dark)', 'archie-rombo' ),
		'section' => 'archie_rombo_colors_section',
	) ) );

	// Section: Footer Settings
	$wp_customize->add_section( 'archie_rombo_footer_section', array(
		'title'       => __( 'Archie Rombo - Footer', 'archie-rombo' ),
		'priority'    => 32,
	) );

	// Setting: Footer Background Color
	$wp_customize->add_setting( 'archie_rombo_footer_bg_color', array(
		'default'           => '#f8f9fa',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archie_rombo_footer_bg_color', array(
		'label'   => __( 'Footer Background Color', 'archie-rombo' ),
		'section' => 'archie_rombo_footer_section',
	) ) );

	// Setting: Footer Text Color
	$wp_customize->add_setting( 'archie_rombo_footer_text_color', array(
		'default'           => '#333333',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'archie_rombo_footer_text_color', array(
		'label'   => __( 'Footer Text Color', 'archie-rombo' ),
		'section' => 'archie_rombo_footer_section',
	) ) );

	// Setting: Copyright Text
	$wp_customize->add_setting( 'archie_rombo_custom_copyright', array(
		'default'           => '',
		'sanitize_callback' => 'wp_kses_post',
	) );
	$wp_customize->add_control( 'archie_rombo_custom_copyright', array(
		'label'       => __( 'Custom Copyright Text', 'archie-rombo' ),
		'section'     => 'archie_rombo_footer_section',
		'type'        => 'textarea',
		'description' => __( 'Leave blank to use default copyright text', 'archie-rombo' ),
	) );

}
add_action( 'customize_register', 'archie_rombo_advanced_customizer' );

// Apply customizer colors to frontend
function archie_rombo_apply_customizer_colors() {
	$link_hover_color = get_theme_mod( 'archie_rombo_link_hover_color', '#ff6b6b' );
	$button_hover_color = get_theme_mod( 'archie_rombo_button_hover_color', '' );
	$footer_bg_color = get_theme_mod( 'archie_rombo_footer_bg_color', '#f8f9fa' );
	$footer_text_color = get_theme_mod( 'archie_rombo_footer_text_color', '#333333' );

	// Auto-darken button hover if not set
	if ( empty( $button_hover_color ) ) {
		$button_hover_color = $link_hover_color;
	}

	?>
	<style>
		a:hover {
			color: <?php echo esc_attr( $link_hover_color ); ?> !important;
		}
		.btn:hover, button:hover, input[type="button"]:hover, input[type="submit"]:hover {
			background-color: <?php echo esc_attr( $button_hover_color ); ?> !important;
			border-color: <?php echo esc_attr( $button_hover_color ); ?> !important;
		}
		footer {
			background-color: <?php echo esc_attr( $footer_bg_color ); ?>;
			color: <?php echo esc_attr( $footer_text_color ); ?>;
		}
		footer a {
			color: <?php echo esc_attr( $link_hover_color ); ?>;
		}
	</style>
	<?php
}
add_action( 'wp_head', 'archie_rombo_apply_customizer_colors' );


/**
 * Reading Time Estimate
 * Calculate and display estimated reading time for posts
 * 
 * @since 1.0.1
 */
function archie_rombo_get_reading_time() {
	// Check if reading time is enabled
	if ( ! get_theme_mod( 'archie_rombo_enable_reading_time', 1 ) ) {
		return '';
	}

	if ( ! is_single() || get_post_type() !== 'post' ) {
		return '';
	}

	// Get the post content
	$post_content = get_the_content();
	
	// Strip HTML tags and shortcodes
	$post_content = strip_shortcodes( $post_content );
	$post_content = wp_strip_all_tags( $post_content );
	
	// Count words
	$word_count = str_word_count( $post_content );
	
	// Get reading speed from customizer
	$reading_speed = get_theme_mod( 'archie_rombo_reading_speed', 200 );
	
	// Calculate reading time in minutes
	$reading_time = ceil( $word_count / $reading_speed );
	
	// Ensure minimum of 1 minute
	$reading_time = max( 1, $reading_time );
	
	return array(
		'time'     => $reading_time,
		'words'    => $word_count,
		'text'     => sprintf(
			/* translators: %d is the number of minutes */
			_n( '%d min read', '%d min read', $reading_time, 'archie-rombo' ),
			$reading_time
		)
	);
}

function archie_rombo_display_reading_time() {
	$reading_info = archie_rombo_get_reading_time();
	
	if ( empty( $reading_info ) ) {
		return;
	}

	?>
	<div class="reading-time">
		<i class="fa-solid fa-clock"></i>
		<span><?php echo esc_html( $reading_info['text'] ); ?></span>
	</div>
	<?php
}

// Styling for reading time
function archie_rombo_reading_time_styles() {
	?>
	<style>
		.reading-time {
			display: inline-flex;
			align-items: center;
			gap: 0.5rem;
			padding: 0.5rem 1rem;
			background: #f0f4f8;
			border-radius: 4px;
			color: #555;
			font-size: 0.9rem;
			margin-right: 1rem;
		}
		.reading-time i {
			color: var(--primary-color);
		}
		.post-meta .reading-time {
			margin-right: 1rem;
			margin-bottom: 0.5rem;
		}
	</style>
	<?php
}
add_action( 'wp_head', 'archie_rombo_reading_time_styles' );


