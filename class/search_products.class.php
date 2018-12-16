<?php

class search_products extends get_products {

    public $conn;
    public $search_str;
    public $search_str_json = true;

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

    public function search_products() {

        if (strlen($this->conn->connect_error) === 0) {

            $sql_product = "SELECT id, product_name, price, pid, gid FROM acs_products WHERE MATCH(product_name) AGAINST('" . $this->search_str . "*' IN BOOLEAN MODE) ORDER BY MATCH(product_name) AGAINST('" . $this->search_str . "*' IN BOOLEAN MODE)  LIMIT " . $this->product_limit;
            $result_product = $this->conn->query($sql_product);

            if ($result_product->num_rows === 1) {

                $row_product[0] = $result_product->fetch_array(MYSQLI_ASSOC);
                $row_product[0]['manucafturer_platform'] = parent::get_manufacturer_platform($row_product[0]['pid']);
                $row_product[0]['genre'] = parent::get_genre($row_product[0]['gid']);
                $row_product[0]['gross_price'] = parent::calc_vat($row_product[0]['price']);

                $this->conn->close();

                if ($this->search_str_json === true) {

                    return json_encode($row_product);
                } else {
                    return $row_product;
                }
            }if ($result_product->num_rows >= 2) {

                while ($row = $result_product->fetch_array(MYSQLI_ASSOC)) {

                    $row['manucafturer_platform'] = parent::get_manufacturer_platform($row['pid']);
                    $row['genre'] = parent::get_genre($row['gid']);
                    $row['gross_price'] = parent::calc_vat($row['price']);
                    $row_product[] = $row;
                }

                $this->conn->close();

                if ($this->search_str_json === true) {

                    return json_encode($row_product);
                } else {
                    return $row_product;
                }
            } else {
                return false;
            }
        } else {

            $this->conn->close();
            return false;
        }
    }

}
