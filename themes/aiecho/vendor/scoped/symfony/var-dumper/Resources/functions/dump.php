<?php

namespace Mwf\ChildTheme\Deps;

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
use Mwf\ChildTheme\Deps\Symfony\Component\VarDumper\Caster\ScalarStub;
use Mwf\ChildTheme\Deps\Symfony\Component\VarDumper\VarDumper;
if (!\function_exists('Mwf\\ChildTheme\\Deps\\dump')) {
    /**
     * @author Nicolas Grekas <p@tchwork.com>
     * @author Alexandre Daubois <alex.daubois@gmail.com>
     * @internal
     */
    function dump(mixed ...$vars) : mixed
    {
        if (!$vars) {
            VarDumper::dump(new ScalarStub('🐛'));
            return null;
        }
        if (\array_key_exists(0, $vars) && 1 === \count($vars)) {
            VarDumper::dump($vars[0]);
            $k = 0;
        } else {
            foreach ($vars as $k => $v) {
                VarDumper::dump($v, \is_int($k) ? 1 + $k : $k);
            }
        }
        if (1 < \count($vars)) {
            return $vars;
        }
        return $vars[$k];
    }
}
if (!\function_exists('Mwf\\ChildTheme\\Deps\\dd')) {
    /** @internal */
    function dd(mixed ...$vars) : never
    {
        if (!\in_array(\PHP_SAPI, ['cli', 'phpdbg', 'embed'], \true) && !\headers_sent()) {
            \header('HTTP/1.1 500 Internal Server Error');
        }
        if (\array_key_exists(0, $vars) && 1 === \count($vars)) {
            VarDumper::dump($vars[0]);
        } else {
            foreach ($vars as $k => $v) {
                VarDumper::dump($v, \is_int($k) ? 1 + $k : $k);
            }
        }
        exit(1);
    }
}
