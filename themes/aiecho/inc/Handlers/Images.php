<?php
/**
 * Image Handler
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
 * Adds image support.
 *
 * @subpackage Handlers
 */
class Images extends WPCore\Abstracts\Mountable
{
	/**
	 * Add custom image sizes
	 *
	 * @return void
	 */
	public function addImageSizes(): void
	{
		add_image_size( 'medium-thumbnail', 300, 300, true );
		add_image_size( 'large-thumbnail', 768, 768, true );
	}
	/**
	 * Add custom image size labels
	 *
	 * @param array<string, string> $sizes : array of image sizes.
	 *
	 * @return array<string, string>
	 */
	public function addImageSizeLabels( array $sizes ): array
	{
		$sizes['medium-thumbnail'] = __( 'Medium Thumbnail', 'astra-child' );
		$sizes['large-thumbnail']  = __( 'Large Thumbnail', 'astra-child' );

		return $sizes;
	}
}
