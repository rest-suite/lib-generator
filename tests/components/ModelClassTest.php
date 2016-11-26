<?php
namespace bc\rest\tests;


use bc\rest\components\model\ModelClassInterface;
use Codeception\Test\Unit;

class ModelClassTest extends Unit {

    const CODE_PATH = __DIR__.'/../_data/simple/TestModel.php';

    /**
     * @var \bc\rest\tests\ComponentsTester
     */
    protected $tester;

    /**
     * @var ModelClassInterface
     */
    private $model;

    /**
     * @var string
     */
    private $code;

    // tests
    public function testCreate() {
        $this->model->setName('Test');
        $this->model->setNamespace('test\\simple');
        $this->model->createDefaults();

        $this->assertEquals($this->code, $this->model->getCode());
    }

    public function testLoad() {
        $this->model->loadFromFile(self::CODE_PATH);

        $this->assertEquals($this->code, $this->model->getCode());
    }

    protected function setUp() {
        $this->code = file_get_contents(self::CODE_PATH);

        $this->model = $this->createMock(ModelClassInterface::class);
        $this->model->method('getCode')->willReturn($this->code);

        return parent::setUp();
    }

}