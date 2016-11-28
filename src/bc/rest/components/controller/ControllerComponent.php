<?php


namespace bc\rest\components\controller;


use bc\rest\components\AbstractClassComponent;
use bc\rest\exceptions\Exception;
use gossi\codegen\model\PhpMethod;
use gossi\codegen\model\PhpProperty;
use Slim\Http\Request;
use Slim\Http\Response;

class ControllerComponent extends AbstractClassComponent implements ControllerClassInterface {

    /**
     * @var EndpointInterface[]
     */
    private $endpoints;

    /**
     * @inheritdoc
     */
    public function createDefaults($parts = [], $options = []) {
        parent::createDefaults($parts, $options);
        $body = $this->getConstructor()->getBody();

        if(strpos($body, '$this->ci = $ci;') === false) {
            $body .= "\n".'$this->ci = $ci;';
            $this->getConstructor()->setBody($body);
        }

        if(!$this->getConstructor()->hasParameter('ci')) {
            $this->getConstructor()->addSimpleParameter('ci', 'Container');
            $this->addUseStatement('Slim\\Container');
        }

        if(!$this->hasProperty('ci')) {
            $this->setProperty(
                PhpProperty::create('ci')
                           ->setType('Container')
                           ->setVisibility('private')
            );
        }
    }

    /**
     * Get endpoint-method by name
     *
     * @param string $name operationId form swagger.yml
     *
     * @return EndpointInterface
     * @throws Exception
     */
    public function getEndpoint($name) {
        if(!isset($this->endpoints[$name]) && !$this->getMethod($name)) {
            throw new Exception('Invalid endpoint');
        }

        return $this->endpoints[$name];
    }

    /**
     * Get all endpoint-methods
     *
     * @return EndpointInterface[]
     */
    public function getEndpoints() {
        // TODO: Implement getEndpoints() method.
    }

    /**
     * @inheritdoc
     *
     * @throws Exception
     */
    public function addEndpoint(EndpointInterface $endpoint) {
        if(!($endpoint instanceof PhpMethod)) throw new Exception('Invalid endpoint');
        $name = $endpoint->getName();
        if(isset($this->endpoints[$name]) || $this->hasMethod($name)) {
            throw new Exception('Endpoint exists');
        }
        $this->endpoints[$name] = $endpoint;
        $this->setMethod($endpoint);
        $endpoint->update();

        $this->addUseStatement(Request::class);
        $this->addUseStatement(Response::class);
    }
}