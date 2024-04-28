<?php
/**
 * Dashboard Handler
 *
 * PHP Version 8.0.28
 *
 * @package mwf_cornerstone
 * @author  Mid-West Family <digital@midwestfamilymadison.com>
 * @license GPL-2.0+ <http://www.gnu.org/licenses/gpl-2.0.txt>
 * @link    https://www.midwestfamilymadison.com
 * @since   1.0.0
 */

namespace Mwf\Cornerstone\Handlers;

use Mwf\Cornerstone\Deps\Devkit\WPCore;

/**
 * Modify the dashboard
 *
 * @subpackage Controllers
 */
class Dashboard extends WPCore\Abstracts\Mountable
{
    /**
	 * Reorder admin sidebar items
	 *
	 * @param  array<string> $menu_items : Array of menu items.
	 * @return array<string> reordered array of menu items.
	 */
	public function reorderAdminMenu( array $menu_items ): array
	{
		$menu = [
			'top' => [],
			'posts' => [],
			'secondary' => [],
			'woocommerce' => [],
			'elementor' => [],
			'bottom' => [],
			'last' => [],
		];
        
        $priority_posts = [
            'edit.php',
            'edit.php?post_type=page',
            'nestedpages',
            'upload.php',
            'edit-comments.php',
			'gf_edit_forms',
        ];

        foreach ( $priority_posts as $post_item ) {
            if ( in_array( $post_item , $menu_items ) ) {
                $menu['posts'][] = $post_item ;
                unset( $menu_items[array_search( $post_item , $menu_items )] );
            }
        }
		foreach ( $menu_items as $menu_item ) {
			switch ( true ) {
				case in_array(
					$menu_item,
					[
						'jetpack',
						'genesis',
						'edit.php?post_type=fl-builder-template',
						'edit.php?post_type=acf-field-group',
						'googlesitekit-dashboard',
						'yith_plugin_panel',
                        'spectra',
                        'instantcss',
                        'astra'
					],
					true
				):
					$menu['last'][] = $menu_item;
					break;
				case in_array(
					$menu_item,
					[
						'edit.php?post_type=product',
						'woocommerce',
						'wc-admin&path=/analytics/revenue',
						'woocommerce-marketing',
						'wc-admin&path=/analytics/overview',
						'kadence-shop-kit-settings',
					],
					true,
				):
					$menu['woocommerce'][] = $menu_item;
					break;
				case 'separator-woocommerce' === $menu_item:
					array_unshift( $menu['woocommerce'], $menu_item );
					break;
				case in_array(
					$menu_item,
					[
						'index.php',
						'separator1',
						'video-user-manuals/plugin.php',
					],
					true
				):
					$menu['top'][] = $menu_item;
					break;
				case in_array(
					$menu_item,
					[
						'edit.php?post_type=elementor_library',
						'separator-elementor',
						'elementor',
					],
					true,
				):
					$menu['elementor'][] = $menu_item;
					break;
				case str_contains( $menu_item, 'edit.php' )
                    || str_contains( $menu_item, 'upload.php' )
                    || str_contains( $menu_item, 'edit-comments.php' )
                    || str_contains( $menu_item, 'nestedpages' ):
                    $menu['posts'][] = $menu_item;
                    break;
				case in_array(
					$menu_item,
					[
						'upload.php',
						'gf_edit_forms',
						'edit-comments.php',
					],
					true
				):
					$menu['bottom'][] = $menu_item;
					break;
				default:
					$menu['bottom'][] = $menu_item;
					break;
			}
		}
        
		return array_reduce(
			$menu,
			function ( $combined, $current ) {
				return array_merge( $combined, $current );
			},
			[]
		);
	}
    /**
	 * Rename admin sidebar items
	 *
	 * Rename "posts" to "blog"
     * 
     * Ignore phpcs errors because we're modifying global variables. There is no
     * way to do this without modifying global variables.
	 *
	 * @return void
	 */
	public function renameMenuItems(): void
	{
		global $menu; // phpcs:ignoreFile
		global $submenu; // phpcs:ignoreFile

		$menu[5][0]                 = 'Blog';
		$submenu['edit.php'][5][0]  = 'Blog Posts';
		$submenu['edit.php'][10][0] = 'Add Blog Post';
	}
}
