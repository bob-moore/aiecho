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

namespace Mwf\Cornerstone\Controllers;

use Mwf\Cornerstone\Services;

use Mwf\Cornerstone\Deps\Devkit\WPCore,
	Mwf\Cornerstone\Deps\Devkit\WPCore\DI\ContainerBuilder,
	Mwf\Cornerstone\Deps\Devkit\WPCore\DI\OnMount;

/**
 * Controls the registration and execution of services
 *
 * @subpackage Controllers
 */
class Compiler extends WPCore\Abstracts\Mountable implements WPCore\Interfaces\Controller
{
	/**
	 * Get definitions that should be added to the service container
	 *
	 * @return array<string, mixed>
	 */
	public static function getServiceDefinitions(): array
	{
		return [
			/**
			 * Class implementations
			 */
			Services\Compiler::class                   => ContainerBuilder::autowire(),
			/**
			 * Interfaces mapping
			 */
			WPCore\Interfaces\Services\Compiler::class => ContainerBuilder::get( Services\Compiler::class ),
		];
	}
	/**
	 * Mount compiler filters & add twig functions
	 *
	 * @param WPCore\Interfaces\Services\Compiler $compiler : instance of compiler service.
	 *
	 * @return void
	 */
	#[OnMount]
	public function mountCompiler( WPCore\Interfaces\Services\Compiler $compiler ): void
	{
		add_filter( "{$this->package}_timber/locations", [ $compiler, 'templateLocations' ] );

		add_action( "{$this->package}_render_template", [ $compiler, 'render' ], 10, 2 );
		add_filter( "{$this->package}_compile_template", [ $compiler, 'compile' ], 10, 2 );

		add_action( "{$this->package}_render_string", [ $compiler, 'renderString' ], 10, 2 );
		add_filter( "{$this->package}_compile_string", [ $compiler, 'compileString' ], 10, 2 );
	}
	/**
	 * Add custom functions to twig
	 *
	 * @param array<string, mixed> $functions : array of functions, keyed by function name.
	 *
	 * @return array<string, mixed>
	 */
	public function twigFunctions( array $functions ): array
	{
		$custom_functions = [
			'has_action'    => [ 'callable' => 'has_action' ],
			'do_action'     => [ 'callable' => 'do_action' ],
			'apply_filters' => [ 'callable' => 'apply_filters' ],
		];
		return array_merge( $custom_functions, $functions );
	}
	/**
	 * Add custom filters to twig.
	 *
	 * @param array<string, mixed> $filters : array of filters, keyed by filter name.
	 *
	 * @return array<string, mixed>
	 */
	public function twigFilters( array $filters ): array
	{
		$custom_filters = [];

		return array_merge( $custom_filters, $filters );
	}
}
