<?php
namespace HtImgModule;

use HtImgModule\View\Helper\DisplayImage;
use HtImgModule\View\Helper\Factory\ImgUrlFactory;
use HtImgModule\View\Helper\ImgUrl;
use Laminas\ModuleManager\Feature\AutoloaderProviderInterface;
use Laminas\ModuleManager\Feature\ConfigProviderInterface;
use Laminas\ModuleManager\Feature\ServiceProviderInterface;
use Laminas\ModuleManager\Feature\ViewHelperProviderInterface;
use Laminas\ServiceManager\Factory\InvokableFactory;

class Module implements
    AutoloaderProviderInterface,
    ConfigProviderInterface,
    ServiceProviderInterface,
    ViewHelperProviderInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    /**
     * {@inheritDoc}
     */
    public function getAutoloaderConfig()
    {
        return [
            'Laminas\Loader\StandardAutoloader' => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__ . '/src',
                ],
            ],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function getServiceConfig()
    {
        return [
            'factories' => [
                'HtImg\ModuleOptions' => 'HtImgModule\Factory\ModuleOptionsFactory',
                'HtImg\Imagine' => 'HtImgModule\Factory\ImagineFactory',
                'HtImg\RelativePathResolver' => 'HtImgModule\Factory\RelativePathResolverFactory',
                'HtImgModule\Service\ImageService' => 'HtImgModule\Factory\ImageServiceFactory',
                'HtImgModule\View\Strategy\ImageStrategy' => 'HtImgModule\Factory\ImageStrategyFactory',
                'HtImgModule\Imagine\Filter\Loader\FilterLoaderPluginManager' => 'HtImgModule\Factory\FilterLoaderPluginManagerFactory',
                'HtImgModule\Imagine\Filter\FilterManager' => 'HtImgModule\Factory\FilterManagerFactory',
                'HtImgModule\Imagine\Resolver\ResolverManager' => 'HtImgModule\Factory\ResolverManagerFactory',
                'HtImgModule\Service\CacheManager' => 'HtImgModule\Factory\CacheManagerFactory',
                'HtImgModule\Imagine\Loader\LoaderPluginManager' => 'HtImgModule\Factory\Imagine\Loader\LoaderPluginManagerFactory',
                'HtImgModule\Imagine\Loader\LoaderManager' => 'HtImgModule\Factory\Imagine\Loader\LoaderManagerFactory',
                'HtImgModule\Binary\MimeTypeGuesser' => 'HtImgModule\Factory\MimeTypeGuesserFactory',
            ]
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function getViewHelperConfig()
    {
        return [
            'factories' => [
                ImgUrl::class => ImgUrlFactory::class,
                DisplayImage::class => InvokableFactory::class,
            ],
            'aliases' => [
                'htDisplayImage' => DisplayImage::class,
                'htImgUrl' => ImgUrl::class,
            ]
        ];
    }
}
