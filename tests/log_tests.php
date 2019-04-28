<?php

    use Logixal\Logging;
    include(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'Logixal' . DIRECTORY_SEPARATOR . 'Logixal.php');

    Logging::information('TestScript', 'Information log!');
    Logging::error('TestScript', 'there was an error');