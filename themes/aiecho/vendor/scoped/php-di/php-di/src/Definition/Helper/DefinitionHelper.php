<?php

declare (strict_types=1);
namespace Mwf\ChildTheme\Deps\DI\Definition\Helper;

use Mwf\ChildTheme\Deps\DI\Definition\Definition;
/**
 * Helps defining container entries.
 *
 * @author Matthieu Napoli <matthieu@mnapoli.fr>
 * @internal
 */
interface DefinitionHelper
{
    /**
     * @param string $entryName Container entry name
     */
    public function getDefinition(string $entryName) : Definition;
}
