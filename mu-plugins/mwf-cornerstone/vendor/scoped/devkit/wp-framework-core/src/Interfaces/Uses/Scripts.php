<?php

/**
 * Used Scripts interface definition
 *
 * PHP Version 8.0.28
 *
 * @package Devkit_WP_Framework
 * @author  Bob Moore <bob@bobmoore.dev>
 * @license GPL-2.0+ <http://www.gnu.org/licenses/gpl-2.0.txt>
 * @link    https://github.com/bob-moore/wp-framework-core
 * @since   1.0.0
 */
namespace Mwf\Cornerstone\Deps\Devkit\WPCore\Interfaces\Uses;

use Mwf\Cornerstone\Deps\Devkit\WPCore\Interfaces;
/**
 * Uses\Scripts interface
 *
 * Used to type hint against Devkit\WPCore\Interfaces\Uses\Scripts.
 *
 * @subpackage Interfaces
 * @internal
 */
interface Scripts
{
    /**
     * Setter for the script handler
     *
     * @param Interfaces\Handlers\Scripts $script_handler : instance of script handler.
     *
     * @return void
     */
    public function setScriptHandler(Interfaces\Handlers\Scripts $script_handler = null) : void;
    /**
     * Getter for the script handler
     *
     * @return Interfaces\Handlers\Scripts|null
     */
    public function getScriptHandler() : ?Interfaces\Handlers\Scripts;
    /**
     * Register a JS file with WordPress
     *
     * @param string             $handle : handle to register.
     * @param string             $path : relative path to script.
     * @param array<int, string> $dependencies : any set dependencies not in assets file, optional.
     * @param string             $version : version of JS file, optional.
     * @param boolean            $in_footer : whether to enqueue in footer, optional.
     *
     * @return void
     */
    public function enqueueScript(string $handle, string $path, array $dependencies = [], string $version = '', $in_footer = \true) : void;
}
