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

    public function generate($callback) 
    {
        $reflection = new ReflectionFunction($callback);
        $docblock = new PHPT_DocTest_DocBlock($reflection->getDocComment());
        $parser = new PHPT_DocTest_Parser($docblock);

        file_put_contents($this->_test_path . '/' . $callback . '-1.phpt', (string)$parser);
    }
}

