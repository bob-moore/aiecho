<?php
/**
 * Custom taxonomy definition
 *
 * PHP Version 8.0.28
 *
 * @package mwf_cornerstone
 * @author  Mid-West Family <digital@midwestfamilymadison.com>
 * @license GPL-2.0+ <http://www.gnu.org/licenses/gpl-2.0.txt>
 * @link    https://www.midwestfamilymadison.com
 * @since   1.0.0
 */

namespace Mwf\Cornerstone\Entities;

use Mwf\Cornerstone\Deps\Devkit\WPCore;

/**
 * Custom Taxonomy class
 *
 * @subpackage Controllers
 */
class PageTag extends WPCore\Abstracts\Mountable implements WPCore\Interfaces\Entities\Taxonomy
{
	/**
	 * Getter for taxonomy name
	 *
	 * @return string
	 */
	public function getName(): string
	{
		return 'page-tag';
	}
	/**
	 * Getter for taxonomy definition
	 *
	 * @see https://generatewp.com/taxonomy/ to generate definitions.
	 * @return array<string, mixed>
	 */
	public function getDefinition(): array
	{
		$labels = [
			'name'                       => _x( 'Tags', 'Taxonomy General Name', 'mwf_cornerstone' ),
			'singular_name'              => _x( 'Tag', 'Taxonomy Singular Name', 'mwf_cornerstone' ),
			'menu_name'                  => __( 'Tags', 'mwf_cornerstone' ),
			'all_items'                  => __( 'All Items', 'mwf_cornerstone' ),
			'parent_item'                => __( 'Parent Item', 'mwf_cornerstone' ),
			'parent_item_colon'          => __( 'Parent Item:', 'mwf_cornerstone' ),
			'new_item_name'              => __( 'New Item Name', 'mwf_cornerstone' ),
			'add_new_item'               => __( 'Add New Item', 'mwf_cornerstone' ),
			'edit_item'                  => __( 'Edit Item', 'mwf_cornerstone' ),
			'update_item'                => __( 'Update Item', 'mwf_cornerstone' ),
			'view_item'                  => __( 'View Item', 'mwf_cornerstone' ),
			'separate_items_with_commas' => __( 'Separate items with commas', 'mwf_cornerstone' ),
			'add_or_remove_items'        => __( 'Add or remove items', 'mwf_cornerstone' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'mwf_cornerstone' ),
			'popular_items'              => __( 'Popular Items', 'mwf_cornerstone' ),
			'search_items'               => __( 'Search Items', 'mwf_cornerstone' ),
			'not_found'                  => __( 'Not Found', 'mwf_cornerstone' ),
			'no_terms'                   => __( 'No items', 'mwf_cornerstone' ),
			'items_list'                 => __( 'Items list', 'mwf_cornerstone' ),
			'items_list_navigation'      => __( 'Items list navigation', 'mwf_cornerstone' ),
		];

		$args = [
			'labels'            => $labels,
			'hierarchical'      => false,
			'public'            => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'show_tagcloud'     => true,
			'show_in_rest'      => true,
			'post_types'        => $this->getPostTypes(),
		];

		return $args;
	}
	/**
	 * Getter for taxonomy post types
	 *
	 * @return array<string>
	 */
	public function getPostTypes(): array
	{
		return [ 'page' ];
	}
}
