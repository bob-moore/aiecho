<?php

namespace Mwf\Cornerstone\Deps\Composer\Installers;

/** @internal */
class PPIInstaller extends BaseInstaller
{
    /** @var array<string, string> */
    protected $locations = array('module' => 'modules/{$name}/');
}
