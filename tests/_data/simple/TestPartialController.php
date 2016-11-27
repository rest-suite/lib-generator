<?php

namespace test\simple;

use Slim\Container;

class TestController {

    /**
     * @param Container $ci
     */
    public function __construct(Container $ci) {
        $this->ci = $ci;
    }
}