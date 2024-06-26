<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Mwf\ChildTheme\Deps\Twig\Extension;

use Mwf\ChildTheme\Deps\Twig\ExpressionParser;
use Mwf\ChildTheme\Deps\Twig\Node\Expression\Binary\AbstractBinary;
use Mwf\ChildTheme\Deps\Twig\Node\Expression\Unary\AbstractUnary;
use Mwf\ChildTheme\Deps\Twig\NodeVisitor\NodeVisitorInterface;
use Mwf\ChildTheme\Deps\Twig\TokenParser\TokenParserInterface;
use Mwf\ChildTheme\Deps\Twig\TwigFilter;
use Mwf\ChildTheme\Deps\Twig\TwigFunction;
use Mwf\ChildTheme\Deps\Twig\TwigTest;
/**
 * Interface implemented by extension classes.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 * @internal
 */
interface ExtensionInterface
{
    /**
     * Returns the token parser instances to add to the existing list.
     *
     * @return TokenParserInterface[]
     */
    public function getTokenParsers();
    /**
     * Returns the node visitor instances to add to the existing list.
     *
     * @return NodeVisitorInterface[]
     */
    public function getNodeVisitors();
    /**
     * Returns a list of filters to add to the existing list.
     *
     * @return TwigFilter[]
     */
    public function getFilters();
    /**
     * Returns a list of tests to add to the existing list.
     *
     * @return TwigTest[]
     */
    public function getTests();
    /**
     * Returns a list of functions to add to the existing list.
     *
     * @return TwigFunction[]
     */
    public function getFunctions();
    /**
     * Returns a list of operators to add to the existing list.
     *
     * @return array<array> First array of unary operators, second array of binary operators
     *
     * @psalm-return array{
     *     array<string, array{precedence: int, class: class-string<AbstractUnary>}>,
     *     array<string, array{precedence: int, class: class-string<AbstractBinary>, associativity: ExpressionParser::OPERATOR_*}>
     * }
     */
    public function getOperators();
}
