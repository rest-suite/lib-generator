<?php

namespace bc\rest\generator;

use bc\rest\models\ComponentInterface;

interface GeneratorInterface {

    /**
     * Add component for generation pipeline
     *
     * @param string $name Short name for component
     * @param ComponentInterface $component
     */
    public function addComponent($name, ComponentInterface $component);

    /**
     * Get generator component
     * bootstrap, controller, etc.
     *
     * @param string $name
     *
     * @return ComponentInterface
     */
    public function getComponent($name);

    /**
     * Get all generator components
     *
     * @return ComponentInterface[]
     */
    public function getComponents();

    /**
     * Add extension to generator pipeline
     * Only one extension per class
     *
     * @param ExtensionInterface $extension
     */
    public function addExtension(ExtensionInterface $extension);

    /**
     * Get extension by class name
     *
     * @param string $extension class name of extension
     *
     * @return ExtensionInterface
     */
    public function getExtension($extension);

    /**
     * Disable some extension
     * for compatible issues, etc.
     *
     * @param $extension
     */
    public function disableExtension($extension);

    /**
     * Run generation pipeline
     */
    public function process();

}