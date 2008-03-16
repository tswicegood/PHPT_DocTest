<?php

class PHPT_DocTest_Parser
{
    private $_docblock = '';
    private $_parsed_test_case = '';

    public function __construct(PHPT_DocTest_DocBlock $docblock)
    {
        $this->_docblock = $docblock;
        $this->_parseDocBlock();
    }

    private function _parseDocBlock()
    {
        $case = array(
            'TEST' => '',
            'FILE' => '',
        );

        $cursors = array(
            0 => 'TEST',
            1 => 'FILE',
        );

        $cursor = 0;

        $lines = $this->_docblock->getLines();
        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line)) {
                continue;
            }
            
            if ($cursor == 0 && ($line == '<code>' || $line == '<?php')) {
                ++$cursor;
                if ($line == '<code>') {
                    $line = '<?php';
                }
            } elseif ($cursor == 1 && substr($line, 0, 6) == 'EXPECT') {
                ++$cursor;
                $name = rtrim($line, ':');
                $cursors[] = $name;
                $case[$cursors[$cursor]] = '';
                continue;
            } elseif ($cursor == 1 && $line == '</code>') {
                $line = '?>';
            }
            
            $case[$cursors[$cursor]] .= $line . PHP_EOL;
        }

        if (empty($case['FILE'])) {
            throw new PHPT_DocTest_Parser_InvalidDocTestException();
        }

        foreach ($case as $section => $contents) {
            $this->_parsed_test_case .= '--' . $section . '--' . PHP_EOL . trim($contents) . PHP_EOL;
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

