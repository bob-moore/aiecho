<?php
/**
 * Handler Controller
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

use Mwf\Cornerstone\Deps\Devkit\WPCore,
	Mwf\Cornerstone\Deps\DI\Attribute\Inject;

/**
 * Controls the registration and execution of services
 *
 * @subpackage Controllers
 */
class Blocks extends WPCore\Abstracts\Mountable
{
	use WPCore\Traits\Handlers\Directory;

	/**
	 * Collection of blocks to register
	 *
	 * @var array<string, string>
	 */
	protected const BLOCKS = [
		'link-block/block.json',
	];
	/**
	 * Set the base directory - relative to the main plugin file
	 *
	 * Can include an additional string, to make it relative to a different file
	 *
	 * @param string $app_dir : the root directory path.
	 * @param string $blocks_dir : additional string to append to the directory path.
	 *
	 * @return void
	 */
	#[Inject]
	public function setDir( 
		#[Inject( 'config.dir' )] string $app_dir, 
		#[Inject( 'config.blocks.dir' )] string $blocks_dir = '' ): void
	{
		$this->dir = $this->appendDir( $app_dir, $blocks_dir );
	}
	/**
	 * Blocks setter
	 *
	 * @param string ...$blocks : paths to block.json file(s).
	 *
	 * @return void
	 */
	public function setBlocks( string ...$blocks ): void
	{
		$this->blocks = array_merge( $this->blocks, $blocks );
	}
	/**
	 * Blocks getter
	 *
	 * @return array<string, string>
	 */
	public function getBlocks(): array
	{
		return apply_filters( "{$this->package}_blocks", 
			array_map( fn( $block ) => $this->dir( $block ), self::BLOCKS )
		);
	}
	/**
	 * Register custom blocks
	 *
	 * @see https://developer.wordpress.org/reference/functions/register_block_type/
	 *
	 * @return void
	 */
	public function registerBlocks(): void
	{
		
		foreach ( $this->getBlocks() as $block_file ) {
			if ( is_string( $block_file ) && is_file( $block_file ) ) {
				register_block_type( $block_file );
			}
		}
	}
}
