<?php
/**
 * Notices Handler
 *
 * PHP Version 8.0.28
 *
 * @package mwf_cornerstone
 * @author  Mid-West Family <digital@midwestfamilymadison.com>
 * @license GPL-2.0+ <http://www.gnu.org/licenses/gpl-2.0.txt>
 * @link    https://www.midwestfamilymadison.com
 * @since   1.0.0
 */

namespace Mwf\Cornerstone\Handlers;

use Mwf\Cornerstone\Deps\Devkit\WPCore,
	Mwf\Cornerstone\Deps\DI\Attribute\Inject;

/**
 * Notices handler class
 *
 * @subpackage Controllers
 */
class Notices extends WPCore\Abstracts\Mountable
{
    /**
     * Set interval for admin email nag screen.
     * 
     * Return false to disable nag screen.
     *
     * @param integer|boolean $interval : interval in days.
     *
     * @return integer|boolean
     */
    public function adminEmailInterval( int|bool $interval ): int|bool
    {
        return false;
    }
    function addToolbarItem( \WP_Admin_Bar $admin_bar ):void
    {

        if (!current_user_can('manage_options')) {
            return;
        }
    
        $admin_bar->add_menu(array(
            'id' => 'hide-show-notifications',
            'title' => 'Notifications',
            'href' => '#',
            'meta' => array(
                'title' => __('Notifications', 'mwf_cornerstone'),
            ),
        ));
    }
}
