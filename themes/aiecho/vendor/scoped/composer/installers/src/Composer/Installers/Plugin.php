<?php

namespace Mwf\ChildTheme\Deps\Composer\Installers;

use Mwf\ChildTheme\Deps\Composer\Composer;
use Mwf\ChildTheme\Deps\Composer\IO\IOInterface;
use Mwf\ChildTheme\Deps\Composer\Plugin\PluginInterface;
/** @internal */
class Plugin implements PluginInterface
{
    /** @var Installer */
    private $installer;
    public function activate(Composer $composer, IOInterface $io) : void
    {
        $this->installer = new Installer($io, $composer);
        $composer->getInstallationManager()->addInstaller($this->installer);
    }
    public function deactivate(Composer $composer, IOInterface $io) : void
    {
        $composer->getInstallationManager()->removeInstaller($this->installer);
    }
    public function uninstall(Composer $composer, IOInterface $io) : void
    {
    }
}
