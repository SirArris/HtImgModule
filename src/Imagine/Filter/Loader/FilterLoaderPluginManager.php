<?php
namespace HtImgModule\Imagine\Filter\Loader;

use Laminas\ServiceManager\AbstractPluginManager;
use HtImgModule\Exception;
use Laminas\ServiceManager\Exception\InvalidServiceException;
use Laminas\ServiceManager\Factory\InvokableFactory;

class FilterLoaderPluginManager extends AbstractPluginManager
{
    protected $instanceOf = LoaderInterface::class;

    protected $aliases  = [
        'Crop' => Crop::class,
        'crop' => Crop::class,
        'RelativeResize' => RelativeResize::class,
        'relativeResize' => RelativeResize::class,
        'relativeresize' => RelativeResize::class,
        'Resize' => Resize::class,
        'resize' => Resize::class,
        'Thumbnail' => Thumbnail::class,
        'thumbnail' => Thumbnail::class,
    ];

    protected $factories = [
        'chain' => 'HtImgModule\Imagine\Filter\Loader\Factory\ChainFactory',
        'paste' => 'HtImgModule\Imagine\Filter\Loader\Factory\PasteFactory',
        'watermark' => 'HtImgModule\Imagine\Filter\Loader\Factory\WatermarkFactory',
        'background' => 'HtImgModule\Imagine\Filter\Loader\Factory\BackgroundFactory',
        Crop::class => InvokableFactory::class,
        RelativeResize::class => InvokableFactory::class,
        Resize::class => InvokableFactory::class,
        Thumbnail::class => InvokableFactory::class,
    ];

    public function validate($instance)
    {
        if (!$instance instanceof $this->instanceOf) {
            throw new InvalidServiceException(sprintf(
                'Invalid plugin "%s" created; not an instance of %s',
                get_class($instance),
                $this->instanceOf
            ));
        }
    }

    public function validatePlugin($instance)
    {
        try {
            $this->validate($instance);
        } catch (InvalidServiceException $e) {
            throw new Exception\InvalidArgumentException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
