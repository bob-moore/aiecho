<?php

namespace Mwf\Cornerstone\Deps\Composer\Installers;

/** @internal */
class VanillaInstaller extends BaseInstaller
{
    /** @var array<string, string> */
    protected $locations = array('plugin' => 'plugins/{$name}/', 'theme' => 'themes/{$name}/');
}
