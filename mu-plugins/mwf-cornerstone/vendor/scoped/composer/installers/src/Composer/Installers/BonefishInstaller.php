<?php

namespace Mwf\Cornerstone\Deps\Composer\Installers;

/** @internal */
class BonefishInstaller extends BaseInstaller
{
    /** @var array<string, string> */
    protected $locations = array('package' => 'Packages/{$vendor}/{$name}/');
}
