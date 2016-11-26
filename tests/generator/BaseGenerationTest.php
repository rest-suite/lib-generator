<?php
namespace bc\rest\tests;

use bc\rest\components\ComponentInterface;
use bc\rest\exceptions\Exception;
use bc\rest\generator\ComponentContainerInterface;
use bc\rest\generator\ExtensionInterface;
use bc\rest\generator\GeneratorInterface;
use Codeception\Test\Unit;

class BaseGenerationTest extends Unit {

    /**
     * @var \bc\rest\tests\GeneratorTester
     */
    protected $tester;
    /**
     * @var GeneratorInterface
     */
    private $generator;

    public function testAddAndGetExtension() {
        $ext = $this->getMockBuilder(ExtensionInterface::class)
                    ->getMock();
        $this->generator->addExtension($ext);

        $this->assertInstanceOf(ExtensionInterface::class, $this->generator->getExtension(ExtensionInterface::class));
        $this->assertCount(1, $this->generator->getExtensions());
    }

    public function testDisabledExtensions() {
        $ext = $this->getMockBuilder(ExtensionInterface::class)
                    ->getMock();
        $this->generator->addExtension($ext);

        $this->assertCount(1, $this->generator->getExtensions());
        $this->assertCount(0, $this->generator->getDisabledExtensions());

        $this->generator->disableExtension(ExtensionInterface::class);

        $this->assertCount(0, $this->generator->getExtensions());
        $this->assertCount(1, $this->generator->getDisabledExtensions());
    }

    /**
     * @expectedException Exception
     */
    public function testNonExistsExtension() {
        $generator = $this->generator;

        $generator->method('getExtension')
                  ->with('non exists')
                  ->willThrowException(new Exception());

        $generator->getExtension('non exists');
    }

    public function testProcess() {
        $ext = $this->getMockBuilder(ExtensionInterface::class)
                    ->getMock();

        $this->generator->addExtension($ext);
        $this->generator->process();

        $components = $this->generator->getComponents();

        $testComponent = $components->getComponent('test');

        $this->assertInstanceOf(ComponentInterface::class, $testComponent);
        $this->assertEquals('txt', $testComponent->getFileExt());
    }

    // tests

    protected function setUp() {
        $component = $this->getMockBuilder(ComponentInterface::class)->getMock();
        $component->method('getFileExt')->willReturn('txt');

        $container = $this->getMockBuilder(ComponentContainerInterface::class)->getMock();
        $container->method('getComponent')
                  ->with('test')
                  ->willReturn($component);

        /*$swagger = Yaml::parse(file_get_contents(__DIR__.'/../_data/simple.swagger.yml'));

        $this->generator = new Generator($swagger, __DIR__.'/../_output/generated/');*/

        $this->generator = $this->createMock(GeneratorInterface::class);

        $this->generator->method('getComponents')
                        ->willReturn($container);

        $ext = $this->createMock(ExtensionInterface::class);

        $this->generator->method('getExtension')
                        ->with(ExtensionInterface::class)
                        ->willReturn($ext);

        $this->generator->method('getExtensions')
                        ->will($this->onConsecutiveCalls([$ext], []));
        $this->generator->method('getDisabledExtensions')
                        ->will($this->onConsecutiveCalls([], [$ext]));

        return parent::setUp();
    }
}