<?php

declare (strict_types=1);
namespace Mwf\Cornerstone\Deps\DI;

use Mwf\Cornerstone\Deps\Psr\Container\ContainerExceptionInterface;
/**
 * Exception for the Container.
 * @internal
 */
class DependencyException extends \Exception implements ContainerExceptionInterface
{
}
