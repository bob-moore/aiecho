<?php
/**
 * Menus handler
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
 * Controls the functions related to Menus
 *
 * @subpackage Handlers
 */
class Menus extends WPCore\Abstracts\Mountable
{
	/**
	 * Array of nav menus
	 *
	 * @var array<string, mixed>
	 */
	protected array $menus = [];
}
