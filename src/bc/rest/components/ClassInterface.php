<?php

namespace bc\rest\components;

use gossi\codegen\model\ConstantsInterface;
use gossi\codegen\model\DocblockInterface;
use gossi\codegen\model\GenerateableInterface;
use gossi\codegen\model\NamespaceInterface;
use gossi\codegen\model\PhpMethod;
use gossi\codegen\model\PropertiesInterface;
use gossi\codegen\model\TraitsInterface;

/**
 * Interface for class-based components
 *
 * @package bc\rest\components
 */
interface ClassInterface extends ComponentInterface, GenerateableInterface, TraitsInterface,
                                 ConstantsInterface, PropertiesInterface, NamespaceInterface,
                                 DocblockInterface {

    /**
     * Get component constructor
     *
     * @return PhpMethod
     */
    public function getConstructor();

    /**
     * Add use statement for imported component if needed
     *
     * @param ClassInterface $component
     */
    public function useClassComponent(ClassInterface $component);

}