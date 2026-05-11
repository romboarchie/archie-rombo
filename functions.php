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
}
add_action( 'init', 'archie_rombo_register_block_patterns' );




