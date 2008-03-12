--TEST--
Can generate multiple tests from a given file
--ENSURE--
--FILE--
<?php

require_once dirname(__FILE__) . '/_setup.inc';

$generator = new PHPT_DocTest_Generator(PHPT_DOCTEST_SUPPORT_PATH . '/tests');
$generator->generateFromFile(PHPT_DOCTEST_SUPPORT_PATH . '/arithmetic.php');

ensure(file_exists(PHPT_DOCTEST_SUPPORT_PATH . '/tests/phpt_subtract-1.phpt'))->true();
ensure(file_exists(PHPT_DOCTEST_SUPPORT_PATH . '/tests/phpt_multiply-1.phpt'))->true();

?>
===DONE===
--CLEAN--
<?php include dirname(__FILE__) . '/_clean.inc'; ?>
--EXPECT--
===DONE===
