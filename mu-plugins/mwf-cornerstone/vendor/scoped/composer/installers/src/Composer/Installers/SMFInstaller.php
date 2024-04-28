<?php

namespace Mwf\Cornerstone\Deps\Composer\Installers;

/** @internal */
class SMFInstaller extends BaseInstaller
{
    /** @var array<string, string> */
    protected $locations = array('module' => 'Sources/{$name}/', 'theme' => 'Themes/{$name}/');
}
