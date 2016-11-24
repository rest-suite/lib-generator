<?php


namespace bc\rest\components;

/**
 * Interface ConfigClassInterface
 * Represents config file
 *
 * @package bc\rest\components
 */
interface ConfigClassInterface extends ComponentInterface {

    /**
     * Set config option value
     *
     * @param string $name
     * @param mixed $value
     */
    public function setOption($name, $value);

    /**
     * Get config option by name
     *
     * @param string $name
     *
     * @return mixed
     */
    public function getOption($name);

    /**
     * Get all options
     *
     * @return mixed[]
     */
    public function getOptions();

    /**
     * Remove named config option
     *
     * @param string $name
     *
     */
    public function removeOption($name);

}