<?php

class administration_orders extends customer_orders {

    public $conn;
    public $order_data_post;
    public $order_data_error = array();

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

    public function update_admin_order_status() {

        $this->order_data_post = array_map('trim', $this->order_data_post);
        $this->check_errors();

        if (strlen($this->conn->connect_error) === 0) {

            if (is_array($this->order_data_error) && count($this->order_data_error) === 0) {

                switch ($this->order_data_post['status']) {
                    case "ordered":
                        $set_dates = "date_delivered = '', date_canceled = ''";
                        break;
                    case "on_delivery":
                        $set_dates = "date_delivered = CURDATE() + INTERVAL 3 DAY, date_canceled = ''";
                        break;
                    case "canceled":
                        $set_dates = "date_canceled = now()";
                        break;
                }

                $sql_update = "UPDATE acs_orders SET status = '" . $this->order_data_post['status'] . "', " . $set_dates . " WHERE order_number = '" . $this->customer_orders_ordernr . "'";
                $this->conn->query($sql_update);

                header('Location: ' . HTTP_HOST . ROOT_URL . PROJECT_NAME . '/administration-bestellungen?od=' . $this->customer_orders_ordernr . '&id=' . $this->customer_id . '&s=1#notification');
            }
        } else {

            $this->conn->close();
            return false;
        }
    }

    public function check_errors() {

        if (array_key_exists('status', $this->order_data_post) && $this->order_data_post['status'] == '') {

            $this->order_data_error['status'] = 'Bitte Status angeben.';
        }
    }

}
