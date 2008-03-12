--TEST--
When provided with a docblock comment, it strips away the comment tokens
--ENSURE--
--FILE--
<?php

require_once dirname(__FILE__) . '/_setup.inc';

$string = '/**
 * This is a docblock with example code
 *
 * <code>
 *     echo "Hello World!\n";
 * </code>
 * EXPECT:
 * Hello World!
 */';

$docblock = new PHPT_DocTest_DocBlock($string);

$expected = array(
    'This is a docblock with example code',
    '',
    '<code>',
    '    echo "Hello World!\n";',
    '</code>',
    'EXPECT:',
    'Hello World!',
);

ensure($docblock->getLines())->equals($expected);

?>
===DONE===
--EXPECT--
===DONE===

