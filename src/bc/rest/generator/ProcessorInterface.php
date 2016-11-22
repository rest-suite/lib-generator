<?php

namespace bc\rest\generator;

interface ProcessorInterface {

    /**
     * Process openapi specs
     *
     * @param array $specs parsed openapis specs
     */
    public function processSpecs($specs);

}