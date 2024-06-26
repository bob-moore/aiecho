<?php

/**
 * Login Route Definition
 *
 * PHP Version 8.0.28
 *
 * @package Devkit_WP_Framework
 * @author  Bob Moore <bob@bobmoore.dev>
 * @license GPL-2.0+ <http://www.gnu.org/licenses/gpl-2.0.txt>
 * @link    https://github.com/bob-moore/wp-framework-core
 * @since   1.0.0
 */
namespace Mwf\ChildTheme\Deps\Devkit\WPCore\Routes;

use Mwf\ChildTheme\Deps\Devkit\WPCore\Abstracts, Mwf\ChildTheme\Deps\Devkit\WPCore\Traits, Mwf\ChildTheme\Deps\Devkit\WPCore\Interfaces, Mwf\ChildTheme\Deps\Devkit\WPCore\DI\OnMount;
/**
 * Login router class
 *
 * @subpackage Route
 * @internal
 */
class Login extends Abstracts\Mountable implements Interfaces\Uses\Scripts, Interfaces\Uses\Styles
{
    use Traits\Uses\Scripts;
    use Traits\Uses\Styles;
    /**
     * Load actions and filters, and other setup requirements
     *
     * @return void
     */
    #[OnMount]
    public function mount() : void
    {
        \add_action('login_enqueue_scripts', [$this, 'enqueueAssets']);
    }
    /**
     * Enqueue admin styles and JS bundles
     *
     * @return void
     */
    public function enqueueAssets() : void
    {
        $this->enqueueScript('login', 'login/bundle.js');
        $this->enqueueStyle('login', 'login/bundle.css');
    }
}
