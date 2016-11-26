<?php

namespace bc\rest\generator;

/**
 * Interface of basic generator
 *
 * @package bc\rest\generator
 */
interface GeneratorInterface {

    /**
     * Get components container
     *
     * @return ComponentContainerInterface
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
     * for compatible issues, testing, etc.
     *
     * @param string $extension class name of extension
     */
    public function disableExtension($extension);

    /**
     * Get enabled extensions
     *
     * @return ExtensionInterface[]
     */
    public function getExtensions();

    /**
     * Get disabled extensions
     *
     * @return ExtensionInterface[]
     */
    public function getDisabledExtensions();

    /**
     * Run generation pipeline
     */
    public function process();

}