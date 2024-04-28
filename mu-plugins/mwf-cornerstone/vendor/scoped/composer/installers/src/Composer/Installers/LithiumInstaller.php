<?php

namespace Mwf\Cornerstone\Deps\Composer\Installers;

/** @internal */
class LithiumInstaller extends BaseInstaller
{
    /** @var array<string, string> */
    protected $locations = array('library' => 'libraries/{$name}/', 'source' => 'libraries/_source/{$name}/');
}
