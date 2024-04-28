<?php
/**
 * Handler Controller
 *
 * PHP Version 8.0.28
 *
 * @package mwf_cornerstone
 * @author  Mid-West Family <digital@midwestfamilymadison.com>
 * @license GPL-2.0+ <http://www.gnu.org/licenses/gpl-2.0.txt>
 * @link    https://github.com/bob-moore/Devkit-Plugin-Boilerplate
 * @since   1.0.0
 */

namespace Mwf\Cornerstone\Controllers;

use Mwf\Cornerstone\Services as Service;

use Mwf\Cornerstone\Deps\Devkit\WPCore,
	Mwf\Cornerstone\Deps\Devkit\WPCore\DI\OnMount,
	Mwf\Cornerstone\Deps\Devkit\WPCore\DI\ContainerBuilder;

/**
 * Handler controller class
 *
 * Controls and orchestrates the execution of specific handlers.
 *
 * @subpackage Controllers
 */
class Services extends WPCore\Abstracts\Mountable implements WPCore\Interfaces\Controller
{
	/**
	 * Get definitions that should be added to the service container
	 *
	 * @return array<string, mixed>
	 */
	public static function getServiceDefinitions(): array
	{
		return [];
	}
}
