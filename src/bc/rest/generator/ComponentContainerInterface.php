<?php


namespace bc\rest\generator;


use bc\rest\components\ComponentInterface;

/**
 * Interface of container for components
 * 
 * @package bc\rest\generator
 */
interface ComponentContainerInterface {
    
    /**
     * Add component to container
     *
     * @param string $name Short name for component
     * @param ComponentInterface $component
     */
    public function addComponent($name, ComponentInterface $component);

    /**
     * Get component by name
     *
     * @param string $name
     *
     * @return ComponentInterface
     */
    public function getComponent($name);

    /**
     * Get all components int container
     *
     * @return ComponentInterface[]
     */
    public function getComponents();
}