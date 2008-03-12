--TEST--
Can generate test for classes
--ENSURE--
--FILE--
<?php

require_once dirname(__FILE__) . '/_setup.inc';
require_once PHPT_DOCTEST_SUPPORT_PATH . '/simple-class.php';

$generator = new PHPT_DocTest_Generator(PHPT_DOCTEST_SUPPORT_PATH . '/tests');
$generator->generate('PHPTSomeSimpleClass');

ensure(file_exists(PHPT_DOCTEST_SUPPORT_PATH . '/tests/PHPTSomeSimpleClass-1.phpt'))->true();

$expected = trim(file_get_contents(PHPT_DOCTEST_SUPPORT_PATH . '/expected/PHPTSomeSimpleClass-1'));
$actual = trim(file_get_contents(PHPT_DOCTEST_SUPPORT_PATH . '/tests/PHPTSomeSimpleClass-1.phpt'));
ensure($expected)->equals($actual);

?>
===DONE===
--CLEAN--
<?php include dirname(__FILE__) . '/_clean.inc'; ?>
--EXPECT--
===DONE===

