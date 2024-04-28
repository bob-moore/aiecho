<?php
/**
 * Blocks Handler
 *
 * PHP Version 8.0.28
 *
 * @package THEME_SLUG
 * @author  AUTHOR_NAME <AUTHOR_EMAIL>
 * @license GPL-2.0+ <http://www.gnu.org/licenses/gpl-2.0.txt>
 * @link    THEME_URI
 * @since   1.0.0
 */

namespace Mwf\ChildTheme\Handlers;

use Mwf\ChildTheme\Deps\Devkit\WPCore;

/**
 * Add extra features for handling blocks
 *
 * @subpackage Handlers
 */
class Blocks extends WPCore\Abstracts\Mountable
{
	public function registerBlockStyles(): void
	{
		$styles = [
			'kadence/rowlayout' => [
				[
					'name'  => 'full-width-container',
					'label' => __( 'Full Container', 'textdomain' ),
				],
				[
					'name'  => 'default-width-container',
					'label' => __( 'Container', 'textdomain' ),
				],
				[
					'name'  => 'wide-width-container',
					'label' => __( 'Wide Container', 'textdomain' ),
				],
			],
			'core/separator' => [
				[
					'name'  => 'left-aligned',
					'label' => __( 'Left', 'textdomain' ),
				],
				[
					'name'  => 'right-aligned',
					'label' => __( 'Right', 'textdomain' ),
				],
				[
					'name'  => 'center-aligned',
					'label' => __( 'Center', 'textdomain' ),
				],
				[
					'name'  => 'hr',
					'label' => __( 'HR', 'textdomain' ),
				],
			],
			'kadence/column' => [
				[
					'name'  => 'material-card',
					'label' => __( 'Material Card', 'textdomain' ),
				],
				[
					'name'  => 'material-card-hover',
					'label' => __( 'Material w/ Hover', 'textdomain' ),
				],
			],
			'core/navigation' => [
				[
					'name'  => 'footer-nav',
					'label' => __( 'Footer Nav', 'textdomain' ),
				]
			]
		];

		foreach ( $styles as $block => $block_styles ) {
			foreach ( $block_styles as $style ) {
				register_block_style( $block, $style );
			}
		}
	}

	public function registerPatternCategories()
	{
		register_block_pattern_category(
			'theme',
			array( 'label' => __( 'Theme', 'wpdocs-my-plugin' ) )
		);
	}
}
