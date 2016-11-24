<?php

namespace bc\rest\components;

use gossi\codegen\model\PhpMethod;

/**
 * Interface for class-based components
 *
 * @package bc\rest\components
 */
interface ClassInterface extends ComponentInterface {

    /**
     * Get component constructor
     *
     * @return PhpMethod
     */
    public function getConstructor();
    
    /**
     * Get component class namespace
     *
     * @return string
     */
    public function getNamespace();

    /**
     * Set component class namespace
     *
     * @param string $ns namespace
     */
    public function setNamespace($ns);

}