<?php
namespace HtImgModuleTest\View\Helper;

use HtImgModule\View\Helper\DisplayImage;
use Laminas\ServiceManager\ServiceManager;
use Laminas\View\Renderer\PhpRenderer;
use Laminas\View\HelperPluginManager;

class DisplayImageTest extends \PHPUnit_Framework_TestCase
{
    public function testSetAttributes()
    {
        $helper = new DisplayImage;
        $helper->setAttributes(['class' => 'pull-right', 'foo' => 'bar']);
        $this->assertEquals(['class' => 'pull-right', 'foo' => 'bar'], $helper->getAttributes());
    }

    public function testInvoke()
    {
        $helper = new DisplayImage;
        $helper->setAttributes(['alt' => 'hello']);
        $renderer = new PhpRenderer;
        $serviceManager = new ServiceManager();
        if (!method_exists($serviceManager, 'configure')) {
            $helpers = new HelperPluginManager;
        } else {
            $helpers = new HelperPluginManager($serviceManager);
        }

        $renderer->setHelperPluginManager($helpers);

        $doctype = $this->createMock('Laminas\View\Helper\Doctype');
        $doctype->expects($this->once())
            ->method('isXhtml')
            ->will($this->returnValue(true));
        $helpers->setService('doctype', $doctype);

        $imgUrl = $this->getMockBuilder('HtImgModule\View\Helper\ImgUrl')
            ->disableOriginalConstructor()
            ->getMock();
        $imgUrl->expects($this->once())
            ->method('__invoke')
            ->will($this->returnValue('app'));
        $helpers->setService('HtImgModule\View\Helper\ImgUrl', $imgUrl);

        $helper->setView($renderer);
        $this->assertEquals('<img alt="hello" src="app" />', $helper('asdfsadf', 'asdfasfd'));
        $this->assertEquals($helper, $helper());
    }
}
