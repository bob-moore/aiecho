<?php

namespace Mwf\ChildTheme\Deps\Composer\Installers;

/** @internal */
class KohanaInstaller extends BaseInstaller
{
    /** @var array<string, string> */
    protected $locations = array('module' => 'modules/{$name}/');
}
