<?php

declare (strict_types=1);
namespace Mwf\ChildTheme\Deps\DI;

use Mwf\ChildTheme\Deps\Psr\Container\NotFoundExceptionInterface;
/**
 * Exception thrown when a class or a value is not found in the container.
 * @internal
 */
class NotFoundException extends \Exception implements NotFoundExceptionInterface
{
}
