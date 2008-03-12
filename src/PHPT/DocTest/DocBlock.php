<?php

class PHPT_DocTest_DocBlock
{
    private $_lines = array();

    public function __construct($docblock) {
        $cleaned = preg_replace('/^\/\*\*| ?\*\/| ?\* ?/', '', $docblock);
        $this->_lines = explode(PHP_EOL, $cleaned);

        array_shift($this->_lines);
        array_pop($this->_lines);
    }

    public function getLines() {
        return $this->_lines;
    }
}

