<?php

/**
 * A simple class for testing DocTest parsing
 *
 * <code>
 *     $class = new PHPTSomeSimpleClass();
 * </code>
 * EXPECT:
 * PHPTSomeSimpleClass::__construct was called
 */ 
class PHPTSomeSimpleClass
{
    public function __construct() {
        echo __METHOD__, ' was called ', "\n";
    }

    /**
     * A basic method with usage
     *
     * <code>
     *     $class = new PHPTSomeSimpleClass();
     *     $class->someMethod();
     * </code>
     *
     * EXPECT:
     * PHPTSomeSimpleClass::__construct was called
     * PHPTSomeSimpleClass::someMethod was called
     */
    public function someMethod() {

    }

    /**
     * A basic static method for testing
     *
     * <code>
     *     PHPTSomeSimpleClass::someStaticMethod();
     * </code>
     * 
     * EXPECT:
     * PHPTSomeSimpleClass::someStaticMethod was called
     */
    public static function someStaticMethod() {
        echo __METHOD__, ' was called ', "\n";
    }
}
