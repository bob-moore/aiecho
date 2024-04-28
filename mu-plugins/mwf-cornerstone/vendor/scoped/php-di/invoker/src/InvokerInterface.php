<?php

declare (strict_types=1);
namespace Mwf\Cornerstone\Deps\Invoker;

use Mwf\Cornerstone\Deps\Invoker\Exception\InvocationException;
use Mwf\Cornerstone\Deps\Invoker\Exception\NotCallableException;
use Mwf\Cornerstone\Deps\Invoker\Exception\NotEnoughParametersException;
/**
 * Invoke a callable.
 * @internal
 */
interface InvokerInterface
{
    /**
     * Call the given function using the given parameters.
     *
     * @param callable|array|string $callable Function to call.
     * @param array $parameters Parameters to use.
     * @return mixed Result of the function.
     * @throws InvocationException Base exception class for all the sub-exceptions below.
     * @throws NotCallableException
     * @throws NotEnoughParametersException
     */
    public function call($callable, array $parameters = []);
}
