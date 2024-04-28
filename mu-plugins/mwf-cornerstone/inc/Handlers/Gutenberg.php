<?php
/**
 * Gutenberg Handler
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

use WP_Block;

/**
 * Manage Gutenberg services.
 *
 * @subpackage Handlers
 */
class Gutenberg extends WPCore\Abstracts\Mountable
{
	/**
	 * Filter block content when blocks are rendered
	 *
	 * Gives us the opportunity to compile the content with twig
	 *
	 * @param string       $content The block content.
	 * @param array<mixed> $block The full block, including name and attributes.
	 * @param WP_Block     $instance The block instance.
	 *
	 * @see https://developer.wordpress.org/reference/hooks/render_block/
	 *
	 * @return string
	 */
	public function parseBlock( string $content, array $block, WP_Block $instance ): string
	{
		$blocks_to_parse = apply_filters(
			"{$this->package}_should_handle_blocks",
			[
				'core/heading',
				'core/paragraph',
				'kadence/advancedheading',
				'kadence/singlebtn',
				'kadence/advancedbtn',
			]
		);

		if ( in_array( $instance->name, $blocks_to_parse, true ) ) {
			$content = apply_filters( "{$this->package}_compile_string", $content );
		}

		return $content;
	}
}
