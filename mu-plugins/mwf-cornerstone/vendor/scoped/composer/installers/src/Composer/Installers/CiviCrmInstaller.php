<?php

namespace Mwf\Cornerstone\Deps\Composer\Installers;

/** @internal */
class CiviCrmInstaller extends BaseInstaller
{
    /** @var array<string, string> */
    protected $locations = array('ext' => 'ext/{$name}/');
}
