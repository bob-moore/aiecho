<?php

namespace Mwf\ChildTheme\Deps\Composer\Installers;

/** @internal */
class RoundcubeInstaller extends BaseInstaller
{
    /** @var array<string, string> */
    protected $locations = array('plugin' => 'plugins/{$name}/');
    /**
     * Lowercase name and changes the name to a underscores
     */
    public function inflectPackageVars(array $vars) : array
    {
        $vars['name'] = \strtolower(\str_replace('-', '_', $vars['name']));
        return $vars;
    }
}
