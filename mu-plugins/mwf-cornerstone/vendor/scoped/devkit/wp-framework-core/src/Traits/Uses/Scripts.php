<?php

/**
 * Script User definition
 *
 * PHP Version 8.0.28
 *
 * @package Devkit_WP_Framework
 * @author  Bob Moore <bob@bobmoore.dev>
 * @license GPL-2.0+ <http://www.gnu.org/licenses/gpl-2.0.txt>
 * @link    https://github.com/bob-moore/wp-framework-core
 * @since   1.0.0
 */
namespace Mwf\Cornerstone\Deps\Devkit\WPCore\Traits\Uses;

use Mwf\Cornerstone\Deps\Devkit\WPCore\Helpers, Mwf\Cornerstone\Deps\Devkit\WPCore\Interfaces;
use Mwf\Cornerstone\Deps\DI\Attribute\Inject;
/**
 * Script Trait
 *
 * Used by classes to import the script handler
 *
 * @subpackage Traits
 * @internal
 */
trait Scripts
{
    /**
     * Script handler instance
     *
     * @var Interfaces\Handlers\Scripts|null
     */
    protected ?Interfaces\Handlers\Scripts $script_handler;
    /**
     * Setter for the script handler
     *
     * @param Interfaces\Handlers\Scripts $script_handler : instance of script handler.
     *
     * @return void
     */
    #[Inject]
    public function setScriptHandler(#[Inject(Interfaces\Handlers\Scripts::class)] Interfaces\Handlers\Scripts $script_handler = null) : void
    {
        $this->script_handler = $script_handler;
    }
    /**
     * Getter for the script handler
     *
     * @return Interfaces\Handlers\Scripts|null
     */
    public function getScriptHandler() : ?Interfaces\Handlers\Scripts
    {
        return $this->script_handler;
    }
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
    public function enqueueScript(string $handle, string $path, array $dependencies = [], string $version = '', $in_footer = \true) : void
    {
        if (isset($this->script_handler) && !\is_null($this->script_handler)) {
            $this->script_handler->enqueue($handle, $path, $dependencies, $version, $in_footer);
        }
    }
}
