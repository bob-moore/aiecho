<?php

declare (strict_types=1);
namespace Mwf\ChildTheme\Deps\DI\Definition\Source;

use Mwf\ChildTheme\Deps\DI\Definition\Definition;
/**
 * Describes a definition source to which we can add new definitions.
 *
 * @author Matthieu Napoli <matthieu@mnapoli.fr>
 * @internal
 */
interface MutableDefinitionSource extends DefinitionSource
{
    public function addDefinition(Definition $definition) : void;
}
