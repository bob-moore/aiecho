<?php

/**
 * Handler Controller
 *
 * PHP Version 8.0.28
 *
 * @package Devkit_WP_Framework
 * @author  Bob Moore <bob@bobmoore.dev>
 * @license GPL-2.0+ <http://www.gnu.org/licenses/gpl-2.0.txt>
 * @link    https://github.com/bob-moore/wp-framework-core
 * @since   1.0.0
 */
namespace Mwf\Cornerstone\Deps\Devkit\WPCore\Controllers;

use Mwf\Cornerstone\Deps\Devkit\WPCore\DI\ContainerBuilder, Mwf\Cornerstone\Deps\Devkit\WPCore\Handlers as Handler, Mwf\Cornerstone\Deps\Devkit\WPCore\Interfaces, Mwf\Cornerstone\Deps\Devkit\WPCore\Abstracts;
/**
 * Controls the registration and execution of services
 *
 * @subpackage Controllers
 * @internal
 */
class Handlers extends Abstracts\Mountable implements Interfaces\Controller
{
    /**
     * Get definitions that should be added to the service container
     *
     * @return array<string, mixed>
     */
    public static function getServiceDefinitions() : array
    {
        return [
            /**
             * Class Implementations
             */
            Handler\Styles::class => ContainerBuilder::autowire(),
            Handler\Scripts::class => ContainerBuilder::autowire(),
            /**
             * Interfaces Aliases
             */
            Interfaces\Handlers\Styles::class => ContainerBuilder::get(Handler\Styles::class),
            Interfaces\Handlers\Scripts::class => ContainerBuilder::get(Handler\Scripts::class),
        ];
    }
}
