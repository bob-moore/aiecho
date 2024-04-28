<?php

namespace Mwf\Cornerstone\Deps\Composer\Installers;

/** @internal */
class ClanCatsFrameworkInstaller extends BaseInstaller
{
    /** @var array<string, string> */
    protected $locations = array('ship' => 'CCF/orbit/{$name}/', 'theme' => 'CCF/app/themes/{$name}/');
}
