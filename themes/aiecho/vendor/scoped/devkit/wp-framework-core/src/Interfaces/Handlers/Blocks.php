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
namespace Mwf\ChildTheme\Deps\Devkit\WPCore\Interfaces\Handlers;

use Mwf\ChildTheme\Deps\Devkit\WPCore\Traits, Mwf\ChildTheme\Deps\Devkit\WPCore\Abstracts;
/**
 * Controls the registration and execution of services
 *
 * @subpackage Controllers
 * @internal
 */
interface Blocks
{
    /**
     * Blocks setter
     *
     * @param string ...$blocks : paths to block.json file(s).
     *
     * @return void
     */
    public function setBlocks(string ...$blocks) : void;
    /**
     * Register custom blocks
     *
     * @see https://developer.wordpress.org/reference/functions/register_block_type/
     *
     * @return void
     */
    public function registerBlocks() : void;
}
