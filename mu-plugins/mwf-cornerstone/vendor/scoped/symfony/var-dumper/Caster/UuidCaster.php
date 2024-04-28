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

use Mwf\Cornerstone\Deps\Ramsey\Uuid\UuidInterface;
use Mwf\Cornerstone\Deps\Symfony\Component\VarDumper\Cloner\Stub;
/**
 * @author Grégoire Pineau <lyrixx@lyrixx.info>
 * @internal
 */
final class UuidCaster
{
    public static function castRamseyUuid(UuidInterface $c, array $a, Stub $stub, bool $isNested) : array
    {
        $a += [Caster::PREFIX_VIRTUAL . 'uuid' => (string) $c];
        return $a;
    }
}
