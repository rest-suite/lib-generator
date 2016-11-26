<?php
namespace bc\rest\tests;


use bc\rest\components\ComponentInterface;
use bc\rest\exceptions\Exception;
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
    public function testAddAndGet() {
        $component = $this->getMockBuilder(ComponentInterface::class)
                          ->getMock();

        $this->container->addComponent('test', $component);

        $this->assertInstanceOf(ComponentInterface::class, $this->container->getComponent('test'));
        $this->assertCount(1, $this->container->getComponents());
        $this->assertEquals(['test' => $component], $this->container->getComponents());
    }

    /**
     * @expectedException Exception
     */
    public function testGetNotExists() {
        $this->container->getComponent('test');
    }

    protected function setUp() {
        $this->container = new ComponentContainer();

        return parent::setUp();
    }

}