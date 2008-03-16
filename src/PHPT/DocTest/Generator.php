<?php

class PHPT_DocTest_Generator
{
    private $_test_path = '';
    public function __construct($test_path)
    {
        if (!file_exists($test_path)) {
            mkdir($test_path);
        }
        $this->_test_path = $test_path;
    }

    public function generateFromFile($file)
    {
        $existing_functions = get_defined_functions();
        require_once $file;
        $newly_declared_functions = get_defined_functions();
        $functions_to_test = array_diff(
            $newly_declared_functions['user'],
            $existing_functions['user']
        );
        array_map(array($this, 'generate'), $functions_to_test);
    }

    public function generate($callback) 
    {
        if (function_exists($callback)) {
            $reflection = new ReflectionFunction($callback);
        } else {
            $reflection = new ReflectionClass($callback);
        }
        $docblock = $this->_createDocBlock($reflection);
        $parser = new PHPT_DocTest_Parser($docblock);

        file_put_contents($this->_test_path . '/' . $callback . '-1.phpt', (string)$parser);
    }

    private function _createDocBlock($reflection)
    {
        $raw = $reflection->getDocComment();
        if (empty($raw)) {
            throw new PHPT_DocTest_Generator_NoDocblockException();
        }
        return new PHPT_DocTest_DocBlock($raw);
    }
}

