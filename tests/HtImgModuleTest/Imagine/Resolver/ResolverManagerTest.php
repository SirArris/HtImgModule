<?php
namespace HtImgModuleTest\Imagine\Resolver;

use HtImgModule\Imagine\Resolver\ResolverManager;
use Laminas\ServiceManager\Exception\InvalidServiceException;
use Laminas\ServiceManager\ServiceManager;

class ResolverManagerTest extends \PHPUnit_Framework_TestCase
{
    public function testGetExceptionWithInvalidResolver()
    {
        $serviceManager = new ServiceManager();
        if (!method_exists($serviceManager, 'configure')) {
            $resolverManager = new ResolverManager;
            $this->setExpectedException('HtImgModule\Exception\InvalidArgumentException');
        } else {
            $resolverManager = new ResolverManager($serviceManager);
            $this->setExpectedException(InvalidServiceException::class);
        }
        $resolverManager->setInvokableClass('abcd', 'ArrayObject');

        $resolverManager->get('abcd');
    }
}
