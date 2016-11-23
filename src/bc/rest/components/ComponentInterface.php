<?php

namespace bc\rest\components;

use gossi\codegen\model\PhpMethod;
use gossi\codegen\model\PhpProperty;

/**
 * Base interface for components of generator
 * One component build one class (controller, model, etc.)
 * 
 * @package bc\rest\models
 */
interface ComponentInterface {

    /**
     * Get component class name
     * 
     * @return string
     */
    public function getName();

    /**
     * Set component name
     * 
     * @param string $name
     */
    public function setName($name);

    /**
     * Get suffix for component full class name
     * 
     * @return string
     */
    public function getSuffix();

    /**
     * Get component class namespace
     * 
     * @return string
     */
    public function getNamespace();

    /**
     * Set component class namespace
     * 
     * @param string $ns
     */
    public function setNamespace($ns);

    /**
     * Add method to component
     * 
     * @param PhpMethod $method
     */
    public function addMethod(PhpMethod $method);

    /**
     * Get component method by name
     *
     * @param string $name
     *
     * @return PhpMethod
     */
    public function getMethod($name);

    /**
     * Add property to component
     * 
     * @param PhpProperty $property
     */
    public function addProperty(PhpProperty $property);

    /**
     * Get component property by name
     * 
     * @param string $name
     *
     * @return PhpProperty
     */
    public function getProperty($name);
}