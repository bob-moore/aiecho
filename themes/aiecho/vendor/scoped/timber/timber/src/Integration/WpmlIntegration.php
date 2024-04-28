<?php

namespace Mwf\ChildTheme\Deps\Timber\Integration;

use WP_Post;
use Mwf\ChildTheme\Deps\WPML_LS_Menu_Item;
/** @internal */
class WpmlIntegration implements IntegrationInterface
{
    public function should_init() : bool
    {
        return \function_exists('Mwf\\ChildTheme\\Deps\\wpml_object_id_filter');
    }
    public function init() : void
    {
        \add_filter('theme_name_timber/url_helper/file_system_to_url', [$this, 'file_system_to_url'], 10, 1);
        \add_filter('theme_name_timber/url_helper/get_content_subdir/home_url', [$this, 'file_system_to_url'], 10, 1);
        \add_filter('theme_name_timber/url_helper/url_to_file_system/path', [$this, 'file_system_to_url'], 10, 1);
        \add_filter('theme_name_timber/menu/id_from_location', [$this, 'menu_object_id_filter'], 10, 1);
        \add_filter('theme_name_timber/menu/item_objects', [$this, 'menu_item_objects_filter'], 10, 1);
        \add_filter('theme_name_timber/image_helper/_get_file_url/home_url', [$this, 'file_system_to_url'], 10, 1);
    }
    public function file_system_to_url($url)
    {
        if (\defined('Mwf\\ChildTheme\\Deps\\ICL_LANGUAGE_CODE')) {
            $url = \preg_replace('/(?<!:\\/)\\/' . ICL_LANGUAGE_CODE . '/', '', $url);
        }
        return $url;
    }
    public function menu_object_id_filter($id)
    {
        return \Mwf\ChildTheme\Deps\wpml_object_id_filter($id, 'nav_menu');
    }
    public function menu_item_objects_filter(array $items)
    {
        return \array_map(fn($item) => $item instanceof WPML_LS_Menu_Item ? new WP_Post($item) : $item, $items);
    }
}
