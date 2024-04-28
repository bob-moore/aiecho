<?php
/**
 * Main theme handler
 *
 * PHP Version 8.0.28
 *
 * @package paradise_island
 * @author  Mid-West Family Madison <digital@midwestfamilymadison.com>
 * @license GPL-2.0+ <http://www.gnu.org/licenses/gpl-2.0.txt>
 * @link    https://www.paradise-island-tanning.com/
 * @since   1.0.0
 */

namespace Mwf\ChildTheme;

use Mwf\ChildTheme\Deps\Devkit\WPCore,
	Mwf\ChildTheme\Deps\Devkit\WPCore\DI\ContainerBuilder;

/**
 * Main file
 *
 * @subpackage Main
 */
class Main extends WPCore\Main
{
	/**
	 * The optional package name.
	 *
	 * @var string
	 */
	protected const PACKAGE = 'paradise_island';
	/**
	 * Get service definitions to add to service container
	 *
	 * @return array<string, mixed>
	 */
	public static function getServiceDefinitions(): array
	{
		return [
			Controllers\Handlers::class  => ContainerBuilder::autowire(),
			Controllers\Router::class    => ContainerBuilder::autowire(),
			Controllers\Providers::class => ContainerBuilder::autowire(),
			Controllers\Compiler::class => ContainerBuilder::autowire(),
		];
	}

	/**
	* Fire Mounted action on mount
	*
	* @return void
	*/
	public function onMount(): void
	{
		add_action( 'after_setup_theme', [ $this, 'themeSupports'] );
		parent::onMount();
	}
	/**
	 * Add theme supports
	 *
	 * @return void
	 */
	public function themeSupports(): void
	{
		add_theme_support('block-template-parts');
	}
}
