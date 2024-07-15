<?php
/**
 * Theme functions and definitions
 *
 * @package HelloElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'HELLO_ELEMENTOR_VERSION', '3.0.1' );

if ( ! isset( $content_width ) ) {
	$content_width = 800; // Pixels.
}

if ( ! function_exists( 'hello_elementor_setup' ) ) {
	/**
	 * Set up theme support.
	 *
	 * @return void
	 */
	function hello_elementor_setup() {
		if ( is_admin() ) {
			hello_maybe_update_theme_version_in_db();
		}

		if ( apply_filters( 'hello_elementor_register_menus', true ) ) {
			register_nav_menus( [ 'menu-1' => esc_html__( 'Header', 'hello-elementor' ) ] );
			register_nav_menus( [ 'menu-2' => esc_html__( 'Footer', 'hello-elementor' ) ] );
		}

		if ( apply_filters( 'hello_elementor_post_type_support', true ) ) {
			add_post_type_support( 'page', 'excerpt' );
		}

		if ( apply_filters( 'hello_elementor_add_theme_support', true ) ) {
			add_theme_support( 'post-thumbnails' );
			add_theme_support( 'automatic-feed-links' );
			add_theme_support( 'title-tag' );
			add_theme_support(
				'html5',
				[
					'search-form',
					'comment-form',
					'comment-list',
					'gallery',
					'caption',
					'script',
					'style',
				]
			);
			add_theme_support(
				'custom-logo',
				[
					'height'      => 100,
					'width'       => 350,
					'flex-height' => true,
					'flex-width'  => true,
				]
			);

			/*
			 * Editor Style.
			 */
			add_editor_style( 'classic-editor.css' );

			/*
			 * Gutenberg wide images.
			 */
			add_theme_support( 'align-wide' );

			/*
			 * WooCommerce.
			 */
			if ( apply_filters( 'hello_elementor_add_woocommerce_support', true ) ) {
				// WooCommerce in general.
				add_theme_support( 'woocommerce' );
				// Enabling WooCommerce product gallery features (are off by default since WC 3.0.0).
				// zoom.
				add_theme_support( 'wc-product-gallery-zoom' );
				// lightbox.
				add_theme_support( 'wc-product-gallery-lightbox' );
				// swipe.
				add_theme_support( 'wc-product-gallery-slider' );
			}
		}
	}
}
add_action( 'after_setup_theme', 'hello_elementor_setup' );

function hello_maybe_update_theme_version_in_db() {
	$theme_version_option_name = 'hello_theme_version';
	// The theme version saved in the database.
	$hello_theme_db_version = get_option( $theme_version_option_name );

	// If the 'hello_theme_version' option does not exist in the DB, or the version needs to be updated, do the update.
	if ( ! $hello_theme_db_version || version_compare( $hello_theme_db_version, HELLO_ELEMENTOR_VERSION, '<' ) ) {
		update_option( $theme_version_option_name, HELLO_ELEMENTOR_VERSION );
	}
}

if ( ! function_exists( 'hello_elementor_display_header_footer' ) ) {
	/**
	 * Check whether to display header footer.
	 *
	 * @return bool
	 */
	function hello_elementor_display_header_footer() {
		$hello_elementor_header_footer = true;

		return apply_filters( 'hello_elementor_header_footer', $hello_elementor_header_footer );
	}
}

if ( ! function_exists( 'hello_elementor_scripts_styles' ) ) {
	/**
	 * Theme Scripts & Styles.
	 *
	 * @return void
	 */
	function hello_elementor_scripts_styles() {
		$min_suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		if ( apply_filters( 'hello_elementor_enqueue_style', true ) ) {
			wp_enqueue_style(
				'hello-elementor',
				get_template_directory_uri() . '/style' . $min_suffix . '.css',
				[],
				HELLO_ELEMENTOR_VERSION
			);
		}

		if ( apply_filters( 'hello_elementor_enqueue_theme_style', true ) ) {
			wp_enqueue_style(
				'hello-elementor-theme-style',
				get_template_directory_uri() . '/theme' . $min_suffix . '.css',
				[],
				HELLO_ELEMENTOR_VERSION
			);
		}

		if ( hello_elementor_display_header_footer() ) {
			wp_enqueue_style(
				'hello-elementor-header-footer',
				get_template_directory_uri() . '/header-footer' . $min_suffix . '.css',
				[],
				HELLO_ELEMENTOR_VERSION
			);
		}
	}
}
add_action( 'wp_enqueue_scripts', 'hello_elementor_scripts_styles' );

if ( ! function_exists( 'hello_elementor_register_elementor_locations' ) ) {
	/**
	 * Register Elementor Locations.
	 *
	 * @param ElementorPro\Modules\ThemeBuilder\Classes\Locations_Manager $elementor_theme_manager theme manager.
	 *
	 * @return void
	 */
	function hello_elementor_register_elementor_locations( $elementor_theme_manager ) {
		if ( apply_filters( 'hello_elementor_register_elementor_locations', true ) ) {
			$elementor_theme_manager->register_all_core_location();
		}
	}
}
add_action( 'elementor/theme/register_locations', 'hello_elementor_register_elementor_locations' );

if ( ! function_exists( 'hello_elementor_content_width' ) ) {
	/**
	 * Set default content width.
	 *
	 * @return void
	 */
	function hello_elementor_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'hello_elementor_content_width', 800 );
	}
}
add_action( 'after_setup_theme', 'hello_elementor_content_width', 0 );

if ( ! function_exists( 'hello_elementor_add_description_meta_tag' ) ) {
	/**
	 * Add description meta tag with excerpt text.
	 *
	 * @return void
	 */
	function hello_elementor_add_description_meta_tag() {
		if ( ! apply_filters( 'hello_elementor_description_meta_tag', true ) ) {
			return;
		}

		if ( ! is_singular() ) {
			return;
		}

		$post = get_queried_object();
		if ( empty( $post->post_excerpt ) ) {
			return;
		}

		echo '<meta name="description" content="' . esc_attr( wp_strip_all_tags( $post->post_excerpt ) ) . '">' . "\n";
	}
}
add_action( 'wp_head', 'hello_elementor_add_description_meta_tag' );

// Admin notice
if ( is_admin() ) {
	require get_template_directory() . '/includes/admin-functions.php';
}

// Settings page
require get_template_directory() . '/includes/settings-functions.php';

// Header & footer styling option, inside Elementor
require get_template_directory() . '/includes/elementor-functions.php';

if ( ! function_exists( 'hello_elementor_customizer' ) ) {
	// Customizer controls
	function hello_elementor_customizer() {
		if ( ! is_customize_preview() ) {
			return;
		}

		if ( ! hello_elementor_display_header_footer() ) {
			return;
		}

		require get_template_directory() . '/includes/customizer-functions.php';
	}
}
add_action( 'init', 'hello_elementor_customizer' );

if ( ! function_exists( 'hello_elementor_check_hide_title' ) ) {
	/**
	 * Check whether to display the page title.
	 *
	 * @param bool $val default value.
	 *
	 * @return bool
	 */
	function hello_elementor_check_hide_title( $val ) {
		if ( defined( 'ELEMENTOR_VERSION' ) ) {
			$current_doc = Elementor\Plugin::instance()->documents->get( get_the_ID() );
			if ( $current_doc && 'yes' === $current_doc->get_settings( 'hide_title' ) ) {
				$val = false;
			}
		}
		return $val;
	}
}
add_filter( 'hello_elementor_page_title', 'hello_elementor_check_hide_title' );

/**
 * BC:
 * In v2.7.0 the theme removed the `hello_elementor_body_open()` from `header.php` replacing it with `wp_body_open()`.
 * The following code prevents fatal errors in child themes that still use this function.
 */
if ( ! function_exists( 'hello_elementor_body_open' ) ) {
	function hello_elementor_body_open() {
		wp_body_open();
	}
}

// For Services
function create_services_post_type() {
    register_post_type( 'services',
        array(
            'labels' => array(
                'name' => __( 'Services' ),
                'singular_name' => __( 'Service' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'services'),
            'supports' => array( 'title', 'editor', 'thumbnail' )
        )
    );
}
add_action( 'init', 'create_services_post_type' );
function display_services_shortcode() {
    $args = array(
        'post_type' => 'services',
        'posts_per_page' => -1
    );
    $services_query = new WP_Query( $args );
    if ( $services_query->have_posts() ) {
        $output = '<div class="services">';
        while ( $services_query->have_posts() ) {
            $services_query->the_post();
            $output .= '<div class="service">';
            $output .= '<a href="' . get_permalink() . '">' . get_the_post_thumbnail() . '</a>';
            $output .= '<h2><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';
          
            $output .= '</div>';
        }
        $output .= '</div>';
        wp_reset_postdata();
        return $output;
    } else {
        return '<p>No services found</p>';
    }
}
add_shortcode( 'display_services', 'display_services_shortcode' );

// For Our Team 
// Register Teams Custom Post Type
// function create_teams_post_type() {
//     register_post_type( 'teams',
//         array(
//             'labels' => array(
//                 'name' => __( 'Teams' ),
//                 'singular_name' => __( 'Team' )
//             ),
//             'public' => true,
//             'has_archive' => true,
//             'rewrite' => array('slug' => 'teams'),
//             'supports' => array( 'title', 'editor', 'thumbnail' )
//         )
//     );
// }
// add_action( 'init', 'create_teams_post_type' );

// // Display Teams Shortcode
// function display_teams_shortcode() {
//     $args = array(
//         'post_type' => 'teams',
//         'posts_per_page' => -1
//     );
//     $teams_query = new WP_Query( $args );
//     if ( $teams_query->have_posts() ) {
//         $output = '<div class="teams">';
//         while ( $teams_query->have_posts() ) {
//             $teams_query->the_post();
//             $output .= '<div class="team">';
//             $output .= '<a href="' . get_permalink() . '">' . get_the_post_thumbnail() . '</a>';
//             $output .= '<h2><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';
//             $output .= '<div class="description">' . get_the_content() . '</div>';
//             $output .= '</div>';
//         }
//         $output .= '</div>';
//         wp_reset_postdata();
//         return $output;
//     } else {
//         return '<p>No teams found</p>';
//     }
// }
// add_shortcode( 'display_teams', 'display_teams_shortcode' );

// Register Teams Custom Post Type
function create_teams_post_type() {
    register_post_type( 'teams',
        array(
            'labels' => array(
                'name' => __( 'Teams' ),
                'singular_name' => __( 'Team' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'teams'),
            'supports' => array( 'title', 'editor', 'thumbnail' )
        )
    );
    
    // Add meta box for designation field
    add_action( 'add_meta_boxes', 'teams_designation_meta_box' );
    function teams_designation_meta_box() {
        add_meta_box(
            'teams_designation_meta_box',
            'Designation',
            'teams_designation_meta_box_callback',
            'teams',
            'normal',
            'default'
        );
    }

    function teams_designation_meta_box_callback( $post ) {
        $value = get_post_meta( $post->ID, '_designation', true );
        echo '<label for="teams_designation_field">Designation</label>';
        echo '<input type="text" id="teams_designation_field" name="teams_designation_field" value="' . esc_attr( $value ) . '" />';
    }

    add_action( 'save_post', 'save_teams_designation_meta_box_data' );
    function save_teams_designation_meta_box_data( $post_id ) {
        if ( ! isset( $_POST['teams_designation_field'] ) ) {
            return;
        }
        $meta_value = sanitize_text_field( $_POST['teams_designation_field'] );
        update_post_meta( $post_id, '_designation', $meta_value );
    }
}
add_action( 'init', 'create_teams_post_type' );

function display_teams_shortcode() {
    $args = array(
        'post_type' => 'teams',
        'posts_per_page' => -1
    );
    $teams_query = new WP_Query( $args );
    if ( $teams_query->have_posts() ) {
        $output = '<div class="teams">';
        while ( $teams_query->have_posts() ) {
            $teams_query->the_post();
            $designation = get_post_meta( get_the_ID(), '_designation', true );
            $output .= '<div class="team">';
            $output .= '<a href="' . get_permalink() . '">' . get_the_post_thumbnail() . '</a>';
            $output .= '<h2><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';
            // Check if it's the specific post ID you want to show the description for
            if (get_the_ID() == 699) { // Replace 123 with your specific post ID
                $output .= '<div class="description">' . get_the_content() . '</div>';
            }
            $output .= '<p>' . esc_html( $designation ) . '</p>';
            $output .= '</div>';
        }
        $output .= '</div>';
        wp_reset_postdata();
        return $output;
    } else {
        return '<p>No teams found</p>';
    }
}
add_shortcode( 'display_teams', 'display_teams_shortcode' );


