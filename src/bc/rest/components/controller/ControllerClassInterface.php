<?php

namespace bc\rest\components\controller;

use bc\rest\components\ClassInterface;

/**
 * Interface ControllerClassInterface
 *
 * @package bc\rest\components
 */
interface ControllerClassInterface extends ClassInterface {

    /**
     * Get endpoint-method by name
     * if endpoint not exists - create one
     *
     * @param string $name operationId form swagger.yml
     *
     * @return EndpointInterface
     */
    public function getEndpoint($name);

    /**
     * Get all endpoint-methods
     *
     * @return EndpointInterface[]
     */
    public function getEndpoints();

}