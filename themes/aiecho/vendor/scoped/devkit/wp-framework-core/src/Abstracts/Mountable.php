<?php

/**
 * Member definition file
 *
 * PHP Version 8.0.28
 *
 * @package Devkit_WP_Framework
 * @author  Bob Moore <bob@bobmoore.dev>
 * @license GPL-2.0+ <http://www.gnu.org/licenses/gpl-2.0.txt>
 * @link    https://github.com/bob-moore/wp-framework-core
 * @since   1.0.0
 */
namespace Mwf\ChildTheme\Deps\Devkit\WPCore\Abstracts;

use Mwf\ChildTheme\Deps\Devkit\WPCore\Interfaces, Mwf\ChildTheme\Deps\Devkit\WPCore\Helpers, Mwf\ChildTheme\Deps\Devkit\WPCore\DI\OnMount;
/**
 * Abstract Loadable class
 *
 * @subpackage Abstracts
 * @internal
 */
abstract class Mountable extends Member implements Interfaces\Mountable
{
    /**
     * Name of class converted to usable slug
     *
     * Fully qualified class name, converted to lowercase with forward slashes
     *
     * @var string
     */
    protected string $slug = '';
    /**
     * Getter for slug field
     *
     * @return string
     */
    protected function slug() : string
    {
        if (empty($this->slug)) {
            $this->slug = Helpers::slugify(static::class);
        }
        return $this->slug;
    }
    /**
     * Check if the loading action has already been fired
     *
     * @return int
     */
    public function hasMounted() : int
    {
        return \did_action("{$this->slug()}_mounted");
    }
    /**
     * Fire Mounted action on mount
     *
     * @return void
     */
    #[OnMount(priority: \PHP_INT_MAX)]
    public function onMount() : void
    {
        if (!$this->hasMounted()) {
            \do_action("{$this->slug()}_mounted");
        }
    }
}
