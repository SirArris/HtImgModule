<?php
namespace HtImgModuleTest\Factory\Imagine\Loader;

use HtImgModule\Factory\Imagine\Loader\LoaderManagerFactory;
use Laminas\ServiceManager\ServiceManager;

class LoaderManagerFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testFactory()
    {
        $serviceManager     = new ServiceManager();
        $filterManager      = $this->createMock('HtImgModule\Imagine\Filter\FilterManagerInterface');
        $imageLoaders       = $this->createMock('Laminas\ServiceManager\ServiceLocatorInterface');
        $options            = $this->createMock('HtImgModule\Options\ModuleOptions');
        $mimeTypeGuesser    = $this->getMockBuilder('HtImgModule\Binary\MimeTypeGuesser')
            ->disableOriginalConstructor()
            ->getMock();

        $serviceManager->setService('HtImgModule\Imagine\Filter\FilterManager', $filterManager);
        $serviceManager->setService('HtImgModule\Imagine\Loader\LoaderPluginManager', $imageLoaders);
        $serviceManager->setService('HtImgModule\Binary\MimeTypeGuesser', $mimeTypeGuesser);
        $serviceManager->setService('HtImg\ModuleOptions', $options);

        $factory = new LoaderManagerFactory;
        $this->assertInstanceOf('HtImgModule\Imagine\Loader\LoaderManager', $factory->createService($serviceManager));
    }
}
