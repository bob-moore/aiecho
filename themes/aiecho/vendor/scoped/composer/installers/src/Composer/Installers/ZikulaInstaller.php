<?php

namespace Mwf\ChildTheme\Deps\Composer\Installers;

/** @internal */
class ZikulaInstaller extends BaseInstaller
{
    /** @var array<string, string> */
    protected $locations = array('module' => 'modules/{$vendor}-{$name}/', 'theme' => 'themes/{$vendor}-{$name}/');
}
