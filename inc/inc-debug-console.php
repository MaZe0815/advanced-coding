<?php

if (strlen(DEBUG_OUTPUT) && DEBUG_OUTPUT === 'true') {

    try {
        $debug_console = new debug_console();
        $debug_console->debug_console_output();
    } catch (Exception $e) {
        echo $e->getMessage(), "\n";
    }
}