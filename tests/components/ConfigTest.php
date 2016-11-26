<?php
namespace bc\rest\tests;


use bc\rest\components\ConfigInterface;
use Codeception\Test\Unit;

class ConfigTest extends Unit {

    const TEST_CODE = <<<EOT
<?php
return [
    'test' => 'value',
];
EOT;
    const CODE_PATH = __DIR__.'/../_data/simple/config.php';

    /**
     * @var \bc\rest\tests\ComponentsTester
     */
    protected $tester;
    /**
     * @var ConfigInterface
     */
    private $config;
    private $code;

    // tests
    public function testCreate() {
        $this->config->setName('config');
        $this->config->setFileExt('php');
        $this->config->setOption('test', 'value');

        $this->assertEquals(self::TEST_CODE, $this->config->getCode());
    }

    public function testLoad() {
        $this->config->loadFromFile(self::CODE_PATH);

        $this->assertEquals('value', $this->config->getOption('test'));
        $this->assertEquals(['test' => 'value'], $this->config->getOptions());
    }

    protected function setUp() {
        $this->code = file_get_contents(self::CODE_PATH);
        
        $this->config = $this->createMock(ConfigInterface::class);
        $this->config->method('getCode')->willReturn($this->code);
        $this->config->method('getOption')->willReturn('value');
        $this->config->method('getOptions')->willReturn(['test' => 'value']);

        return parent::setUp();
    }

}