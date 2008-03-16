--TEST--
If no docblock is present in the requested funciton, throw an exception
--FILE--
<?php

require_once dirname(__FILE__) . '/_setup.inc';
require_once PHPT_DOCTEST_SUPPORT_PATH . '/invalid-doctests.php';

$generator = new PHPT_DocTest_Generator(PHPT_DOCTEST_SUPPORT_PATH . '/tests');
try {
    $generator->generate('nodocblock');
    trigger_error('exception not caught');
} catch (PHPT_DocTest_Generator_NoDocblockException $e) {
    
}
?>
===DONE===
--EXPECT--
===DONE===

