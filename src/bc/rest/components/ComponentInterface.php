<?php

namespace bc\rest\components;

/**
 * Base interface for components of generator
 *
 * @package bc\rest\models
 */
interface ComponentInterface {

    /**
     * Get component name
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
     * Get suffix for component full name
     * can be empty
     *
     * @return string
     */
    public function getSuffix();

    /**
     * Generate component with default data
     *
     * @param array $parts   custom names of parts to generate
     *                       depends on specific component
     *                       empty array - generate all parts
     *                       key - name of part
     *                       value - mixed. if no named-key - name of part
     *
     * @param array $options options for default data generation
     *
     * @return
     */
    public function createDefaultComponent($parts = [], $options = []);

    /**
     * Get generated code for component
     * 
     * @return string
     */
    public function getCode();

    /**
     * Get file extension for component
     * can be empty
     * 
     * @return string
     */
    public function getFileExt();

    /**
     * Is component loaded?
     * use for create default data (default result must be false)
     * 
     * @return bool
     */
    public function isLoaded();

}