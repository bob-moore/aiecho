<?php

declare (strict_types=1);
namespace Mwf\ChildTheme\Deps\DI;

use Mwf\ChildTheme\Deps\Psr\Container\ContainerExceptionInterface;
/**
 * Exception for the Container.
 * @internal
 */
class DependencyException extends \Exception implements ContainerExceptionInterface
{
}
