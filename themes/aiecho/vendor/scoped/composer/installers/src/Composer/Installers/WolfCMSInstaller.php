<?php

namespace Mwf\ChildTheme\Deps\Composer\Installers;

/** @internal */
class WolfCMSInstaller extends BaseInstaller
{
    /** @var array<string, string> */
    protected $locations = array('plugin' => 'wolf/plugins/{$name}/');
}
