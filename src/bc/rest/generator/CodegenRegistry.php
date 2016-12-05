<?php


namespace bc\rest\generator;


use gossi\codegen\generator\CodeGenerator;

class CodegenRegistry {

    private static $gens = [];

    /**
     * Create gossi code generator
     *
     * @param string $name   instance name
     * @param array $options new instance options
     *
     * @return CodeGenerator
     */
    public static function create($name = 'default', $options = null) {
        if(isset(self::$gens[$name])) return self::$gens[$name];

        self::$gens[$name] = new CodeGenerator($options);

        return self::$gens[$name];
    }
}