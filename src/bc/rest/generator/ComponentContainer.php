<?php


namespace bc\rest\generator;

use bc\rest\components\ComponentInterface;
use bc\rest\exceptions\Exception;

/**
 * Class ComponentContainer
 * @package bc\rest\generator
 */
class ComponentContainer implements ComponentContainerInterface {

    /**
     * @var ComponentInterface[]
     */
    private $components;

    /**
     * Add component to container
     *
     * @param string $name Short name for component
     * @param ComponentInterface $component
     *
     * @throws Exception when component with such name is exist
     */
    public function addComponent($name, ComponentInterface $component) {
        if(isset($this->components[$name])) throw new Exception("Component $name exists");
        $this->components[$name] = $component;
    }

    /**
     * Get component by name
     *
     * @param string $name
     *
     * @return ComponentInterface
     * @throws Exception when component with such name doesn't exist
     */
    public function getComponent($name) {
        if(!isset($this->components[$name])) throw new Exception("Component $name not exists");

        return $this->components[$name];
    }

    /**
     * Get all components int container
     *
     * @return ComponentInterface[]
     */
    public function getComponents() {
        return $this->components;
    }
}