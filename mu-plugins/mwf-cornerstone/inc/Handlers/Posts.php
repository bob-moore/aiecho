<?php
/**
 * Handler Controller
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
 * Controls the registration and execution of services
 *
 * @subpackage Controllers
 */
class Posts extends WPCore\Abstracts\Mountable
{
	/**
	 * Array of custom post types
	 *
	 * @var array<WPCore\Interfaces\Entities\PostType>
	 */
	protected array $post_types = [];
	/**
	 * Post Type Setter
	 *
	 * @param WPCore\Interfaces\Entities\PostType ...$post_types : array of post type objects.
	 *
	 * @return void
	 */
	public function setPostTypes( WPCore\Interfaces\Entities\PostType ...$post_types ): void
	{
		$this->post_types = array_merge( $this->post_types, $post_types );
	}
	/**
	 * Getter for post types
	 *
	 * @return array<WPCore\Interfaces\Entities\PostType>
	 */
	public function getPostTypes(): array
	{
		return apply_filters( "{$this->package}_post_types", $this->post_types );
	}
	/**
	 * Register custom post types
	 *
	 * @return void
	 */
	public function registerPostTypes(): void
	{
		foreach ( $this->getPostTypes() as $post_type ) {
			if ( ! WPCore\Helpers::implements( $post_type, WPCore\Interfaces\Entities\PostType::class ) ) {
				continue;
			}
			register_post_type( $post_type->getName(), $post_type->getDefinition() );
		}
	}
}
