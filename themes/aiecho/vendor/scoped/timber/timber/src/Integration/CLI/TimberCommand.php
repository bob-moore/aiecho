<?php

namespace Mwf\ChildTheme\Deps\Timber\Integration\CLI;

use Mwf\ChildTheme\Deps\Timber\Cache\Cleaner;
use Mwf\ChildTheme\Deps\WP_CLI;
use Mwf\ChildTheme\Deps\WP_CLI_Command;
if (!\class_exists('Mwf\\ChildTheme\\Deps\\WP_CLI_Command')) {
    return;
}
/**
 * Class TimberCommand
 *
 * Handles WP-CLI commands.
 * @internal
 */
class TimberCommand extends WP_CLI_Command
{
    /**
     * Clears caches in Timber.
     *
     * ## OPTIONS
     *
     * [<mode>]
     * : Optional. The type of cache to clear. Accepts 'timber' or 'twig'. If not provided, the command will clear all caches.
     *
     * ## EXAMPLES
     *
     *    # Clear all caches.
     *    wp timber clear-cache
     *
     *    # Clear Timber caches.
     *    wp timber clear-cache timber
     *
     *    # Clear Twig caches.
     *    wp timber clear-cache twig
     *
     * @subcommand clear-cache
     * @alias clear_cache
     */
    public function clear_cache($args = [])
    {
        $mode = $args[0] ?? 'all';
        $mode_string = 'all' !== $mode ? \ucfirst($mode) : $mode;
        WP_CLI::log("Clearing {$mode_string} caches …");
        if (Cleaner::clear_cache($mode)) {
            WP_CLI::success("Cleared {$mode_string} caches.");
        } else {
            WP_CLI::warning("Failed to clear {$mode_string} cached contents.");
        }
    }
}
