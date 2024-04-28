<?php

namespace Mwf\Cornerstone\Deps\Composer\Installers;

/** @internal */
class EzPlatformInstaller extends BaseInstaller
{
    /** @var array<string, string> */
    protected $locations = array('meta-assets' => 'web/assets/ezplatform/', 'assets' => 'web/assets/ezplatform/{$name}/');
}
