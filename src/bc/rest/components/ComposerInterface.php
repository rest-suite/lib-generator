<?php


namespace bc\rest\components;

/**
 * Interface ComposerInterface
 * Represents package in composer.json file as component with shortcuts
 *
 * @package bc\rest\components
 */
interface ComposerInterface extends ComponentInterface {

    /**
     * Set vendor name for composer package
     *
     * @param string $vendor
     */
    public function setVendor($vendor);

    /**
     * Get vendor name for composer package
     *
     * @return string
     */
    public function getVendor();

    /**
     * Set package version
     *
     * @param string $version
     */
    public function setVersion($version);

    /**
     * Get package version
     *
     * @return string
     */
    public function getVersion();

    /**
     * Add package to require section
     *
     * @param string $package
     * @param string $version
     *
     * @return mixed
     */
    public function requirePackage($package, $version = '*');

    /**
     * Get required package version
     *
     * @param string $package package name
     *
     * @return string
     */
    public function getRequiredPackageVersion($package);

    /**
     * Get all required packages
     *
     * @return array
     */
    public function getRequiredPackages();

    /**
     * Remove package from required packages
     *
     * @param string $package package name
     */
    public function removeRequiredPackage($package);

    /**
     * Add package to require-dev section
     *
     * @param string $package
     * @param string $version
     */
    public function requireDevPackage($package, $version);

    /**
     * Get required dev package version
     *
     * @param string $package package name
     *
     * @return string
     */
    public function getRequiredDevPackageVersion($package);

    /**
     * Get all required dev packages
     *
     * @return array
     */
    public function getRequiredDevPackages();

    /**
     * Remove package from required dev packages
     *
     * @param string $package package name
     */
    public function removeRequiredDev($package);

    /**
     * Add namespace to autoload psr-4 section
     *
     * @param string $namespace
     * @param string|string[] $paths
     */
    public function autoloadNamespace($namespace, $paths);

    /**
     * Get namespace autoload paths
     *
     * @param string $namespace
     *
     * @return string[]
     */
    public function getNamespacePaths($namespace);

    /**
     * Get autoload paths for all namespaces
     *
     * @return string[string][]
     */
    public function getNamespacesPaths();

    /**
     * Remove namespace from autoload paths
     *
     * @param string $namespace
     */
    public function removeNamespaceFromAutoload($namespace);

    /**
     * Add custom repository to package
     *
     * @param array $repository composer repository property
     */
    public function addRepository($repository);

    /**
     * Get repositories
     * Filtered by matched properties in search array
     *
     * @param array $search repository properties to search
     *                      empty search returns all repositories
     *
     * @return array[]
     */
    public function getRepositories($search = []);

    /**
     * Remove repositories
     * Filtered by matched properties in search array
     *
     * @param array $search repository properties to search
     *                      empty search removes all repositories
     */
    public function removeRepositories($search = []);

    /**
     * Set package property
     *
     * @param string $name property name
     * @param mixed $value property value
     *
     * @return mixed
     */
    public function setProperty($name, $value);

    /**
     * Get property by name
     *
     * @param string $name property name
     *
     * @return mixed
     */
    public function getProperty($name);

}