<?php

namespace test\simple;

use Slim\Container;

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
}