<?php

/**
 * Member interface definition
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
 * Member interface requirements
 *
 * @subpackage Interfaces
 * @internal
 */
interface Member
{
    /**
     * Setter for package name
     *
     * @param string $package : string name of the package.
     *
     * @return void
     */
    public function setPackage(string $package) : void;
    /**
     * Getter for package name
     *
     * @return string
     */
    public function getPackage() : string;
}
