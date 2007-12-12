<?php

function PHPT_DocTest_Test_Autoload($class) {
  @include dirname(__FILE__) . '/../src/' . str_replace('_', '/', $class) . '.php';
}

spl_autoload_register('PHPT_DocTest_Test_Autoload');

if (!class_exists('PHPT_Framework')) {
    require_once dirname(__FILE__) . '/../../../Core/trunk/src/PHPT/Framework.php';
}

require dirname(__FILE__) . '/_remove-tests.inc';

