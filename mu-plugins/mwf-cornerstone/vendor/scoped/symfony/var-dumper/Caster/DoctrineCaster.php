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

use Mwf\Cornerstone\Deps\Doctrine\Common\Proxy\Proxy as CommonProxy;
use Mwf\Cornerstone\Deps\Doctrine\ORM\PersistentCollection;
use Mwf\Cornerstone\Deps\Doctrine\ORM\Proxy\Proxy as OrmProxy;
use Mwf\Cornerstone\Deps\Symfony\Component\VarDumper\Cloner\Stub;
/**
 * Casts Doctrine related classes to array representation.
 *
 * @author Nicolas Grekas <p@tchwork.com>
 *
 * @final
 * @internal
 */
class DoctrineCaster
{
    /**
     * @return array
     */
    public static function castCommonProxy(CommonProxy $proxy, array $a, Stub $stub, bool $isNested)
    {
        foreach (['__cloner__', '__initializer__'] as $k) {
            if (\array_key_exists($k, $a)) {
                unset($a[$k]);
                ++$stub->cut;
            }
        }
        return $a;
    }
    /**
     * @return array
     */
    public static function castOrmProxy(OrmProxy $proxy, array $a, Stub $stub, bool $isNested)
    {
        foreach (['_entityPersister', '_identifier'] as $k) {
            if (\array_key_exists($k = "\x00Doctrine\\ORM\\Proxy\\Proxy\x00" . $k, $a)) {
                unset($a[$k]);
                ++$stub->cut;
            }
        }
        return $a;
    }
    /**
     * @return array
     */
    public static function castPersistentCollection(PersistentCollection $coll, array $a, Stub $stub, bool $isNested)
    {
        foreach (['snapshot', 'association', 'typeClass'] as $k) {
            if (\array_key_exists($k = "\x00Doctrine\\ORM\\PersistentCollection\x00" . $k, $a)) {
                $a[$k] = new CutStub($a[$k]);
            }
        }
        return $a;
    }
}
