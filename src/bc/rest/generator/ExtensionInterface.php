<?php


namespace bc\rest\generator;

/**
 * Interface of extension
 * 
 * @package bc\rest\generator
 */
interface ExtensionInterface {

    /**
     * @param ComponentContainerInterface $container
     * @param array $specs parsed openapis specs
     *
     * @return mixed
     */
    public function processSpecs(ComponentContainerInterface $container, $specs);
}