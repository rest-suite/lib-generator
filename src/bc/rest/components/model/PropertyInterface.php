<?php


namespace bc\rest\components\model;

use bc\rest\components\ComponentInterface;
use gossi\codegen\model\DocblockInterface;
use gossi\codegen\model\PhpMethod;
use gossi\codegen\model\ValueInterface;

/**
 * Interface PropertyInterface
 * Represents model property
 *
 * @package bc\rest\components\model
 */
interface PropertyInterface extends ComponentInterface, ValueInterface, DocblockInterface {

    /**
     * Set '@required' custom tag
     * based on swagger model definition
     *
     * @param bool $required
     */
    public function setRequired($required);

    /**
     * Is it required property?
     *
     * @return bool
     */
    public function isRequired();

    /**
     * Set property read only flag
     *
     * @param bool $readOnly
     */
    public function setReadOnly($readOnly);

    /**
     * Is is read only property?
     *
     * @return bool
     */
    public function isReadOnly();

    /**
     * Get property setter
     * create default if not exists
     *
     * @return PhpMethod
     */
    public function getSetter();

    /**
     * Get property getter
     * create default if not exists
     *
     * @return PhpMethod
     */
    public function getGetter();
}