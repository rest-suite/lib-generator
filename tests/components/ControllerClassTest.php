<?php
namespace bc\rest\tests;


use bc\rest\components\controller\ControllerClassInterface;
use bc\rest\components\controller\ControllerComponent;
use bc\rest\components\controller\Endpoint;
use bc\rest\components\controller\EndpointInterface;
use Codeception\Test\Unit;
use gossi\codegen\model\PhpMethod;

class ControllerClassTest extends Unit {

    const CODE_PATH = __DIR__.'/../_data/simple/TestController.php';
    const PARTIAL_PATH = __DIR__.'/../_data/simple/TestPartialController.php';
    const ENDPOINT_PATH = __DIR__.'/../_data/simple/TestEndpointController.php';

    /**
     * @var \bc\rest\tests\ComponentsTester
     */
    protected $tester;
    /**
     * @var ControllerComponent
     */
    private $controller;

    // tests
    public function testCreate() {
        $this->controller->setName('TestController');
        $this->controller->setFileExt('php');
        $this->controller->setNamespace('test\\simple');
        $this->controller->createDefaults();

        $this->assertStringEqualsFile(self::CODE_PATH, "<?php\n\n".$this->controller->getCode(), $this->controller->getCode());
    }

    public function testLoad() {
        $this->controller->loadFromFile(self::CODE_PATH);

        $this->assertStringEqualsFile(self::CODE_PATH, "<?php\n\n".$this->controller->getCode());
    }

    public function testSync() {
        $this->controller->loadFromFile(self::PARTIAL_PATH);

        $this->assertTrue($this->controller->hasProperty('ci'));
        $this->assertTrue($this->controller->hasMethod('__construct'));
        $this->assertContains('$this->ci = $ci;', $this->controller->getConstructor()->getBody());
    }

    public function testEndpoints() {
        $this->controller->setName('TestController');
        $this->controller->setFileExt('php');
        $this->controller->setNamespace('test\\simple');
        $this->controller->createDefaults();

        $endpoint = new Endpoint('getItem');
        $endpoint->setDescription('get item');

        $this->controller->addEndpoint($endpoint);

        $ep = $this->controller->getEndpoint('getItem');
        $ep->setApiTag('GET', '/{id}');
        $ep->addResponseTag('200', 'success');
        $ep->setRequestParameter('id',
                                 [
                                     'type' => 'int',
                                     'init' => [
                                         "/** @var int \$id */",
                                         "\$id = isset(\$args['id']) ? \$args['id'] : null;",
                                     ],
                                 ]);

        $code = $this->controller->getCode();

        $this->assertStringEqualsFile(self::ENDPOINT_PATH, "<?php\n\n".$code, $code);
    }

    protected function setUp() {
        $this->controller = new ControllerComponent();

        return parent::setUp();
    }

}