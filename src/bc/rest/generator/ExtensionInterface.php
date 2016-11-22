<?php


namespace bc\rest\generator;


interface ExtensionInterface {

    /**
     * @param GeneratorInterface $generator
     * @param array $specs parsed openapis specs
     *
     * @return mixed
     */
    public function processSpecs(GeneratorInterface $generator, $specs);
}