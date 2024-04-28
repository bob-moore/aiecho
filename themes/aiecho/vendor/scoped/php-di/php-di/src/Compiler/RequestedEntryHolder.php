<?php

declare (strict_types=1);
namespace Mwf\ChildTheme\Deps\DI\Compiler;

use Mwf\ChildTheme\Deps\DI\Factory\RequestedEntry;
/**
 * @author Matthieu Napoli <matthieu@mnapoli.fr>
 * @internal
 */
class RequestedEntryHolder implements RequestedEntry
{
    public function __construct(private string $name)
    {
    }
    public function getName() : string
    {
        return $this->name;
    }
}
