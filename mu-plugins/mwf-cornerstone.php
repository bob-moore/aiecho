<?php
/**
 * Plugin bootstrap file
 *
 * PHP Version 8.0.28
 *
 * @package mwf_cornerstone
 * @author  Mid-West Family <digital@midwestfamilymadison.com>
 * @license GPL-2.0+ <http://www.gnu.org/licenses/gpl-2.0.txt>
 * @link    https://www.midwestfamilymadison.com
 * @since   1.0.0
 *
 * @wordpress-plugin
 * Plugin Name: Mid-West Family Cornerstone
 * Plugin URI:  https://www.midwestfamilymadison.com
 * Description: Custom MU-Plugin for MWF Sites
 * Version:     1.0.0
 * Author:      Mid-West Family
 * Author URI:  https://www.midwestfamilymadison.com
 * Requires at least: 6.0
 * Tested up to: 6.3
 * Requires PHP: 8.0.28
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: mwf_cornerstone
 */

namespace Mwf\Cornerstone;

defined( 'ABSPATH' ) || exit;

require_once trailingslashit( plugin_dir_path( __FILE__ ) ) . 'mwf-cornerstone/vendor/scoped/autoload.php';
require_once trailingslashit( plugin_dir_path( __FILE__ ) ) . 'mwf-cornerstone/vendor/scoped/scoper-autoload.php';
require_once trailingslashit( plugin_dir_path( __FILE__ ) ) . 'mwf-cornerstone/vendor/autoload.php';

Main::mount( [
    'package' => 'mwf_cornerstone',
    'dir'     => trailingslashit( plugin_dir_path( __FILE__ ) ) . 'mwf-cornerstone',
    'url'     => trailingslashit( plugin_dir_url( __FILE__ ) ) . 'mwf-cornerstone',
    'assets'  => [ 'dir' => 'build/assets' ],
    'blocks'  => [ 'dir' => 'build/blocks' ],
    'views'   => [ 'dir' => 'views' ]
] );