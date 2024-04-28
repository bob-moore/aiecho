<?php

namespace Mwf\Cornerstone\Deps\Composer\Installers;

/** @internal */
class FuelphpInstaller extends BaseInstaller
{
    /** @var array<string, string> */
    protected $locations = array('component' => 'components/{$name}/');
}
