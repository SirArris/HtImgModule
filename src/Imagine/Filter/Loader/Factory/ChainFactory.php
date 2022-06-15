<?php

namespace HtImgModule\Imagine\Filter\Loader\Factory;

use HtImgModule\Imagine\Filter\Loader\FilterLoaderPluginManager;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Laminas\ServiceManager\Exception\ServiceNotCreatedException;
use Laminas\ServiceManager\Exception\ServiceNotFoundException;
use Laminas\ServiceManager\ServiceLocatorInterface;
use Laminas\ServiceManager\FactoryInterface;
use HtImgModule\Imagine\Filter\Loader\Chain;

class ChainFactory implements FactoryInterface
{
    /**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string             $requestedName
     * @param  null|array         $options
     *
     * @return Chain
     * @throws ServiceNotFoundException if unable to resolve the service.
     * @throws ServiceNotCreatedException if an exception is raised when
     *     creating a service.
     * @throws ContainerException if any other error occurs
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        // For v2, we need to pull the parent service locator
        if (!method_exists($container, 'configure')) {
            $container = $container->getServiceLocator() ?: $container;
        }

        return new Chain($container->get(FilterLoaderPluginManager::class));
    }

    public function createService(ServiceLocatorInterface $filterLoaders)
    {
        return $this($filterLoaders, Chain::class);
    }
}
