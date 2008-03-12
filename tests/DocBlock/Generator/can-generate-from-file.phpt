--TEST--
DocTest::generateFromFile() will generate tests at the files location
--ENSURE--
--FILE--
<?php

require_once dirname(__FILE__) . '/_setup.inc';

$file = realpath(dirname(__FILE__) . '/../../support/phpt_add.php');

$generator = new PHPT_DocTest_Generator(dirname(__FILE__) . '/../../support/tests');
$generator->generateFromFile($file);

$expected = trim(file_get_contents(PHPT_DOCTEST_SUPPORT_PATH . '/expected/phpt_add-1'));
$actual = trim(file_get_contents(PHPT_DOCTEST_SUPPORT_PATH . '/tests/phpt_add-1.phpt'));

ensure($actual)->equals($expected);

?>
===DONE===
--CLEAN--
<?php include dirname(__FILE__) . '/_clean.inc'; ?>
--EXPECT--
===DONE===
