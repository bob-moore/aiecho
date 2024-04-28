<?php
/**
 * Entities Controller
 *
 * PHP Version 8.0.28
 *
 * @package mwf_cornerstone
 * @author  Mid-West Family <digital@midwestfamilymadison.com>
 * @license GPL-2.0+ <http://www.gnu.org/licenses/gpl-2.0.txt>
 * @link    https://www.midwestfamilymadison.com
 * @since   1.0.0
 */

namespace Mwf\Cornerstone\Controllers;

use Mwf\Cornerstone\Entities as Entity;

use Mwf\Cornerstone\Deps\Devkit\WPCore,
	Mwf\Cornerstone\Deps\Devkit\WPCore\DI\ContainerBuilder;

/**
 * Entities controller class
 *
 * Controls and orchestrates the execution of entities (post types, taxonomies, etc).
 *
 * @subpackage Controllers
 */
class Entities extends WPCore\Abstracts\Mountable implements WPCore\Interfaces\Controller
{
	/**
	 * Get definitions that should be added to the service container
	 *
	 * @return array<string, mixed>
	 */
	public static function getServiceDefinitions(): array
	{
		return [
			Entity\PageCategory::class => ContainerBuilder::autowire(),
			Entity\PageTag::class      => ContainerBuilder::autowire(),
		];
	}
}
