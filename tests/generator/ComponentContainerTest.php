<?php
namespace bc\rest\tests;


use bc\rest\components\ComponentInterface;
use bc\rest\generator\ComponentContainer;
use bc\rest\generator\ComponentContainerInterface;
use Codeception\Test\Unit;

class ComponentContainerTest extends Unit {

    /**
     * @var \bc\rest\tests\GeneratorTester
     */
    protected $tester;

    /**
     * @var ComponentContainerInterface
     */
    private $container;

    // tests
    public function testAddAndGetComponents() {
        $component = $this->getMockBuilder(ComponentInterface::class)
                          ->getMock();

        $this->container->addComponent('test', $component);

        $this->assertInstanceOf(ComponentInterface::class, $this->container->getComponent('test'));
        $this->assertCount(1, $this->container->getComponents());
        $this->assertArrayHasKey('test', $this->container->getComponents());
    }

    protected function setUp() {
        $this->container = $this->getMockBuilder(ComponentContainerInterface::class)
                                ->getMock();

        $component = $this->getMockBuilder(ComponentInterface::class)
                          ->getMock();

        $this->container->method('getComponent')
                        ->with('test')
                        ->willReturn($component);
        $this->container->method('getComponents')
                        ->willReturn(['test' => $component]);

        return parent::setUp();
    }

}