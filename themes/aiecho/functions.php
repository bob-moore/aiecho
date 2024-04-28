<?php
/**
 * Theme bootstrap file
 *
 * PHP Version 8.0.28
 *
 * @package THEME_SLUG
 * @author  AUTHOR_NAME <AUTHOR_EMAIL>
 * @license GPL-2.0+ <http://www.gnu.org/licenses/gpl-2.0.txt>
 * @link    THEME_URI
 * @since   1.0.0
 */

namespace Mwf\ChildTheme;

defined( 'ABSPATH' ) || exit;
/**
 * Composer auto loader
 * 
 * @see https://getcomposer.org/doc/01-basic-usage.md#autoloading
 */
require_once trailingslashit( get_stylesheet_directory() ) . 'vendor/scoped/autoload.php';
require_once trailingslashit( get_stylesheet_directory() ) . 'vendor/scoped/scoper-autoload.php';
require_once trailingslashit( get_stylesheet_directory() ) . 'vendor/autoload.php';

/**
 * Kickoff the theme operation
 */
Main::mount( [
    'package' => 'aiecho',
    'type'    => 'child-theme',
    'dir'     => get_stylesheet_directory(),
    'url'     => get_stylesheet_directory_uri(),
    'assets'  => [ 'dir' => 'build' ],
    'views'   => [ 'dir' => 'views' ]
] );
add_theme_support( 'block-template-parts' );