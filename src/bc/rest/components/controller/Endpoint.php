<?php


namespace bc\rest\components\controller;


use bc\rest\exceptions\Exception;
use gossi\codegen\model\PhpMethod;
use gossi\codegen\model\PhpParameter;
use gossi\docblock\Docblock;
use gossi\docblock\tags\TagFactory;
use gossi\docblock\tags\UnknownTag;

class Endpoint extends PhpMethod implements EndpointInterface {

    /**
     * @var UnknownTag
     */
    private $apiTag;

    /**
     * @var UnknownTag[]
     */
    private $responseTags = [];

    /**
     * @var array[]
     */
    private $requestParams = [];

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
        /*$doc = $this->getDocblock();
        $doc->appendTag($this->responseTags[$code]);*/
    }

    /**
     * Get all response tags
     *
     * @return UnknownTag[]
     */
    public function getResponseTags() {
        return $this->responseTags;
    }

    /**
     * Get tag for response by code
     *
     * @param string $code HTTP response code (swagger supports 'default' code as string)
     *
     * @return UnknownTag
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
     * @return UnknownTag
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

        $this->updateDocTags();

    }

    private function createParams() {
        $this->addSimpleParameter('request', 'Request');
        $this->addSimpleParameter('response', 'Response');
        $this->addParameter(PhpParameter::create('args')->setType('array')->setExpression('[]'));
    }

    private function updateDocTags() {
        /** @var Docblock $doc */
        $doc = $this->getDocblock();

        if(!is_null($this->apiTag)) {
            $doc->removeTags('api');
            $doc->appendTag($this->apiTag);
        }

        if(count($this->requestParams) > 0) {
            $oldBody = $this->getBody();
            $doc->removeTags('api-param');
            $initCode = [];
            foreach($this->requestParams as $name => $param) {
                if(isset($param['tag'])) $doc->appendTag($param['tag']);
                if(isset($param['init']) && strpos($oldBody, '$'.$name) === false) {
                    $initCode = array_merge($initCode, $param['init']);
                }
            }
            $initCode[] = "\n";
            $this->setBody(join("\n", $initCode).$oldBody);
        }

        if(count($this->responseTags) > 0) {
            $doc->removeTags('api-response');
            foreach($this->responseTags as $tag) {
                $doc->appendTag($tag);
            }
        }
    }

    /**
     * Add request parameter to endpoint
     * Update options if named param exists
     *
     * @param string $name   param name
     * @param array $options endpoint specific options
     */
    public function setRequestParameter($name, $options = []) {
        if(isset($this->requestParams[$name])) {
            $this->requestParams[$name] = array_merge($this->requestParams[$name], $options);
        }
        else {
            $this->requestParams[$name] = $options;
        }

        $type = isset($this->requestParams[$name]['type']) ? $this->requestParams[$name]['type'].' ' : '';
        $description = isset($this->requestParams[$name]['description']) ? ' '.$this->requestParams[$name]['description'] : '';
        $tagContent = sprintf('%s$%s%s', $type, $name, $description);
        $this->requestParams[$name]['tag'] = TagFactory::create('api-param', trim($tagContent));
    }

    /**
     * Get request parameter of endpoint
     *
     * @param string $name
     *
     * @return array
     * @throws Exception
     */
    public function getRequestParameter($name) {
        if(!isset($this->requestParams[$name])) throw new Exception('Request param not exists');

        return $this->requestParams[$name];
    }
}