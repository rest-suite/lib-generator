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
     * Generate component with default data
     *
     * @param array $parts   custom names of parts to generate
     *                       depends on specific component
     *                       empty array - generate all parts
     *                       key - name of part (must use class constants)
     *                       value - mixed. if no named-key - name of part
     *
     * @param array $options options for default data generation
     */
    public function createDefaults($parts = [], $options = []);

    /**
     * Load component data from file
     *
     * @param string $filename file to load
     *
     * @param array $parts     custom names of parts to generate
     *                         depends on specific component
     *                         empty array - generate all parts
     *                         key - name of part (must use class constants)
     *                         value - mixed. if no named-key - name of part
     *
     * @param array $options   options for loading
     */
    public function loadFromFile($filename, $parts = [], $options = []);

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
     * Set component file extension
     *
     * @param string $ext extension
     */
    public function setFileExt($ext);

}