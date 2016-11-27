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
     * Add new endpoint
     *
     * @param string $name                endpoint OperationId
     * @param EndpointInterface $endpoint endpoint method
     */
    public function addEndpoint($name, EndpointInterface $endpoint);

    /**
     * Get endpoint-method by name
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