<?php

class customer_orders extends cart {

    public $conn;
    public $customer_id;
    public $customer_orders_ordernr;
    public $customer_orders = array();
    private $salutation = array(
        'w' => 'Frau',
        'm' => 'Herr',
        'default' => 'Damen und Herren'
    );
    public $order_total = 0;
    public $order_total_shipping = 0;

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

    public function get_carts() {

        if (strlen($this->conn->connect_error) === 0) {

            if (isset($this->customer_orders_ordernr) && strlen($this->customer_orders_ordernr) && $this->customer_orders_all === false) {

                $order = "AND acs_orders_shippings.order_number = '" . $this->customer_orders_ordernr . "'";
            } else {

                $order = "AND acs_orders_shippings.uid = " . $this->customer_id . " ORDER BY acs_orders.id DESC";
            }

            $sql_get = "SELECT acs_orders_shippings.order_number, acs_orders_shippings.anrede, acs_orders_shippings.vorname, acs_orders_shippings.nachname, acs_orders_shippings.strasse, acs_orders_shippings.plz, acs_orders_shippings.stadt, acs_orders.item, acs_orders.price, acs_orders.vat, acs_orders.amount, acs_orders.status, acs_orders.date_ordered, acs_orders.date_delivered, acs_orders.status from acs_orders_shippings LEFT JOIN acs_orders ON acs_orders_shippings.order_number = acs_orders.order_number WHERE acs_orders.status = 'ordered' " . $order;
            $result_get = $this->conn->query($sql_get);

            if ($result_get->num_rows > 0) {

                while ($row = $result_get->fetch_array(MYSQLI_ASSOC)) {

                    if (is_array($this->customer_orders) && !array_key_exists('order_shipping', $this->customer_orders)) {

                        $this->customer_orders[$row['order_number']]['order_shipping']['anrede'] = $row['anrede'];
                        $this->customer_orders[$row['order_number']]['order_shipping']['vorname'] = $row['vorname'];
                        $this->customer_orders[$row['order_number']]['order_shipping']['nachname'] = $row['nachname'];
                        $this->customer_orders[$row['order_number']]['order_shipping']['strasse'] = $row['strasse'];
                        $this->customer_orders[$row['order_number']]['order_shipping']['plz'] = $row['plz'];
                        $this->customer_orders[$row['order_number']]['order_shipping']['stadt'] = $row['stadt'];
                    }

                    $this->customer_orders[$row['order_number']][] = $row;
                }

                return $this->customer_orders;
            } else {

                $this->conn->close();
                return false;
            }
        } else {

            $this->conn->close();
            return false;
        }
    }

    public function gen_salutation_string($salutation) {

        if (($salutation === "w" || $salutation === "m")) {

            $retString = $this->salutation[$salutation];
        } else {

            $retString = $this->salutation['default'];
        }

        return $retString;
    }

    public function get_article($id) {

        if (strlen($this->conn->connect_error) === 0) {

            $sql_product = "SELECT product_name, pid, gid FROM acs_products WHERE id = " . $id . " LIMIT 1";
            $result_product = $this->conn->query($sql_product);

            if ($result_product->num_rows === 1) {

                $row_product = $result_product->fetch_array(MYSQLI_ASSOC);
                return $row_product['product_name'];
            }
        }
    }

    public function calc_order_amounts() {

        foreach ($this->customer_orders[$this->customer_orders_ordernr] as $key => $value) {

            if (is_int($key)) {

                $this->order_total_shipping = $this->order_total_shipping + ($value['vat'] * $value['amount']);
                $this->order_total = $this->order_total + ($value['price'] * $value['amount']);
            }
        }
        $this->order_total = $this->order_total + $this->order_total_shipping;
    }

    public function format_date($date) {

        $date = date("d.m.Y", strToTime($date));

        if ($date === "01.01.1970" || $date === "30.11.-0001") {

            return "In Bearbeitung";
        } else {

            return $date;
        };
    }

}
