<?php

/**
 * General debug output for console logs
 */
class debug_console {

    public $debug_data;

    /**
     * debug_console constructor.
     */
    function __construct() {

        try {

            $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            $this->conn->set_charset("utf8");

            if ($this->conn->connect_error) {

                throw new Exception('Unable to load database ' . $this->conn->connect_error);
            }
        } catch (Exception $e) {

            echo $e->getMessage(), "\n";
        }
    }

    /**
     *
     */
    function debug_console_output() {

        echo "<script>\r\n//<![CDATA[\r\nif(!console){var console={log:function(){}}}";
        $output = explode("\n", print_r($this->debug_data, true));
        foreach ($output as $line) {
            if (trim($line)) {
                $line = addslashes($line);
                echo "console.log(\"{$line}\");";
            }
        }
        echo "\r\n//]]>\r\n</script>";
        unset($this->debug_data);
    }

}
