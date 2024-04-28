<?php

namespace Mwf\Cornerstone\Deps\Timber\Integration;

use Mwf\Cornerstone\Deps\Timber\Integration\CLI\TimberCommand;
use Mwf\Cornerstone\Deps\WP_CLI;
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
        return \defined('Mwf\\Cornerstone\\Deps\\WP_CLI') && \class_exists('Mwf\\Cornerstone\\Deps\\WP_CLI');
    }
    public function init() : void
    {
        WP_CLI::add_command('timber', TimberCommand::class);
    }
}
