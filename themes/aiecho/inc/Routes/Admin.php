<?php
/**
 * Admin Route Definition
 *
 * PHP Version 8.0.28
 *
 * @package paradise_island
 * @author  Mid-West Family Madison <digital@midwestfamilymadison.com>
 * @license GPL-2.0+ <http://www.gnu.org/licenses/gpl-2.0.txt>
 * @link    https://www.paradise-island-tanning.com/
 * @since   1.0.0
 */

namespace Mwf\ChildTheme\Routes;

use Mwf\ChildTheme\Deps\Devkit\WPCore,
	Mwf\ChildTheme\Deps\Devkit\WPCore\DI\OnMount;

/**
 * Admin router class
 *
 * @subpackage Route
 */
class Admin extends WPCore\Abstracts\Mountable implements
	WPCore\Interfaces\Uses\Scripts,
	WPCore\Interfaces\Uses\Styles
{
	use WPCore\Traits\Uses\Scripts;
	use WPCore\Traits\Uses\Styles;

	/**
	 * Load actions and filters, and other setup requirements
	 *
	 * @return void
	 */
	#[OnMount]
	public function mount(): void
	{
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueueAssets' ] );
	}
	/**
	 * Enqueue admin styles and JS bundles
	 *
	 * @return void
	 */
	public function enqueueAssets(): void
	{
		$this->enqueueScript(
			'admin',
			'admin/bundle.js'
		);
		$this->enqueueStyle(
			'admin',
			'admin/bundle.css'
		);
	}
}
