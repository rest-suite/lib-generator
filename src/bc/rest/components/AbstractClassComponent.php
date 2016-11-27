<?php


namespace bc\rest\components;


use bc\rest\generator\CodegenRegistry;
use gossi\codegen\model\PhpClass;
use gossi\codegen\model\PhpMethod;
use gossi\codegen\parser\FileParser;
use gossi\codegen\parser\visitor\ClassParserVisitor;
use gossi\codegen\parser\visitor\ConstantParserVisitor;
use gossi\codegen\parser\visitor\MethodParserVisitor;
use gossi\codegen\parser\visitor\PropertyParserVisitor;

abstract class AbstractClassComponent extends PhpClass implements ClassInterface {

    /** @var bool */
    private $loaded = false;
    /** @var string */
    private $fileExt = 'php';

    /**
     * Get component constructor
     *
     * @return PhpMethod
     */
    public function getConstructor() {
        if(!$this->hasMethod('__construct')) $this->setMethod(PhpMethod::create('__construct'));

        return $this->getMethod('__construct');
    }

    /**
     * Add use statement for imported component if needed
     *
     * @param ClassInterface $component
     */
    public function useClassComponent(ClassInterface $component) {
        if($this->getNamespace() != $component->getNamespace()) {
            /** @var AbstractClassComponent $component */
            $this->addUseStatement($component->getQualifiedName());
        }
    }

    /**
     * Load component data from file
     *
     * @param string $filename file to load
     *
     * @param array $parts     custom names of parts to generate
     *                         depends on specific component
     *                         empty array - generate all parts
     *                         key - name of part (must use class constants)
     *                         value - mixed. if no named-key - name of part
     *
     * @param array $options   options for loading
     */
    public function loadFromFile($filename, $parts = [], $options = []) {
        $parser = new FileParser($filename);
        $parser->addVisitor(new ClassParserVisitor($this));
        $parser->addVisitor(new MethodParserVisitor($this));
        $parser->addVisitor(new ConstantParserVisitor($this));
        $parser->addVisitor(new PropertyParserVisitor($this));

        $parser->parse();
        $this->createDefaults($parts, $options);
    }

    /**
     * Generate component with default data
     *
     * @param array $parts   custom names of parts to generate
     *                       depends on specific component
     *                       empty array - generate all parts
     *                       key - name of part (must use class constants)
     *                       value - mixed. if no named-key - name of part
     *
     * @param array $options options for default data generation
     */
    public function createDefaults($parts = [], $options = []) {
    }

    /**
     * Get file extension for component
     * can be empty
     *
     * @return string
     */
    public function getFileExt() {
        return $this->fileExt;
    }

    /**
     * Set component file extension
     *
     * @param string $ext extension
     */
    public function setFileExt($ext) {
        $this->fileExt = $ext;
    }

    /**
     * Get class component code
     */
    public function getCode() {
        $gen = CodegenRegistry::create('default', ['generateEmptyDocblock' => false]);

        //sorry, hate tabs =)
        return str_replace("\t", '    ', $gen->generate($this));
    }
}