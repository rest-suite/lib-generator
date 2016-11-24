<?php


namespace bc\rest\components\model;

use bc\rest\components\ClassInterface;

/**
 * Interface ModelClassInterface
 *
 * @package bc\rest\components
 */
interface ModelClassInterface extends ClassInterface {

    /**
     * Get model property
     * if not exists - create one
     *
     * @param string $name property name
     *
     * @return PropertyInterface
     */
    public function getProperty($name);

    /**
     * Get all properties
     *
     * @return PropertyInterface[]
     */
    public function getProperties();

    /**
     * Set properties to export as array by names
     *
     * @param string[] $properties names
     */
    public function setExportedProperties($properties);

    /**
     * Get exported properties
     *
     * @return string[]
     */
    public function getExportedProperties();

}