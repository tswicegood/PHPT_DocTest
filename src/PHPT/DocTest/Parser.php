<?php

class PHPT_DocTest_Parser
{
    private $_docblock = '';
    private $_parsed_test_case = '';

    public function __construct($docblock)
    {
        $this->_docblock = $docblock;
        $this->_parseDocBlock();
    }

    private function _parseDocBlock()
    {
        $cleaned = preg_replace('/^\/\*\*| ?\*\/| ?\* ?/', '', $this->_docblock);
        $lines = explode(PHP_EOL, $cleaned);

        $case = array(
            'TEST' => '',
            'FILE' => '',
        );

        $cursors = array(
            0 => 'TEST',
            1 => 'FILE',
        );

        $cursor = 0;

        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line)) {
                continue;
            }
            
            if ($cursor == 0 && $line == '<?php') {
                ++$cursor;
            } elseif ($cursor == 1 && substr($line, 0, 6) == 'EXPECT') {
                ++$cursor;
                $name = rtrim($line, ':');
                $cursors[] = $name;
                $case[$cursors[$cursor]] = '';
                continue;
            }
            
            $case[$cursors[$cursor]] .= $line . PHP_EOL;
        }

        
        foreach ($case as $section => $contents) {
            $this->_parsed_test_case .= '--' . $section . '--' . PHP_EOL . $contents . PHP_EOL;
            if ($section != 'TEST') {
                $this->_parsed_test_case .= '===DONE===' . PHP_EOL;
            }
        }
    }

    public function __toString()
    {
        return $this->_parsed_test_case;
    }
}

