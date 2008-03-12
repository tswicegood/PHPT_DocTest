--TEST--
Can match FILE section based on &lt;?php tags
--ENSURE--
--FILE--
<?php

require_once dirname(__FILE__) . '/_setup.inc';

$text = <<<END
/**
 * Some random test
 *
 * <?php
 *      echo "Hello World!\\n";
 *
 * ?>
 * EXPECT:
 * Hello World!
 */
END;
$docblock = new PHPT_DocTest_DocBlock($text);
$parser = new PHPT_DocTest_Parser($docblock);

$expected = "--TEST--\n"
            . "Some random test\n"
            . "--FILE--\n"
            . "<?php\n"
            . 'echo "Hello World!\n";' . "\n"
            . "?>\n"
            . "===DONE===\n"
            . "--EXPECT--\n"
            . "Hello World!\n"
            . "===DONE===";

ensure(trim($expected))->equals(trim((string)$parser));
?>
===DONE===
--EXPECT--
===DONE===

