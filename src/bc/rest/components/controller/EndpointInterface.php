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
interface EndpointInterface extends RoutineInterface, ComponentInterface {

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

}