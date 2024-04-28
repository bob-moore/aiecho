<?php
/**
 * Frontend Route Definition
 *
 * PHP Version 8.0.28
 *
 * @package mwf_cornerstone
 * @author  Mid-West Family <digital@midwestfamilymadison.com>
 * @license GPL-2.0+ <http://www.gnu.org/licenses/gpl-2.0.txt>
 * @link    https://www.midwestfamilymadison.com
 * @since   1.0.0
 */

namespace Mwf\Cornerstone\Routes;

use Mwf\Cornerstone\Deps\Devkit\WPCore,
	Mwf\Cornerstone\Deps\Devkit\WPCore\DI\OnMount;

/**
 * Frontend router class
 *
 * @subpackage Route
 */
class Login extends WPCore\Abstracts\Mountable implements
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
		add_action( 'login_enqueue_scripts', [ $this, 'enqueueAssets' ] );
		add_action( 'login_header', [ $this, 'openLoginContainer' ], 2 );
		add_filter( 'login_message', [ $this, 'loginMessage' ] );
		add_action( 'login_footer', [ $this, 'closeLoginContainer' ], 20 );
	}
	/**
	 * Enqueue styles and JS bundles
	 *
	 * @return void
	 */
	public function enqueueAssets(): void
	{
		$this->enqueueScript(
			'login',
			'login/bundle.js'
		);
		$this->enqueueStyle(
			'login',
			'login/bundle.css'
		);
	}
		/**
		 * Add custom login message
		 *
		 * @param string $message : message to show to the user.
		 *
		 * @return string
		 */
	public function loginMessage( string $message ): string
	{
		$extra = apply_filters( "{$this->package}_compile_template", [ '@mwf_cornerstone/login/message.twig' ] );

		return $extra . $message;
	}
	/**
	 * Render opening div(s)
	 *
	 * @return void
	 */
	public function openLoginContainer(): void
	{
		echo '<div class="login-container">';

		do_action( "{$this->package}_render_template", [ '@mwf_cornerstone/login/index.twig' ] );
	}
	/**
	 * Render closing div(s)
	 *
	 * @return void
	 */
	public function closeLoginContainer(): void
	{
		do_action( "{$this->package}_render_template", [ '@mwf_cornerstone/login/footer.twig' ] );

		echo '</div>';
	}
}
