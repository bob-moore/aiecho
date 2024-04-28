<?php
/**
 * Kadence provider
 *
 * PHP Version 8.0.28
 *
 * @package THEME_SLUG
 * @author  AUTHOR_NAME <AUTHOR_EMAIL>
 * @license GPL-2.0+ <http://www.gnu.org/licenses/gpl-2.0.txt>
 * @link    THEME_URI
 * @since   1.0.0
 */

namespace Mwf\ChildTheme\Providers;

use Mwf\ChildTheme\Deps\Devkit\WPCore,
	Mwf\ChildTheme\Deps\Devkit\WPCore\DI\OnMount;

/**
 * Class for interacting with kadence directly
 *
 * @subpackage Providers
 */
class Kadence extends WPCore\Abstracts\Mountable
{
	/**
	 * Add kadence stylesheets to the theme style dependencies
	 *
	 * This ensures our child theme always loads after kadence.
	 *
	 * @param array<string> $deps : array of known dependencies.
	 *
	 * @return array<string>
	 */
	public function useKadenceStyles( array $deps ): array
	{
		global $wp_styles;

		$kadence = array_filter(
			array_keys( $wp_styles->registered ),
			function ( $key ) {
				return str_contains( $key, 'kadence' );
			}
		);

		return array_merge( $deps, array_values( $kadence ) );
	}
}
