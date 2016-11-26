<?php
namespace bc\rest\tests;


use bc\rest\generator\ComponentContainerInterface;
use bc\rest\generator\ExtensionInterface;
use Codeception\Test\Unit;
use gossi\swagger\Swagger;
use Symfony\Component\Yaml\Yaml;

class ExtensionTest extends Unit {

    /**
     * @var \bc\rest\tests\GeneratorTester
     */
    protected $tester;

    /**
     * @var ExtensionInterface
     */
    private $ext;
    /**
     * @var Swagger
     */
    private $specs;

    // tests
    public function testProcess() {
        $container = $this->createMock(ComponentContainerInterface::class);
        $container->method('getComponents')->willReturn(['test' => null]);

        $this->ext->processSpecs($container, $this->specs);

        /** @var ComponentContainerInterface $container */
        $this->assertCount(1, $container->getComponents());
    }

    protected function setUp() {
        $this->ext = $this->createMock(ExtensionInterface::class);

        $swagger = Yaml::parse(file_get_contents(__DIR__.'/../_data/simple.swagger.yml'));
        $this->specs = new Swagger($swagger);

        return parent::setUp();
    }

}