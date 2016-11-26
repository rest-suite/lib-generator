<?php
namespace bc\rest\tests;


use bc\rest\components\controller\ControllerClassInterface;
use Codeception\Test\Unit;

class ControllerClassTest extends Unit {

    const CODE_PATH = __DIR__.'/../_data/simple/TestController.php';

    /**
     * @var \bc\rest\tests\ComponentsTester
     */
    protected $tester;
    /**
     * @var ControllerClassInterface
     */
    private $controller;

    /**
     * @var string
     */
    private $code;

    // tests
    public function testCreate() {
        $this->controller->setName('Test');
        $this->controller->setFileExt('php');
        $this->controller->setNamespace('test\\simple');
        $this->controller->createDefaults();

        $this->assertEquals($this->code, $this->controller->getCode());
    }

    public function testLoad() {
        $this->controller->loadFromFile(self::CODE_PATH);

        $this->assertEquals($this->code, $this->controller->getCode());
    }

    protected function setUp() {
        $this->code = file_get_contents(self::CODE_PATH);

        $this->controller = $this->createMock(ControllerClassInterface::class);
        $this->controller->method('getCode')->willReturn($this->code);

        return parent::setUp();
    }

}