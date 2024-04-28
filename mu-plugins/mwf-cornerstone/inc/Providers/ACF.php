<?php
/**
 * Kadence provider
 *
 * PHP Version 8.0.28
 *
 * @package mwf_cornerstone
 * @author  Mid-West Family <digital@midwestfamilymadison.com>
 * @license GPL-2.0+ <http://www.gnu.org/licenses/gpl-2.0.txt>
 * @link    https://www.midwestfamilymadison.com
 * @since   1.0.0
 */

namespace Mwf\Cornerstone\Providers;

use Mwf\Cornerstone\Deps\Devkit\WPCore,
	Mwf\Cornerstone\Deps\Devkit\WPCore\DI\OnMount;

use Mwf\Cornerstone\Deps\DI\Attribute\Inject;

/**
 * Class for interacting with kadence directly
 *
 * @subpackage Providers
 */
class ACF extends WPCore\Abstracts\Mountable implements WPCore\Interfaces\Handlers\Directory
{
	use WPCore\Traits\Handlers\Directory;

	/**
	 * Set the base directory
	 *
	 * Can include an additional string, to make it relative to a different file
	 *
	 * @param string $root_dir : root path of the plugin.
	 * @param string $asset_dir : path to the assets dir.
	 *
	 * @return void
	 */
	#[Inject]
	public function setDir(
		#[Inject( 'config.dir' )] string $root_dir,
		#[Inject( 'config.assets.dir' )] string $asset_dir = ''
	): void {
		$this->dir = $this->appendDir( $root_dir, $asset_dir );
	}
	/**
	 * Set the path to save local json files from acf
	 *
	 * @param string $path : path to save acf json files.
	 *
	 * @return string
	 */
	public function savePaths( string $path ): string
	{
		return is_dir( $this->dir( 'acf' ) ) ? $this->dir( 'acf' ) : $path;
	}
	/**
	 * Add our path to the acf loader paths.
	 *
	 * @param array<string> $paths : where to search for local json files.
	 *
	 * @return array<string>
	 */
	public function loadPaths( array $paths ): array
	{
		if ( is_dir( $this->dir( 'acf' ) ) ) {
			$paths[] = $this->dir( 'acf' );
		}
		return $paths;
	}
}
