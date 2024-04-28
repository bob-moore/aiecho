<?php

namespace Mwf\ChildTheme\Deps\Timber\Integration;

use Mwf\ChildTheme\Deps\Timber\Integration\CLI\TimberCommand;
use Mwf\ChildTheme\Deps\WP_CLI;
/**
 * Class WpCliIntegration
 *
 * Adds a "timber" command to WP CLI.
 * @internal
 */
class WpCliIntegration implements IntegrationInterface
{
    public function should_init() : bool
    {
        return \defined('Mwf\\ChildTheme\\Deps\\WP_CLI') && \class_exists('Mwf\\ChildTheme\\Deps\\WP_CLI');
    }
    public function init() : void
    {
        WP_CLI::add_command('timber', TimberCommand::class);
    }
}
