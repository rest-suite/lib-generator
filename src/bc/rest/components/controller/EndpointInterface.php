<?php

namespace bc\rest\components\controller;

use bc\rest\components\ComponentInterface;
use gossi\codegen\model\RoutineInterface;
use gossi\docblock\tags\AbstractTag;

/**
 * Interface endpoint method
 *
 * @package bc\rest\components\controller
 */
interface EndpointInterface extends RoutineInterface {

    /**
     * Shortcut to add phpdoc tag for responses from swagger
     * tag output format: "@api-response:{code} [{type}] [{message}]"
     *
     * @param string $code        HTTP response code (swagger supports 'default' code as string)
     * @param string $description Optional description for response
     * @param null $type          Optional type for response
     */
    public function addResponseTag($code = 'default', $description = '', $type = null);

    /**
     * Get tag for response by code
     *
     * @param string $code HTTP response code (swagger supports 'default' code as string)
     *
     * @return AbstractTag
     */
    public function getResponseTag($code);

    /**
     * Get all response tags
     *
     * @return AbstractTag[]
     */
    public function getResponseTags();

    /**
     * Set endpoint format tag
     * tag output format: "@api {method} {pattern}"
     *
     * @param string $method  HTTP method
     * @param string $pattern URI pattern
     */
    public function setApiTag($method, $pattern);

    /**
     * Get endpoint format tag
     *
     * @return AbstractTag
     */
    public function getApiTag();

    /**
     * Update endpoint method if necessary
     */
    public function update();

    /**
     * Add request parameter to endpoint
     * Update options if named param exists
     *
     * @param string $name   param name
     * @param array $options endpoint specific options
     */
    public function setRequestParameter($name, $options = []);

    /**
     * Get request parameter of endpoint
     *
     * @param string $name
     *
     * @return array
     */
    public function getRequestParameter($name);

}