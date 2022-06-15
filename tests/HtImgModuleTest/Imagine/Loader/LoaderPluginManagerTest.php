<?php
namespace HtImgModuleTest\Imagine\Loader;

use HtImgModule\Imagine\Loader\LoaderPluginManager;
use Laminas\ServiceManager\Exception\InvalidServiceException;
use Laminas\ServiceManager\ServiceManager;

class LoaderPluginManagerTest extends \PHPUnit_Framework_TestCase
{
    public function testValidatePlugin()
    {
        $loader = $this->createMock('HtImgModule\Imagine\Loader\LoaderInterface');
        $loaders = new LoaderPluginManager(new ServiceManager());
        $this->assertEquals(null, $loaders->validatePlugin($loader));
    }

    public function testGetExceptionWithInvalidLoader()
    {
        $loaders = new LoaderPluginManager(new ServiceManager());
        $this->setExpectedException('HtImgModule\Exception\InvalidArgumentException');

        $loaders->validatePlugin(new \ArrayObject);
    }
}
