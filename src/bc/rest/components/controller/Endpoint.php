<?php


namespace bc\rest\components\controller;


use bc\rest\exceptions\Exception;
use gossi\codegen\model\PhpMethod;
use gossi\codegen\model\PhpParameter;
use gossi\docblock\Docblock;
use gossi\docblock\tags\AbstractTag;
use gossi\docblock\tags\TagFactory;

class Endpoint extends PhpMethod implements EndpointInterface {

    /**
     * @var AbstractTag
     */
    private $apiTag;

    /**
     * @var AbstractTag[]
     */
    private $responseTags = [];

    /**
     * Shortcut to add phpdoc tag for responses from swagger
     * tag output format: "@api-response:{code} [{type}] [{message}]"
     *
     * @param string $code        HTTP response code (swagger supports 'default' code as string)
     * @param string $description Optional description for response
     * @param null $type          Optional type for response
     *
     * @throws Exception
     */
    public function addResponseTag($code = 'default', $description = '', $type = null) {
        if(isset($this->responseTags[$code])) throw new Exception('Response exists. Use getResponseTag instead.');
        $msg = $code;
        if(!empty($type)) $msg .= " $type";
        if(!empty($description)) $msg .= " $description";

        $this->responseTags[$code] = TagFactory::create('api-response', $msg);
        /** @var Docblock $doc */
        $doc = $this->getDocblock();
        $doc->appendTag($this->responseTags[$code]);
    }

    /**
     * Get all response tags
     *
     * @return AbstractTag[]
     */
    public function getResponseTags() {
        return $this->responseTags;
    }

    /**
     * Get tag for response by code
     *
     * @param string $code HTTP response code (swagger supports 'default' code as string)
     *
     * @return AbstractTag
     *
     * @throws Exception
     */
    public function getResponseTag($code) {
        if(!isset($this->responseTags[$code])) throw new Exception('Invalid response');

        return $this->responseTags[$code];
    }

    /**
     * Get endpoint format tag
     *
     * @return AbstractTag
     */
    public function getApiTag() {
        return $this->apiTag;
    }

    /**
     * Set endpoint format tag
     * tag output format: "@api {method} {pattern}"
     *
     * @param string $method  HTTP method
     * @param string $pattern URI pattern
     *
     * @throws Exception
     */
    public function setApiTag($method, $pattern) {
        if(!is_null($this->apiTag)) throw new Exception('api tag already set. use getApiTag instead');
        $this->apiTag = TagFactory::create('api', sprintf("%s %s", $method, $pattern));

        /** @var Docblock $doc */
        $doc = $this->getDocblock();
        $doc->appendTag($this->apiTag);
    }

    /**
     * Update endpoint method if necessary
     */
    public function update() {
        /** @var PhpParameter[] $params */
        $params = $this->getParameters();
        if(
            count($params) != 3
            || $params[0]->getName() != 'request'
            || $params[1]->getName() != 'response'
            || $params[2]->getName() != 'args'
        ) {
            foreach($params as $param) {
                $this->removeParameter($param);
            }

            $this->createParams();
        }

        if(empty($this->getBody())) {
            $this->setBody("return \$response->withStatus(501, '{$this->getName()} not implemented');");
        }

        if($this->getType() != 'Response') $this->setType('Response');
    }

    private function createParams() {
        $this->addSimpleParameter('request', 'Request');
        $this->addSimpleParameter('response', 'Response');
        $this->addParameter(PhpParameter::create('args')->setType('array')->setExpression('[]'));
    }
}