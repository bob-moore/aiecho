<?php

namespace Mwf\Cornerstone\Deps\Composer\Installers;

/** @internal */
class KnownInstaller extends BaseInstaller
{
    /** @var array<string, string> */
    protected $locations = array('plugin' => 'IdnoPlugins/{$name}/', 'theme' => 'Themes/{$name}/', 'console' => 'ConsolePlugins/{$name}/');
}
