<?php
namespace HtImgModuleTest\Factory;

use Laminas\ServiceManager\ServiceManager;
use HtImgModule\Factory\FilterManagerFactory;
use HtImgModule\Options\ModuleOptions;
use HtImgModule\Imagine\Filter\Loader\FilterLoaderPluginManager;

class FilterManagerFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testFactory()
    {
        $serviceManager = new ServiceManager();
        $serviceManager->setService('HtImg\ModuleOptions', new ModuleOptions);
        if (!method_exists($serviceManager, 'configure')) {
            $pluginManager = new FilterLoaderPluginManager;
        } else {
            $pluginManager = new FilterLoaderPluginManager($serviceManager);
        }
        $serviceManager->setService('HtImgModule\Imagine\Filter\Loader\FilterLoaderPluginManager', $pluginManager);
        $factory = new FilterManagerFactory();
        $this->assertInstanceOf('HtImgModule\Imagine\Filter\FilterManager', $factory->createService($serviceManager));
    }
}
