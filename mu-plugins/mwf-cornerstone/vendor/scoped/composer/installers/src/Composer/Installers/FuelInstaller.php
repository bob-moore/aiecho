<?php

namespace Mwf\Cornerstone\Deps\Composer\Installers;

/** @internal */
class FuelInstaller extends BaseInstaller
{
    /** @var array<string, string> */
    protected $locations = array('module' => 'fuel/app/modules/{$name}/', 'package' => 'fuel/packages/{$name}/', 'theme' => 'fuel/app/themes/{$name}/');
}