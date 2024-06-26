<?php

declare (strict_types=1);
namespace Mwf\ChildTheme\Deps\DI\Proxy;

use Mwf\ChildTheme\Deps\ProxyManager\Configuration;
use Mwf\ChildTheme\Deps\ProxyManager\Factory\LazyLoadingValueHolderFactory;
use Mwf\ChildTheme\Deps\ProxyManager\FileLocator\FileLocator;
use Mwf\ChildTheme\Deps\ProxyManager\GeneratorStrategy\EvaluatingGeneratorStrategy;
use Mwf\ChildTheme\Deps\ProxyManager\GeneratorStrategy\FileWriterGeneratorStrategy;
use Mwf\ChildTheme\Deps\ProxyManager\Proxy\LazyLoadingInterface;
/**
 * Creates proxy classes.
 *
 * Wraps Ocramius/ProxyManager LazyLoadingValueHolderFactory.
 *
 * @see \ProxyManager\Factory\LazyLoadingValueHolderFactory
 *
 * @since  5.0
 * @author Matthieu Napoli <matthieu@mnapoli.fr>
 * @internal
 */
class ProxyFactory
{
    private ?LazyLoadingValueHolderFactory $proxyManager = null;
    /**
     * @param string|null $proxyDirectory If set, write the proxies to disk in this directory to improve performances.
     */
    public function __construct(private ?string $proxyDirectory = null)
    {
    }
    /**
     * Creates a new lazy proxy instance of the given class with
     * the given initializer.
     *
     * @param class-string $className name of the class to be proxied
     * @param \Closure $initializer initializer to be passed to the proxy
     */
    public function createProxy(string $className, \Closure $initializer) : LazyLoadingInterface
    {
        return $this->proxyManager()->createProxy($className, $initializer);
    }
    /**
     * Generates and writes the proxy class to file.
     *
     * @param class-string $className name of the class to be proxied
     */
    public function generateProxyClass(string $className) : void
    {
        // If proxy classes a written to file then we pre-generate the class
        // If they are not written to file then there is no point to do this
        if ($this->proxyDirectory) {
            $this->createProxy($className, function () {
            });
        }
    }
    private function proxyManager() : LazyLoadingValueHolderFactory
    {
        if ($this->proxyManager === null) {
            if (!\class_exists(Configuration::class)) {
                throw new \RuntimeException('The ocramius/proxy-manager library is not installed. Lazy injection requires that library to be installed with Composer in order to work. Run "composer require ocramius/proxy-manager:~2.0".');
            }
            $config = new Configuration();
            if ($this->proxyDirectory) {
                $config->setProxiesTargetDir($this->proxyDirectory);
                $config->setGeneratorStrategy(new FileWriterGeneratorStrategy(new FileLocator($this->proxyDirectory)));
                // @phpstan-ignore-next-line
                \spl_autoload_register($config->getProxyAutoloader());
            } else {
                $config->setGeneratorStrategy(new EvaluatingGeneratorStrategy());
            }
            $this->proxyManager = new LazyLoadingValueHolderFactory($config);
        }
        return $this->proxyManager;
    }
}
