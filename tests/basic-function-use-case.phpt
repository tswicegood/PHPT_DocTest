--TEST--
PHPT_DocTest_Generator builds a PHPT test case from a function
--ENSURE--
--FILE--
<?php

require_once dirname(__FILE__) . '/_setup.inc';
require_once dirname(__FILE__) . '/support/phpt_add.php';

ensure(file_exists(dirname(__FILE__) . '/support/tests'))->equals(false);

$generator = new PHPT_DocTest_Generator(dirname(__FILE__) . '/support/tests');

ensure(file_exists(dirname(__FILE__) . '/support/tests'))->equals(true);

$generator->generate('phpt_add');

ensure(file_exists(dirname(__FILE__) . '/support/tests/phpt_add-1.phpt'))->equals(true);

$expected = "--TEST--\n" .
            "This function performs basic mathmatics\n" .
            "--FILE--\n" .
            "<?php\n" .
            '    $sum = phpt_add(2, 2);' . "\n" .
            '    echo $sum, "\n"' . "\n" .
            "?>\n" .
            "===DONE===\n" .
            "--EXPECT--\n" .
            "4\n" .
            "===DONE===";

$actual = trim(file_get_contents(dirname(__FILE__) . '/support/tests/phpt_add-1.phpt'));
//ensure($actual)->equals($expected);

?>
===DONE===
--CLEAN--
<?php include dirname(__FILE__) . '/_clean.inc'; ?>
--EXPECT--
===DONE===

