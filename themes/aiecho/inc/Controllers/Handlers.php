<?php
/**
 * Handler Controller
 *
 * PHP Version 8.0.28
 *
 * @package paradise_island
 * @author  Mid-West Family Madison <digital@midwestfamilymadison.com>
 * @license GPL-2.0+ <http://www.gnu.org/licenses/gpl-2.0.txt>
 * @link    https://github.com/bob-moore/Devkit-Plugin-Boilerplate
 * @since   1.0.0
 */

namespace Mwf\ChildTheme\Controllers;

use Mwf\ChildTheme\Handlers as Handler;

use Mwf\ChildTheme\Deps\Devkit\WPCore,
	Mwf\ChildTheme\Deps\Devkit\WPCore\DI\OnMount,
	Mwf\ChildTheme\Deps\Devkit\WPCore\DI\ContainerBuilder;

/**
 * Handler controller class
 *
 * Controls and orchestrates the execution of specific handlers.
 *
 * @subpackage Controllers
 */
class Handlers extends WPCore\Controllers\Handlers
{
	/**
	 * Get definitions that should be added to the service container
	 *
	 * @return array<string, mixed>
	 */
	public static function getServiceDefinitions(): array
	{
		return array_merge(
			parent::getServiceDefinitions(),
			[
				Handler\Editor::class => ContainerBuilder::autowire(),
				Handler\Images::class => ContainerBuilder::autowire(),
				Handler\Blocks::class => ContainerBuilder::autowire(),
			]
		);
	}
	/**
	 * Actions to perform when the class is loaded
	 *
	 * @param Handler\Editor $handler : instance of editor service.
	 *
	 * @return void
	 */
	#[OnMount]
	public function mountEditor( Handler\Editor $handler ): void
	{
		add_action( 'after_setup_theme', [ $handler, 'themeSupport' ] );
		add_action( 'after_setup_theme', [ $handler, 'editorStylesheet' ], 99999 );
	}
	/**
	 * Actions to work with images
	 *
	 * @param Handler\Images $handler : instance of images handler.
	 *
	 * @return void
	 */
	#[OnMount]
	public function mountIMages( Handler\Images $handler ): void
	{
		add_action( 'after_setup_theme', [ $handler, 'addImageSizes' ] );
		add_filter( 'image_size_names_choose', [ $handler, 'addImageSizeLabels' ] );
	}
	/**
	* Mount blocks handler
	*
	* @param Handler\Blocks $handler : instance of block handler.
	*
	* @return void
	*/
	#[OnMount]
	public function mountBlocks( Handler\Blocks $handler ): void
	{
		add_action( 'after_setup_theme', [ $handler, 'registerBlockStyles' ] );
		add_action( 'after_setup_theme', [ $handler, 'registerPatternCategories' ] );
	}
}
