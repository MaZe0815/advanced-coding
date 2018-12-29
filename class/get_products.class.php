<?php

class get_products {

    public $conn;
    public $product_id;
    public $curpage = 1;
    public $start;
    public $total_res;
    public $endpage;
    public $startpage = 1;
    public $nextpage;
    public $previouspage;
    public $article_list = true;
    public $product_limit = 9;
    public $filter_genre;
    public $filter_console;
    public $filter_pagination_adds;
    private $value_vat = 19;
    private $cover_dir = "img/covers";
    private $quantity_up_to = 6;
    public $rand_query = false;

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

    public function get_products() {

        if ($this->rand_query === true) {

            $ordering = "ORDER BY RAND()";
        } else {

            $ordering = "ORDER BY product_name asc";
        }

        $this->filter_genre = $this->getv("g");
        $this->filter_console = $this->getv("c");
        $this->filter_pagination_adds = $this->gen_pagaination_param();

        if (strlen($this->conn->connect_error) === 0) {

            if (isset($this->product_id) && strlen($this->product_id)) {

                $this->article_list = false;

                $sql_product = "SELECT id, img_url, product_name, description, price, pid, gid FROM acs_products WHERE id = " . $this->product_id . " AND active = '1' LIMIT 1";
                $result_product = $this->conn->query($sql_product);

                if ($result_product->num_rows === 1) {

                    $row_product[0] = $result_product->fetch_array(MYSQLI_ASSOC);
                    $row_product[0]['manucafturer_platform'] = $this->get_manufacturer_platform($row_product[0]['pid']);
                    $row_product[0]['genre'] = $this->get_genre($row_product[0]['gid']);
                    $row_product[0]['gross_price'] = $this->calc_vat($row_product[0]['price']);
                    $row_product[0]['rand_image'] = HTTP_HOST . ROOT_URL . PROJECT_NAME . "/" . $this->random_pic();
                    $row_product[0]['rand_image_1'] = HTTP_HOST . ROOT_URL . PROJECT_NAME . "/" . $this->random_pic();
                    $row_product[0]['rand_image_2'] = HTTP_HOST . ROOT_URL . PROJECT_NAME . "/" . $this->random_pic();
                    $row_product[0]['rand_image_3'] = HTTP_HOST . ROOT_URL . PROJECT_NAME . "/" . $this->random_pic();

                    return $row_product;
                } else {
                    header('Location: ' . HTTP_HOST . ROOT_URL . PROJECT_NAME . '/artikeluebersicht');
                }
                $this->conn->close();
            } else {

                $this->calc_pagination();
                if ((isset($this->filter_genre) && !empty($this->filter_genre)) && (isset($this->filter_console) && !empty($this->filter_console))) {
                    $sql_product = "SELECT id, gid, img_url, product_name, description, price, pid, gid FROM acs_products WHERE (`pid` = " . $this->filter_console . " AND `gid` = " . $this->filter_genre . ") AND quantity > " . $this->quantity_up_to . " AND active = '1' " . $ordering . " LIMIT " . $this->start . ", " . $this->product_limit;
                } elseif (isset($this->filter_genre) && !empty($this->filter_genre)) {
                    $sql_product = "SELECT id, gid, img_url, product_name, description, price, pid, gid FROM acs_products WHERE `gid` = " . $this->filter_genre . " AND quantity > " . $this->quantity_up_to . " AND active = '1' " . $ordering . " LIMIT " . $this->start . ", " . $this->product_limit;
                } elseif (isset($this->filter_console) && !empty($this->filter_console)) {
                    $sql_product = "SELECT id, gid, img_url, product_name, description, price, pid, gid FROM acs_products WHERE `pid` = " . $this->filter_console . " AND quantity > " . $this->quantity_up_to . " AND active = '1' " . $ordering . " LIMIT " . $this->start . ", " . $this->product_limit;
                } else {
                    $sql_product = "SELECT id, gid, img_url, product_name, description, price, pid, gid FROM acs_products WHERE quantity > " . $this->quantity_up_to . " AND active = '1' " . $ordering . " LIMIT " . $this->start . ", " . $this->product_limit;
                }

                $result_product = $this->conn->query($sql_product);

                if ($result_product->num_rows >= 1) {

                    while ($row = $result_product->fetch_array(MYSQLI_ASSOC)) {

                        $row['manucafturer_platform'] = $this->get_manufacturer_platform($row['pid']);
                        $row['genre'] = $this->get_genre($row['gid']);
                        $row['gross_price'] = $this->calc_vat($row['price']);
                        $row['rand_image'] = $this->random_pic();
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

    public function get_manufacturer_platform($pid) {

        if (strlen($this->conn->connect_error) === 0) {

            $sql_platform = "SELECT acs_manufacturers.name AS manufacturer, acs_platforms.name AS platform FROM acs_platforms LEFT JOIN acs_manufacturers ON acs_manufacturers.id = acs_platforms.mid WHERE acs_platforms.id = " . $pid;
            $result_platform = $this->conn->query($sql_platform);
            $row_platform = $result_platform->fetch_array(MYSQLI_ASSOC);

            return $row_platform;
        } else {

            $this->conn->close();
            return false;
        }
    }

    public function get_manufacturers_platforms() {

        if (strlen($this->conn->connect_error) === 0) {

            $sql_platforms = "SELECT acs_platforms.id AS platformID, acs_platforms.name AS platform, acs_manufacturers.name AS manufacturer FROM acs_platforms LEFT JOIN acs_manufacturers ON acs_manufacturers.id = acs_platforms.mid ORDER BY acs_manufacturers.name asc";
            $result_platforms = $this->conn->query($sql_platforms);

            while ($row = $result_platforms->fetch_array(MYSQLI_ASSOC)) {
                $row_platforms[] = $row;
            }

            return $row_platforms;
        } else {

            $this->conn->close();
            return false;
        }
    }

    public function get_genre($gid) {

        if (strlen($this->conn->connect_error) === 0) {

            $sql_genre = "SELECT name FROM acs_genres WHERE id = " . $gid . " LIMIT 1";
            $result_genre = $this->conn->query($sql_genre);

            $row_genre = $result_genre->fetch_array(MYSQLI_ASSOC);

            return $row_genre;
        } else {

            $this->conn->close();
            return false;
        }
    }

    public function get_genres() {

        if (strlen($this->conn->connect_error) === 0) {

            $sql_genres = "SELECT id, name FROM acs_genres order by name asc";
            $result_genres = $this->conn->query($sql_genres);

            while ($row = $result_genres->fetch_array(MYSQLI_ASSOC)) {
                $row_genres[] = $row;
            }

            return $row_genres;
        } else {

            $this->conn->close();
            return false;
        }
    }

    public function calc_pagination() {

        if (strlen($this->conn->connect_error) === 0) {

            $this->start = ($this->curpage * $this->product_limit) - $this->product_limit;

            if ((isset($this->filter_genre) && !empty($this->filter_genre)) && (isset($this->filter_console) && !empty($this->filter_console))) {
                $sql_product_pages = "SELECT id FROM acs_products WHERE (`pid` = " . $this->filter_console . " AND `gid` = " . $this->filter_genre . ")";
            } elseif (isset($this->filter_console) && !empty($this->filter_console)) {
                $sql_product_pages = "SELECT id FROM acs_products WHERE `pid` = " . $this->filter_console;
            } elseif (isset($this->filter_genre) && !empty($this->filter_genre)) {
                $sql_product_pages = "SELECT id FROM acs_products WHERE `gid` = " . $this->filter_genre;
            } else {
                $sql_product_pages = "SELECT id FROM acs_products";
            }

            $result_product_pages = $this->conn->query($sql_product_pages);
            $this->total_res = mysqli_num_rows($result_product_pages);

            $this->endpage = ceil($this->total_res / $this->product_limit);
            $this->startpage = 1;
            $this->nextpage = $this->curpage + 1;
            $this->previouspage = $this->curpage - 1;
        } else {

            $this->conn->close();
            return false;
        }
    }

    public function calc_vat($price) {

        $gross_price = $price + ( ( $price / 100 ) * $this->value_vat );
        return $gross_price;
    }

    public function word_cut_string($str, $start = 0, $words = 15) {

        $arr = preg_split("/[\s]+/", $str, $words + 1);
        $arr = array_slice($arr, $start, $words);
        return join(' ', $arr);
    }

    private function getv($key, $default = '', $data_type = '') {

        $param = (isset($_REQUEST[$key]) ? $_REQUEST[$key] : $default);

        if (!is_array($param) && $data_type == 'int') {
            $param = intval($param);
        }

        return $param;
    }

    private function gen_pagaination_param() {

        $current_page_v = $this->getv('p');

        if (is_array($current_page_v)) {
            $param_string = "?p=";
        }

        if ((isset($this->filter_genre) && !empty($this->filter_genre)) && (isset($this->filter_console) && !empty($this->filter_console))) {

            return $param_string = "&c=" . $this->filter_console . "&g=" . $this->filter_genre . "#product-listing";
        } else if (isset($this->filter_console) && !empty($this->filter_console)) {

            return $param_string = "&c=" . $this->filter_console . "#product-listing";
        } elseif (isset($this->filter_genre) && !empty($this->filter_genre)) {

            return $param_string = "&g=" . $this->filter_genre . "#product-listing";
        }
    }

    public function random_pic() {

        $arrImage = array();
        $dir = $this->cover_dir; # Directory containing images

        if (is_dir($dir)) {

            $arrImage = glob($dir . '/*.jpg');

            if (count($arrImage) > 0) {

                return $arrImage[array_rand($arrImage)];
            } else {

                return "https://via.placeholder.com/350x408";
            }
        } else {

            return "https://via.placeholder.com/350x408";
        }
    }

}
