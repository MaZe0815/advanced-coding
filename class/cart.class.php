<?php

class cart extends get_products {

    private $order_praefix = "placeholder";
    private $ordernr_length = 15;

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

    private function gen_order_number() {

        return $this->order_praefix . "_" . substr(md5(rand()), 0, $this->ordernr_length);
    }

    public function add_to_cart() {

    }

    public function get_cart() {

    }

    public function delete_cart() {

    }

    public function checkout_cart() {

    }

}
