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
     * @param EndpointInterface $endpoint endpoint method
     *                                    name must be equals to operationId
     */
    public function addEndpoint(EndpointInterface $endpoint);

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