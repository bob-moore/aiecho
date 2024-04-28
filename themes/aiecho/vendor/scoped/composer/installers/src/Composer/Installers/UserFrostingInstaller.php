<?php

namespace Mwf\ChildTheme\Deps\Composer\Installers;

/** @internal */
class UserFrostingInstaller extends BaseInstaller
{
    /** @var array<string, string> */
    protected $locations = array('sprinkle' => 'app/sprinkles/{$name}/');
}
