<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Mwf\Cornerstone\Deps\Symfony\Component\VarDumper\Caster;

/**
 * Represents an uninitialized property.
 *
 * @author Nicolas Grekas <p@tchwork.com>
 * @internal
 */
class UninitializedStub extends ConstStub
{
    public function __construct(\ReflectionProperty $property)
    {
        parent::__construct('?' . ($property->hasType() ? ' ' . $property->getType() : ''), 'Uninitialized property');
    }
}
