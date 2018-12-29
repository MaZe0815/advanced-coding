<?php

class administration extends get_products {

    public $conn;
    private $quantity_up_to = 0;
    public $product_id;
    public $curpage = 1;
    public $start;
    public $total_res;
    public $endpage;
    public $startpage = 1;
    public $nextpage;
    public $previouspage;
    public $product_limit = 25;
    public $product_data;
    public $product_data_post;
    public $product_data_error = array();

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

    public function get_admin_products() {

        $ordering = "ORDER BY product_name asc";

        if (strlen($this->conn->connect_error) === 0) {

            if (isset($this->product_id) && strlen($this->product_id)) {

                $this->article_list = false;

                $sql_product = "SELECT id, img_url, product_name, description, price, pid, gid, quantity, active FROM acs_products WHERE id = " . $this->product_id . " LIMIT 1";
                $result_product = $this->conn->query($sql_product);

                if ($result_product->num_rows === 1) {

                    $row_product[0] = $result_product->fetch_array(MYSQLI_ASSOC);
                    $row_product[0]['manucafturer_platform'] = parent::get_manufacturer_platform($row_product[0]['pid']);
                    $row_product[0]['genre'] = parent::get_genre($row_product[0]['gid']);

                    return $row_product;
                } else {
                    header('Location: ' . HTTP_HOST . ROOT_URL . PROJECT_NAME . '/artikeluebersicht');
                }
                $this->conn->close();
            } else {

                parent::calc_pagination();

                $sql_product = "SELECT id, gid, img_url, product_name, description, price, pid, gid, quantity, active FROM acs_products WHERE quantity > " . $this->quantity_up_to . " " . $ordering . " LIMIT " . $this->start . ", " . $this->product_limit;

                $result_product = $this->conn->query($sql_product);

                if ($result_product->num_rows >= 1) {

                    while ($row = $result_product->fetch_array(MYSQLI_ASSOC)) {

                        $row['manucafturer_platform'] = parent::get_manufacturer_platform($row['pid']);
                        $row['genre'] = parent::get_genre($row['gid']);
                        $row_product[] = $row;
                    }

                    return $row_product;
                } else {
                    return false;
                }
                $this->conn->close();
            }
        } else {

            $this->conn->close();
            return false;
        }
    }

    public function update_admin_product() {

        $this->product_data_post = array_map('trim', $this->product_data_post);
        $this->check_update_errors();

        if (strlen($this->conn->connect_error) === 0) {

            if (is_array($this->product_data_error) && count($this->product_data_error) === 0) {

                $sql_update = "UPDATE acs_products SET product_name = '" . $this->product_data_post['product_name'] . "', price = '" . $this->product_data_post['price'] . "', quantity = '" . $this->product_data_post['quantity'] . "', description = '" . $this->product_data_post['description'] . "', active = '" . $this->product_data_post['active'] . "', date_updated = now() WHERE id = '" . $this->product_id . "' LIMIT 1";
                $this->conn->query($sql_update);

                header('Location: ' . HTTP_HOST . ROOT_URL . PROJECT_NAME . '/administration?pid=' . $this->product_id . '&s=1#notification');
            }
        } else {

            $this->conn->close();
            return false;
        }
    }

    public function humanize_active_state($state) {

        if ($state === "1") {

            return "Online";
        } else {

            return "Offline";
        }
    }

    public function check_update_errors() {

        $this->product_data_post['quantity'] = (int) $this->product_data_post['quantity'];
        $this->product_data_post['price'] = (float) $this->product_data_post['price'];


        if ($this->product_data_post['product_name'] == '') {

            $this->product_data_error['product_name'] = 'Bitte Produktnamen angeben.';
        }

        if ($this->product_data_post['price'] == '' || !is_float($this->product_data_post['price'])) {

            $this->product_data_error['price'] = 'Bitte Preis angeben.';
        }

        if ($this->product_data_post['quantity'] == '' || !is_int($this->product_data_post['quantity'])) {

            $this->product_data_error['quantity'] = 'Bitte den Bestand angeben.';
        }

        if ($this->product_data_post['description'] == '') {

            $this->product_data_error['description'] = 'Bitte Beschreibung angeben.';
        }
    }

}
