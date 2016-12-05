<?php

namespace bc\rest\components;

use bc\rest\components\controller\ControllerClassInterface;
use gossi\codegen\model\PhpMethod;
use gossi\codegen\model\PhpProperty;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class BootstrapComponent
 *
 * @package bc\rest\components
 */
class BootstrapComponent extends AbstractClassComponent implements BootstrapClassInterface {

    const METHOD_PROCESS_REQUEST = 'processRequest';

    /**
     * BootstrapComponent constructor.
     *
     * @param string $name
     */
    public function __construct($name = 'Bootstrap') {
        parent::__construct($name);
    }

    /**
     * Generate component with default data
     *
     * @param array $parts   available parts:
     *                       info
     *                       routes
     *                       errors
     *                       run
     *
     * @param array $options options for default data generation
     */ 
    public function createDefaults($parts = [], $options = []) {
        if(!$this->hasProperty('app')) {
            $this->setProperty(PhpProperty::create('app')->setType('App')->setVisibility('private'));
        }

        $body = $this->getConstructor()->getBody();

        if(strpos($body, '$this->app = ') === false) {
            $body .= "\n".'$this->app = is_null($app) ? new App() : $app;';
        }

        if(strpos($body, '$this->app->add([$this, \''.self::METHOD_PROCESS_REQUEST.'\']);') === false) {
            $body .= "\n".'$this->app->add([$this, \''.self::METHOD_PROCESS_REQUEST.'\']);';
        }

        $this->getConstructor()->setBody($body);

        if(!$this->getConstructor()->hasParameter('app')) {
            $this->getConstructor()->addSimpleParameter('app', 'App');
            $this->addUseStatement('Slim\\App');
        }

        if(!$this->hasMethod(self::METHOD_PROCESS_REQUEST)) {
            $process = $this->getErrorProcessing();
            $this->setMethod($process);
        }
    }

    /**
     * Get bootstrap 'errors' part
     * errors-method process request as a middleware
     * and convert exceptions into json response
     *
     * @return PhpMethod
     */
    public function getErrorProcessing() {
        if(!$this->hasMethod(self::METHOD_PROCESS_REQUEST)) {
            $process = PhpMethod::create(self::METHOD_PROCESS_REQUEST);
            $process->addSimpleParameter('request', 'Request');
            $process->addSimpleParameter('response', 'Response');
            $process->addSimpleParameter('next', 'callable');
            $process->setType('Response');
            $this->addUseStatement(Request::class);
            $this->addUseStatement(Response::class);
            $processBody = <<<'BODY'
try {
    /** @var Response $response */
    $response = $next($request, $response);
} catch (\Exception $e) {
    $json = ['message' => $e->getMessage(), 'code' => $e->getCode(), 'exception' => get_class($e)];
    $statusCode = $response->isClientError() || $response->isServerError() ? $e->getCode() : 500;
    return $response->withStatus($statusCode)->withJson($json);
}
return $response;
BODY;
            $process->setBody($processBody);
            return $process;
        }

        return $this->getMethod(self::METHOD_PROCESS_REQUEST);
    }

    /**
     * Get bootstrap 'info' part
     * info-method return array with keys - version, title, description
     * based on swagger.yml info-section
     *
     * @return PhpMethod
     */
    public function getInfo() {
        // TODO: Implement getInfo() method.
    }

    /**
     * Get bootstrap 'routes' part
     * routes-methods add controller endpoints to slim framework
     * method per controller
     *
     * @param ControllerClassInterface $controller if no routes-method for controller - create it
     *
     * @return PhpMethod
     */
    public function getRoutesMethod(ControllerClassInterface $controller) {
        // TODO: Implement getRoutesMethod() method.
    }

    /**
     * Get all 'routes' parts
     *
     * @return PhpMethod[]
     */
    public function getRoutesMethods() {
        // TODO: Implement getRoutesMethods() method.
    }

    /**
     * Get bootstrap 'run' part
     * run-method is a shortcut to call Slim\App::run()
     *
     * @return PhpMethod
     */
    public function getRunMethod() {
        // TODO: Implement getRunMethod() method.
    }
}