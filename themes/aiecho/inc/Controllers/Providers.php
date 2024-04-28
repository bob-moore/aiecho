<?php
/**
 * Providers Controller
 *
 * PHP Version 8.0.28
 *
 * @package paradise_island
 * @author  Mid-West Family Madison <digital@midwestfamilymadison.com>
 * @license GPL-2.0+ <http://www.gnu.org/licenses/gpl-2.0.txt>
 * @link    https://www.paradise-island-tanning.com/
 * @since   1.0.0
 */

namespace Mwf\ChildTheme\Controllers;

use Mwf\ChildTheme\Providers as Provider;

use Mwf\ChildTheme\Deps\Devkit\WPCore,
	Mwf\ChildTheme\Deps\Devkit\WPCore\DI\OnMount,
	Mwf\ChildTheme\Deps\Psr\Container\ContainerInterface,
	Mwf\ChildTheme\Deps\Devkit\WPCore\DI\ContainerBuilder;

/**
 * Providers controller class
 *
 * Controls and orchestrates the execution of any 3rd party providers.
 *
 * @subpackage Controllers
 */
class Providers extends WPCore\Abstracts\Mountable implements WPCore\Interfaces\Controller
{
	/**
	 * Get definitions that should be added to the service container
	 *
	 * @return array<string, mixed>
	 */
	public static function getServiceDefinitions(): array
	{
		return [
			Provider\Kadence::class  => ContainerBuilder::autowire(),
			Provider\Elements::class => ContainerBuilder::autowire(),
			static::class       => ContainerBuilder::decorate(
				[
					static::class,
					'decorateInstance',
				]
			),
		];
	}
	/**
	 * Class decorator
	 *
	 * Mounts active providers
	 *
	 * @param self               $instance : instance of this class.
	 * @param ContainerInterface $container : container instance.
	 *
	 * @return self
	 */
	public static function decorateInstance( self $instance, ContainerInterface $container ): self
	{
		/**
		* Mount devkit custom elements
		*/
		if ( WPCore\Helpers::isPluginActive( 'devkit-custom-elements/plugin.php' ) ) {
			$instance->mountCustomElements( $container->get( Provider\Elements::class ) );
		}

		return $instance;
	}
	/**
	 * Mount support for devkit custom elements
	 *
	 * @param Provider\Elements $provider : custom elements provider instance.
	 *
	 * @return void
	 */
	public function mountCustomElements( Provider\Elements $provider ): void
	{
		add_filter( 'devkit_elements_fields_locations', [ $provider, 'locations' ] );
	}
	/**
	 * Actions to perform when the class is loaded
	 *
	 * @param Provider\Kadence $provider : Kadence provider instance.
	 *
	 * @return void
	 */
	#[OnMount]
	public function mountDivi( Provider\Kadence $provider ): void
	{
		add_filter( "{$this->package}_frontend_style_dependencies", [ $provider, 'useKadenceStyles' ] );
	}
}
