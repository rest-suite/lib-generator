<?php
namespace bc\rest\tests;


use bc\rest\components\BootstrapClassInterface;
use Codeception\Test\Unit;

class BootstrapClassTest extends Unit {

    const CODE_PATH = __DIR__.'/../_data/simple/Bootstrap.php';

    /**
     * @var \bc\rest\tests\ComponentsTester
     */
    protected $tester;

    /**
     * @var BootstrapClassInterface
     */
    private $bootstrap;

    /**
     * @var string
     */
    private $code;

    // tests
    public function testCreate() {
        $this->bootstrap->createDefaults();
        $this->assertEquals('Bootstrap', $this->bootstrap->getName());
    }

    public function testLoad() {
        $this->bootstrap->loadFromFile(self::CODE_PATH);
        $this->assertEquals($this->code, $this->bootstrap->getCode());
    }

    protected function setUp() {
        $this->code = file_get_contents(self::CODE_PATH);

        $this->bootstrap = $this->createMock(BootstrapClassInterface::class);
        $this->bootstrap->method('getName')->willReturn('Bootstrap');
        $this->bootstrap->method('getCode')->willReturn($this->code);

        return parent::setUp();
    }

}