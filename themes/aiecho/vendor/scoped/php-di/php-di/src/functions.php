<?php

declare (strict_types=1);
namespace Mwf\ChildTheme\Deps\DI;

use Mwf\ChildTheme\Deps\DI\Definition\ArrayDefinitionExtension;
use Mwf\ChildTheme\Deps\DI\Definition\EnvironmentVariableDefinition;
use Mwf\ChildTheme\Deps\DI\Definition\Helper\AutowireDefinitionHelper;
use Mwf\ChildTheme\Deps\DI\Definition\Helper\CreateDefinitionHelper;
use Mwf\ChildTheme\Deps\DI\Definition\Helper\FactoryDefinitionHelper;
use Mwf\ChildTheme\Deps\DI\Definition\Reference;
use Mwf\ChildTheme\Deps\DI\Definition\StringDefinition;
use Mwf\ChildTheme\Deps\DI\Definition\ValueDefinition;
if (!\function_exists('Mwf\\ChildTheme\\Deps\\DI\\value')) {
    /**
     * Helper for defining a value.
     * @internal
     */
    function value(mixed $value) : ValueDefinition
    {
        return new ValueDefinition($value);
    }
}
if (!\function_exists('Mwf\\ChildTheme\\Deps\\DI\\create')) {
    /**
     * Helper for defining an object.
     *
     * @param string|null $className Class name of the object.
     *                               If null, the name of the entry (in the container) will be used as class name.
     * @internal
     */
    function create(string $className = null) : CreateDefinitionHelper
    {
        return new CreateDefinitionHelper($className);
    }
}
if (!\function_exists('Mwf\\ChildTheme\\Deps\\DI\\autowire')) {
    /**
     * Helper for autowiring an object.
     *
     * @param string|null $className Class name of the object.
     *                               If null, the name of the entry (in the container) will be used as class name.
     * @internal
     */
    function autowire(string $className = null) : AutowireDefinitionHelper
    {
        return new AutowireDefinitionHelper($className);
    }
}
if (!\function_exists('Mwf\\ChildTheme\\Deps\\DI\\factory')) {
    /**
     * Helper for defining a container entry using a factory function/callable.
     *
     * @param callable|array|string $factory The factory is a callable that takes the container as parameter
     *        and returns the value to register in the container.
     * @internal
     */
    function factory(callable|array|string $factory) : FactoryDefinitionHelper
    {
        return new FactoryDefinitionHelper($factory);
    }
}
if (!\function_exists('Mwf\\ChildTheme\\Deps\\DI\\decorate')) {
    /**
     * Decorate the previous definition using a callable.
     *
     * Example:
     *
     *     'foo' => decorate(function ($foo, $container) {
     *         return new CachedFoo($foo, $container->get('cache'));
     *     })
     *
     * @param callable $callable The callable takes the decorated object as first parameter and
     *                           the container as second.
     * @internal
     */
    function decorate(callable|array|string $callable) : FactoryDefinitionHelper
    {
        return new FactoryDefinitionHelper($callable, \true);
    }
}
if (!\function_exists('Mwf\\ChildTheme\\Deps\\DI\\get')) {
    /**
     * Helper for referencing another container entry in an object definition.
     * @internal
     */
    function get(string $entryName) : Reference
    {
        return new Reference($entryName);
    }
}
if (!\function_exists('Mwf\\ChildTheme\\Deps\\DI\\env')) {
    /**
     * Helper for referencing environment variables.
     *
     * @param string $variableName The name of the environment variable.
     * @param mixed $defaultValue The default value to be used if the environment variable is not defined.
     * @internal
     */
    function env(string $variableName, mixed $defaultValue = null) : EnvironmentVariableDefinition
    {
        // Only mark as optional if the default value was *explicitly* provided.
        $isOptional = 2 === \func_num_args();
        return new EnvironmentVariableDefinition($variableName, $isOptional, $defaultValue);
    }
}
if (!\function_exists('Mwf\\ChildTheme\\Deps\\DI\\add')) {
    /**
     * Helper for extending another definition.
     *
     * Example:
     *
     *     'log.backends' => DI\add(DI\get('My\Custom\LogBackend'))
     *
     * or:
     *
     *     'log.backends' => DI\add([
     *         DI\get('My\Custom\LogBackend')
     *     ])
     *
     * @param mixed|array $values A value or an array of values to add to the array.
     *
     * @since 5.0
     * @internal
     */
    function add($values) : ArrayDefinitionExtension
    {
        if (!\is_array($values)) {
            $values = [$values];
        }
        return new ArrayDefinitionExtension($values);
    }
}
if (!\function_exists('Mwf\\ChildTheme\\Deps\\DI\\string')) {
    /**
     * Helper for concatenating strings.
     *
     * Example:
     *
     *     'log.filename' => DI\string('{app.path}/app.log')
     *
     * @param string $expression A string expression. Use the `{}` placeholders to reference other container entries.
     *
     * @since 5.0
     * @internal
     */
    function string(string $expression) : StringDefinition
    {
        return new StringDefinition($expression);
    }
}
