<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Mwf\Cornerstone\Deps\Twig\Extension;

use Mwf\Cornerstone\Deps\Twig\ExpressionParser;
use Mwf\Cornerstone\Deps\Twig\Node\Expression\Binary\AbstractBinary;
use Mwf\Cornerstone\Deps\Twig\Node\Expression\Unary\AbstractUnary;
use Mwf\Cornerstone\Deps\Twig\NodeVisitor\NodeVisitorInterface;
use Mwf\Cornerstone\Deps\Twig\TokenParser\TokenParserInterface;
use Mwf\Cornerstone\Deps\Twig\TwigFilter;
use Mwf\Cornerstone\Deps\Twig\TwigFunction;
use Mwf\Cornerstone\Deps\Twig\TwigTest;
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
