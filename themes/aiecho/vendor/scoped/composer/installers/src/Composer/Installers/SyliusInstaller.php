<?php

namespace Mwf\ChildTheme\Deps\Composer\Installers;

/** @internal */
class SyliusInstaller extends BaseInstaller
{
    /** @var array<string, string> */
    protected $locations = array('theme' => 'themes/{$name}/');
}
