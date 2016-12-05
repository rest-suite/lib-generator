<?php

namespace test\simple;

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

class Bootstrap {

    /**
     * @var App
     */
    private $app;

    /**
     * @param App $app
     */
    public function __construct(App $app) {
        $this->app = is_null($app) ? new App() : $app;
        $this->app->add([$this, 'processRequest']);
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param callable $next
     * @return Response
     */
    public function processRequest(Request $request, Response $response, callable $next) {
        try {
            /** @var Response $response */
            $response = $next($request, $response);
        } catch (\Exception $e) {
            $json = ['message' => $e->getMessage(), 'code' => $e->getCode(), 'exception' => get_class($e)];
            $statusCode = $response->isClientError() || $response->isServerError() ? $e->getCode() : 500;
            return $response->withStatus($statusCode)->withJson($json);
        }
        return $response;
    }
}