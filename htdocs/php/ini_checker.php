<?php

$modules = get_loaded_extensions();

highlight_string(
    '<?php ' . PHP_EOL  . PHP_EOL .
    ' $modules = ' .
    var_export($modules,true)
    . ';'
);
