<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Mwf\ChildTheme\Deps\Twig\Node\Expression\Binary;

use Mwf\ChildTheme\Deps\Twig\Compiler;
/** @internal */
class InBinary extends AbstractBinary
{
    public function compile(Compiler $compiler) : void
    {
        $compiler->raw('twig_in_filter(')->subcompile($this->getNode('left'))->raw(', ')->subcompile($this->getNode('right'))->raw(')');
    }
    public function operator(Compiler $compiler) : Compiler
    {
        return $compiler->raw('in');
    }
}
