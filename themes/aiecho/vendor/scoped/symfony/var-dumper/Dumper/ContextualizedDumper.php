<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Mwf\ChildTheme\Deps\Symfony\Component\VarDumper\Dumper;

use Mwf\ChildTheme\Deps\Symfony\Component\VarDumper\Cloner\Data;
use Mwf\ChildTheme\Deps\Symfony\Component\VarDumper\Dumper\ContextProvider\ContextProviderInterface;
/**
 * @author Kévin Thérage <therage.kevin@gmail.com>
 * @internal
 */
class ContextualizedDumper implements DataDumperInterface
{
    private DataDumperInterface $wrappedDumper;
    private array $contextProviders;
    /**
     * @param ContextProviderInterface[] $contextProviders
     */
    public function __construct(DataDumperInterface $wrappedDumper, array $contextProviders)
    {
        $this->wrappedDumper = $wrappedDumper;
        $this->contextProviders = $contextProviders;
    }
    /**
     * @return string|null
     */
    public function dump(Data $data)
    {
        $context = $data->getContext();
        foreach ($this->contextProviders as $contextProvider) {
            $context[$contextProvider::class] = $contextProvider->getContext();
        }
        return $this->wrappedDumper->dump($data->withContext($context));
    }
}
