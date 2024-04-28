<?php

namespace Mwf\Cornerstone\Deps\Composer\Installers;

/**
 *
 * Installer for kanboard plugins
 *
 * kanboard.net
 *
 * Class KanboardInstaller
 * @package Composer\Installers
 * @internal
 */
class KanboardInstaller extends BaseInstaller
{
    /** @var array<string, string> */
    protected $locations = array('plugin' => 'plugins/{$name}/');
}
