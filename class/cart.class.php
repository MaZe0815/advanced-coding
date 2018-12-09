<?php

class cart extends get_products {

    private $order_praefix = "placeholder";
    private $ordernr_length = 15;
    private $order_shipping = 1.50;
    public $order_total = 0;
    public $order_total_shipping = 0;
    private $order_status = "in_cart";

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

    public function add_to_cart($id, $quantity) {

        if (!isset($_SESSION['order'])) {

            $_SESSION['order']['order_number'] = $this->gen_order_number();
        }

        $sql_is_set = "SELECT id FROM acs_orders WHERE item = " . $id . " AND order_number = '" . $_SESSION['order']['order_number'] . "' and status = '" . $this->order_status . "' LIMIT 1";
        $result_is_set = $this->conn->query($sql_is_set);

        if ($result_is_set->num_rows > 0) {
            $sql_update = "UPDATE acs_orders SET amount = " . $quantity . ", date_cart =  now() WHERE item = " . $id . " AND order_number = '" . $_SESSION['order']['order_number'] . "' LIMIT 1";
            $this->conn->query($sql_update);
        } else {
            $sql_insert = "INSERT INTO " . DB_TABLE_NAME . " acs_orders (id, order_number, item, price, amount, status, date_cart) VALUES ('', '" . $_SESSION['order']['order_number'] . "', '" . $id . "', '', '" . $quantity . "', '" . $this->order_status . "',  now())";
            $this->conn->query($sql_insert);
        }

        header('Location: ' . HTTP_HOST . ROOT_URL . PROJECT_NAME . '/warenkorb/');
    }

    public function get_cart() {

        $sql_get = "SELECT acs_orders.item, acs_orders.amount, acs_products.img_url, acs_products.product_name, acs_products.price, acs_products.pid, acs_products.gid FROM acs_orders LEFT JOIN acs_products ON acs_orders.item = acs_products.id WHERE acs_products.id = acs_orders.item AND order_number = '" . $_SESSION['order']['order_number'] . "' and status = '" . $this->order_status . "'";
        $result_get = $this->conn->query($sql_get);

        if ($result_get->num_rows === 1) {

            $row_items[0] = $result_get->fetch_array(MYSQLI_ASSOC);

            $row_items[0]['manucafturer_platform'] = parent::get_manufacturer_platform($row_items[0]['pid']);
            $row_items[0]['genre'] = parent::get_genre($row_items[0]['gid']);
            $row_items[0]['gross_price'] = parent::calc_vat($row_items[0]['price']);
            $row_items[0]['gross_price_sum'] = $this->calc_item_sum_price($row_items[0]['gross_price'], $row_items[0]['amount']);
            $row_items[0]['rand_image'] = HTTP_HOST . ROOT_URL . PROJECT_NAME . "/" . parent::random_pic();

            return $row_items;
        } elseif ($result_get->num_rows >= 1) {

            while ($row = $result_get->fetch_array(MYSQLI_ASSOC)) {

                $row['manucafturer_platform'] = parent::get_manufacturer_platform($row['pid']);
                $row['genre'] = parent::get_genre($row['gid']);
                $row['gross_price'] = parent::calc_vat($row['price']);
                $row['gross_price_sum'] = $this->calc_item_sum_price($row['gross_price'], $row['amount']);
                $row['rand_image'] = HTTP_HOST . ROOT_URL . PROJECT_NAME . "/" . $this->random_pic();
                $row_items[] = $row;
            }

            return $row_items;
        } else {
            header('Location: ' . HTTP_HOST . ROOT_URL . PROJECT_NAME);
        }
    }

    public function delete_cart($item = false) {

        if ($item === false) {

            $sql_delete = "DELETE FROM acs_orders WHERE order_number = '" . $_SESSION['order']['order_number'] . "' and status = '" . $this->order_status . "'";
            $this->conn->query($sql_delete);

            unset($_SESSION['order']);
        } else {

            $sql_delete = "DELETE FROM acs_orders WHERE order_number = '" . $_SESSION['order']['order_number'] . "' and status = '" . $this->order_status . "' AND item = " . $item;
            $this->conn->query($sql_delete);

            $sql_check = "SELECT COUNT(id) AS cart_count FROM acs_orders WHERE order_number = '" . $_SESSION['order']['order_number'] . "' and status = '" . $this->order_status . "'";
            $result_check = $this->conn->query($sql_check);

            $cart_check = $result_check->fetch_array(MYSQLI_ASSOC);

            if ($cart_check['cart_count'] == "0") {

                unset($_SESSION['order']);
            }
        }

        header('Location: ' . HTTP_HOST . ROOT_URL . PROJECT_NAME . '/warenkorb/');
    }

    public function checkout_cart() {

    }

    private function calc_item_sum_price($price, $amount) {

        return ($price * $amount);
    }

    public function calc_cart_amounts() {

        $sql_amount = "SELECT acs_orders.item, acs_orders.amount, acs_products.price FROM acs_orders LEFT JOIN acs_products ON acs_orders.item = acs_products.id WHERE acs_products.id = acs_orders.item AND order_number = '" . $_SESSION['order']['order_number'] . "' and status = '" . $this->order_status . "'";
        $result_amount = $this->conn->query($sql_amount);

        if ($result_amount->num_rows === 1) {

            $row_items[0] = $result_amount->fetch_array(MYSQLI_ASSOC);

            $this->order_total_shipping = $this->order_total_shipping + ($this->order_shipping * $row_items[0]['amount']);
            $this->order_total = (parent::calc_vat($row_items[0]['price']) + $this->order_total_shipping);

            return $row_items;
        } elseif ($result_amount->num_rows >= 1) {

            while ($row = $result_amount->fetch_array(MYSQLI_ASSOC)) {

                $this->order_total = ($this->order_total + parent::calc_vat($row['price']));
                $this->order_total_shipping = $this->order_total_shipping + ($this->order_shipping * $row['amount']);
            }
            $this->order_total = ($this->order_total + $this->order_total_shipping);
        }
    }

    private function gen_order_number() {

        return $this->order_praefix . substr(md5(rand()), 0, $this->ordernr_length);
    }

}
