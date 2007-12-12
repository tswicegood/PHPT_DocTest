<?php

if (file_exists(dirname(__FILE__) . '/support/tests')) {
    $dir_iterator = new DirectoryIterator(dirname(__FILE__) . '/support/tests');
    foreach ($dir_iterator as $file) {
        if ($file->isDot()) {
            continue;
        }
        unlink($file->getRealPath());
    }
    unset($dir_iterator);
    rmdir(dirname(__FILE__) . '/support/tests');
}

