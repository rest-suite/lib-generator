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
     * @api-response 200 success
     * @api GET /{id}
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function getItem(Request $request, Response $response, array $args = []) {
        return $response->withStatus(501, 'getItem not implemented');
    }
}