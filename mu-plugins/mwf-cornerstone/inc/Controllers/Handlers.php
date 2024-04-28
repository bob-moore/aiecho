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

use Mwf\Cornerstone\Handlers as Handler;

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
				Handler\Posts::class     => ContainerBuilder::autowire(),
				Handler\Terms::class     => ContainerBuilder::autowire(),
				Handler\Blocks::class    => ContainerBuilder::autowire(),
				Handler\Dashboard::class => ContainerBuilder::autowire(),
				Handler\Gutenberg::class => ContainerBuilder::autowire(),
			]
		);
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
		add_action( 'init', [ $handler, 'registerBlocks' ] );
	}
	/**
	 * Mount post handler
	 *
	 * @param Handler\Posts $handler : instance of block handler.
	 *
	 * @return void
	 */
	#[OnMount]
	public function mountPosts( Handler\Posts $handler ): void
	{
		add_action( 'init', [ $handler, 'registerPostTypes' ] );
	}
	/**
	 * Mount term/taxonomy handler
	 *
	 * @param Handler\Terms $handler : instance of block handler.
	 *
	 * @return void
	 */
	#[OnMount]
	public function mountTaxonomies( Handler\Terms $handler ): void
	{
		add_action( 'init', [ $handler, 'registerTaxonomies' ] );
	}
	/**
	 * Mound dashboard actions
	 *
	 * @param Handler\Dashboard $handler : instance of dashboard handler class.
	 *
	 * @return void
	 */
	#[OnMount]
	public function mountDashboard( Handler\Dashboard $handler ): void
	{
		add_action( 'admin_menu', [ $handler, 'renameMenuItems' ] );
		add_filter( 'menu_order', [ $handler, 'reorderAdminMenu' ], 9999999999 );
		add_filter( 'custom_menu_order', '__return_true' );
	}
	/**
	 * Mount gutenberg handler
	 *
	 * @param Handler\Gutenberg $handler : instance of gutenberg handler class.
	 *
	 * @return void
	 */
	#[OnMount]
	public function mountGutenberg( Handler\Gutenberg $handler ): void
	{
		add_filter( 'render_block', [ $handler, 'parseBlock' ], 5, 3 );
	}
}
