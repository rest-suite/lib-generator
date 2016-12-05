<?php
namespace bc\rest\tests;


use bc\rest\components\BootstrapClassInterface;
use bc\rest\components\BootstrapComponent;
use Codeception\Test\Unit;

class BootstrapClassTest extends Unit {

    const CODE_PATH = __DIR__.'/../_data/simple/Bootstrap.php';

    /**
     * @var \bc\rest\tests\ComponentsTester
     */
    protected $tester;

    /**
     * @var BootstrapComponent
     */
    private $bootstrap;

    // tests
    public function testCreateEmpty() {
        $this->bootstrap->createDefaults();
        $this->bootstrap->setNamespace('test\\simple');

        $this->assertEquals(BootstrapComponent::METHOD_PROCESS_REQUEST, $this->bootstrap->getErrorProcessing()->getName());

        $code = $this->bootstrap->getCode();
        $this->assertStringEqualsFile(self::CODE_PATH, "<?php\n\n".$code, $code);
    }

    public function testLoad() {
        $this->bootstrap->loadFromFile(self::CODE_PATH);
        $code = $this->bootstrap->getCode();
        $this->assertStringEqualsFile(self::CODE_PATH, "<?php\n\n".$code, $code);
    }

    protected function setUp() {

        $this->bootstrap = new BootstrapComponent();

        return parent::setUp();
    }

}