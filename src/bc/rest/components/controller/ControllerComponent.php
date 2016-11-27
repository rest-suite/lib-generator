<?php


namespace bc\rest\components\controller;


use bc\rest\components\AbstractClassComponent;
use bc\rest\exceptions\Exception;
use gossi\codegen\model\PhpProperty;

class ControllerComponent extends AbstractClassComponent implements ControllerClassInterface {

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
        if(isset($this->endpoints[$name])) {
            if(!($this->endpoints[$name] instanceof EndpointInterface)) {
                throw new Exception('Invalid endpoint');
            }
            if(!$this->hasMethod($name)) $this->setMethod($this->endpoints[$name]);
            
        }
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
     * Add new endpoint
     *
     * @param string $name                endpoint OperationId
     * @param EndpointInterface $endpoint endpoint method
     */
    public function addEndpoint($name, EndpointInterface $endpoint) {
        // TODO: Implement addEndpoint() method.
    }
}