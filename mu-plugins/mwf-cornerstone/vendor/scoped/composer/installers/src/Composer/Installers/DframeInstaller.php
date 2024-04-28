<?php

namespace Mwf\Cornerstone\Deps\Composer\Installers;

/** @internal */
class DframeInstaller extends BaseInstaller
{
    /** @var array<string, string> */
    protected $locations = array('module' => 'modules/{$vendor}/{$name}/');
}
