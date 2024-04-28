<?php

namespace Mwf\Cornerstone\Deps\Composer\Installers;

/** @internal */
class TheliaInstaller extends BaseInstaller
{
    /** @var array<string, string> */
    protected $locations = array('module' => 'local/modules/{$name}/', 'frontoffice-template' => 'templates/frontOffice/{$name}/', 'backoffice-template' => 'templates/backOffice/{$name}/', 'email-template' => 'templates/email/{$name}/');
}
