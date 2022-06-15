<?php
namespace HtImgModuleTest\Imagine\Filter\Loader\Factory;

use HtImgModule\Imagine\Filter\Loader\Factory\WatermarkFactory;
use Laminas\ServiceManager\ServiceManager;
use Imagine\Gd\Imagine;

class WatermarkFactoryTest extends \PHPUnit_Framework_Testcase
{
    public function testFactory()
    {
        $serviceManager = new ServiceManager;
        $serviceManager->setService('HtImg\Imagine', new Imagine);
        $serviceManager->setService('HtImg\RelativePathResolver', $this->createMock('Laminas\View\Resolver\ResolverInterface'));
        $loaders = $this->getMockBuilder('Laminas\ServiceManager\AbstractPluginManager')
            ->disableOriginalConstructor()
            ->getMock();
        if (!method_exists($serviceManager, 'configure')) {
            $loaders->expects($this->any())
                ->method('getServiceLocator')
               ->will($this->returnValue($serviceManager));
        } else {
            $loaders = $serviceManager;
        }
        $factory = new WatermarkFactory();
        $loader = $factory->createService($loaders);
        $this->assertInstanceOf('HtImgModule\Imagine\Filter\Loader\Watermark', $loader);
    }
}
