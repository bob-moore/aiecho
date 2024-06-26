<?php
/**
 * @license GPL-2.0-or-later
 *
 * Modified by kadencewp on 03-February-2024 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */

namespace KadenceWP\KadencePro\StellarWP\Uplink\Messages;

class Network_Licensed extends Message_Abstract {
	/**
	 * @inheritDoc
	 */
	public function get(): string {
		return esc_html__( 'A valid license has been entered by your network administrator.', '%TEXTDOMAIN%' );
	}
}
