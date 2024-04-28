<?php

namespace Mwf\ChildTheme\Deps\Composer\Installers;

/** @internal */
class ReIndexInstaller extends BaseInstaller
{
    /** @var array<string, string> */
    protected $locations = array('theme' => 'themes/{$name}/', 'plugin' => 'plugins/{$name}/');
}
