<?php


namespace bc\rest\components;


use bc\rest\generator\CodegenRegistry;
use gossi\codegen\model\GenerateableInterface;

trait CodeTrait {

    /**
     * Get component code
     *
     * @return string
     */
    public function getCode() {
        $gen = CodegenRegistry::create('default', ['generateEmptyDocblock' => false]);

        //sorry, hate tabs =)
        /** @var GenerateableInterface $this */
        return str_replace("\t", '    ', $gen->generate($this));
    }
}