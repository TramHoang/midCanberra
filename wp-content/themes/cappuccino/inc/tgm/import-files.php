<?php
/**
 * Import dummy Content
 *
 *
 * @link https://github.com/thomasgriffin/TGM-Plugin-Activation
 * @package cappuccino
 */
 function cappuccino_import_files() {
  return array(
      array(
        'import_file_name'             => esc_html__('Cappuccino Demo','cappuccino'),
        'local_import_file'            => trailingslashit( get_stylesheet_directory() ) . 'inc/tgm/dummy/cappuccino.wordpress.xml',
        'local_import_widget_file'     => trailingslashit( get_stylesheet_directory() ) . 'inc/tgm/dummy/cappuccino-widgets.wie',
        'local_import_customizer_file' => trailingslashit( get_stylesheet_directory() ) . 'inc/tgm/dummy/cappuccino-export.dat',
        'import_notice'                => __( 'Recommended Plugins: Jetpack, Instagram Feed and Contact Form 7 Plugins  to look exactly as in our demo. <br> <br> Thanks for being part of us. If you really like our theme, Please help us <a href="https://wordpress.org/support/theme/cappuccino/reviews/" target="_blank" rel="nofollow">rating</a> our theme.
        ', 'cappuccino' ),
      ),
    );
  }

add_filter( 'pt-ocdi/import_files', 'cappuccino_import_files' );

function cappuccino_after_import_setup($selected_import) {
  if ( 'Default Demo Content' === $selected_import['import_file_name'] ) {
    // Assign menus to their locations.
    $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
    $side_menu = get_term_by( 'name', 'side Menu', 'nav_menu' );
    $social_link = get_term_by( 'name', 'Add Social Icons Only', 'nav_menu' );

    set_theme_mod( 'nav_menu_locations', array(
        'primary' => $main_menu->term_id,
        'side-nav-menu' => $side_menu->term_id,
        'social-link' => $social_link->term_id,
      )
    );
  }

}
add_action( 'pt-ocdi/after_import', 'cappuccino_after_import_setup' );