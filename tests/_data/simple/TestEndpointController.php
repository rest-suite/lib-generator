<?php

namespace test\simple;

use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;

class TestController {

    /**
     * @var Container
     */
    private $ci;

    /**
     * @param Container $ci
     */
    public function __construct(Container $ci) {
        $this->ci = $ci;
    }

    /**
     * get item
     * 
     * @api GET /{id}
     * @api-response 200 success
     * @api-param int $id
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function getItem(Request $request, Response $response, array $args = []) {
        /** @var int $id */
        $id = isset($args['id']) ? $args['id'] : null;

        return $response->withStatus(501, 'getItem not implemented');
    }
}