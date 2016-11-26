<?php
namespace bc\rest\tests;

use bc\rest\components\ComposerInterface;
use Codeception\Test\Unit;

class ComposerTest extends Unit {

    const CODE_PATH = __DIR__.'/../_data/simple/composer.json';

    /**
     * @var \bc\rest\tests\ComponentsTester
     */
    protected $tester;

    /**
     * @var ComposerInterface
     */
    private $composer;

    /**
     * @var string
     */
    private $code;

    // tests
    public function testCreateComposer() {
        $this->composer->createDefaults();
        $this->assertJsonStringEqualsJsonString(
            json_encode(['name' => 'test/test']),
            $this->composer->getCode()
        );
    }

    public function testLoadComposer() {
        $this->composer->loadFromFile(self::CODE_PATH);
        $this->assertEquals($this->code, $this->composer->getCode());
    }

    protected function setUp() {
        $this->code = file_get_contents(self::CODE_PATH);

        $this->composer = $this->createMock(ComposerInterface::class);
        $this->composer->method('getCode')->willReturn($this->code);

        return parent::setUp();
    }

}