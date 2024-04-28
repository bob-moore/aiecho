<?php

namespace Mwf\Cornerstone\Deps\Composer\Installers;

/** @internal */
class MODULEWorkInstaller extends BaseInstaller
{
    /** @var array<string, string> */
    protected $locations = array('module' => 'modules/{$name}/');
}
