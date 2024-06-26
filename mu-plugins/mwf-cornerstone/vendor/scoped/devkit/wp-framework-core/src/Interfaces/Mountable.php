<?php

/**
 * Loadable interface definition
 *
 * PHP Version 8.0.28
 *
 * @package Devkit_WP_Framework
 * @author  Bob Moore <bob@bobmoore.dev>
 * @license GPL-2.0+ <http://www.gnu.org/licenses/gpl-2.0.txt>
 * @link    https://github.com/bob-moore/wp-framework-core
 * @since   1.0.0
 */
namespace Mwf\Cornerstone\Deps\Devkit\WPCore\Interfaces;

/**
 * Loadable interface requirements
 *
 * Used to type hint against Devkit\WPCore\Interfaces\Loadable.
 *
 * @subpackage Interfaces
 * @internal
 */
interface Mountable
{
    /**
     * Check if loading action has already fired
     *
     * @return int
     */
    public function hasMounted() : int;
    /**
     * Fire Mounted action on mount
     *
     * @return void
     */
    public function onMount() : void;
}
