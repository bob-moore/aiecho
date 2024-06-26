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

use Mwf\Cornerstone\Deps\Symfony\Component\VarDumper\Cloner\Stub;
/**
 * Represents any arbitrary value.
 *
 * @author Alexandre Daubois <alex.daubois@gmail.com>
 * @internal
 */
class ScalarStub extends Stub
{
    public function __construct(mixed $value)
    {
        $this->value = $value;
    }
}
