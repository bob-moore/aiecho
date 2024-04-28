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
 * Class for interacting with astra directly
 *
 * @subpackage Providers
 */
class Elements extends WPCore\Abstracts\Mountable
{
	/**
	 * Add parent theme styles as a dependency for the child theme css file
	 *
	 * @param array<string> $locations : array of existing element locations.
	 *
	 * @return array<string>
	 */
	public function locations( array $locations ): array
	{
		// 'mk_theme_before_head',
		// 'mk_theme_after_head_opening',
		// 'mk_theme_before_head_closing',
		// 'mk_theme_after_body_opening',
		// 'theme_after_body_tag_start',
		// add_to_cart_responsive
		// mk_theme_before_body_closing
		// bbp_template_before_forums_index
		// bbp_template_before_forums_index
		// bbp_template_after_forums_index
		// bbp_template_before_topics_index
		// bbp_template_before_topics_index
		// bbp_template_after_topics_index
		return $locations;
	}
}
