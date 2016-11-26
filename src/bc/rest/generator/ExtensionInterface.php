<?php


namespace bc\rest\generator;

use gossi\swagger\Swagger;

/**
 * Interface of extension
 *
 * @package bc\rest\generator
 */
interface ExtensionInterface {

    /**
     * @param ComponentContainerInterface $container
     * @param Swagger $specs swagger specs object
     *
     * @return mixed
     */
    public function processSpecs(ComponentContainerInterface $container, Swagger $specs);
}