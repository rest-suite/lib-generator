<?php


namespace bc\rest\components;

use bc\rest\components\controller\ControllerClassInterface;
use gossi\codegen\model\PhpMethod;

/**
 * Interface BootstrapClassInterface
 * Use for create runner for all application
 *
 * @package bc\rest\components
 */
interface BootstrapClassInterface extends ClassInterface {

    /**
     * Get bootstrap 'info' part
     * info-method return array with keys - version, title, description
     * based on swagger.yml info-section
     *
     * @return PhpMethod
     */
    public function getInfo();

    /**
     * Get bootstrap 'routes' part
     * routes-methods add controller endpoints to slim framework
     * method per controller
     *
     * @param ControllerClassInterface $controller if no routes-method for controller - create it
     *
     * @return PhpMethod
     */
    public function getRoutesMethod(ControllerClassInterface $controller);

    /**
     * Get all 'routes' parts
     *
     * @return PhpMethod[]
     */
    public function getRoutesMethods();

    /**
     * Get bootstrap 'errors' part
     * errors-method process request as a middleware
     * and convert exceptions into json response
     *
     * @return PhpMethod
     */
    public function getErrorProcessing();

    /**
     * Get bootstrap 'run' part
     * run-method is a shortcut to call Slim\App::run()
     *
     * @return PhpMethod
     */
    public function getRunMethod();

}