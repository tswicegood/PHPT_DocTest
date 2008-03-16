--TEST--
If no proper doctest is found, will throw PHPT_DocTest_Parser_InvalidDocTestException
--FILE--
<?php

require_once dirname(__FILE__) . '/_setup.inc';

$text = <<<END
/**
 * this comment does not have a valid doctest in it
 */
END;

$docblock = new PHPT_DocTest_DocBlock($text);
try {
    new PHPT_DocTest_Parser($docblock);
    trigger_error('exception not caught');
} catch (PHPT_DocTest_Parser_InvalidDocTestException $e) {

}

?>
===DONE===
--EXPECT--
===DONE===

