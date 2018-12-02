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
    private $product_limit = 8;

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

    function get_products() {

        if (strlen($this->conn->connect_error) === 0) {

            if (isset($this->product_id) && strlen($this->product_id)) {

                $this->article_list = false;

                $sql_product = "SELECT id, img_url, product_name, description, price, pid, gid FROM acs_products WHERE id = " . $this->product_id . " LIMIT 1";
                $result_product = $this->conn->query($sql_product);

                if ($result_product->num_rows === 1) {

                    $row_product[0] = $result_product->fetch_array(MYSQLI_ASSOC);
                    $row_product[0]['manucafturer_platform'] = $this->get_manufacturer_platform($row_product[0]['pid']);
                    $row_product[0]['genre'] = $this->get_genre($row_product[0]['gid']);
                    return $row_product;
                } else {
                    header('Location: ' . HTTP_HOST . ROOT_URL . PROJECT_NAME . '/artikeluebersicht');
                }
                $this->conn->close();
            } else {

                $this->calc_pagination();

                $sql_product = "SELECT id, img_url, product_name, description, price, pid, gid FROM acs_products order by id asc LIMIT " . $this->start . ", " . $this->product_limit;
                $result_product = $this->conn->query($sql_product);

                if ($result_product->num_rows >= 2) {

                    while ($row = $result_product->fetch_array(MYSQLI_ASSOC)) {

                        $row['manucafturer_platform'] = $this->get_manufacturer_platform($row['pid']);
                        $row['genre'] = $this->get_genre($row['gid']);
                        $row_product[] = $row;
                    }

                    return $row_product;
                }
                $this->conn->close();
            }
        }
    }

    private function get_manufacturer_platform($pid) {

        $sql_platform = "SELECT acs_manufacturers.name AS manufacturer, acs_platforms.name AS platform FROM acs_platforms LEFT JOIN acs_manufacturers ON acs_manufacturers.id = acs_platforms.mid WHERE acs_platforms.id = " . $pid;
        $result_platform = $this->conn->query($sql_platform);
        $row_platform = $result_platform->fetch_array(MYSQLI_ASSOC);

        return $row_platform;
    }

    private function get_genre($gid) {

        $sql_genre = "SELECT name FROM acs_genres WHERE id = " . $gid . " LIMIT 1";
        $result_genre = $this->conn->query($sql_genre);

        $row_genre = $result_genre->fetch_array(MYSQLI_ASSOC);

        return $row_genre;
    }

    private function calc_pagination() {

        $this->start = ($this->curpage * $this->product_limit) - $this->product_limit;

        $sql_product_pages = "SELECT * FROM acs_products";
        $result_product_pages = $this->conn->query($sql_product_pages);
        $this->total_res = mysqli_num_rows($result_product_pages);

        $this->endpage = ceil($this->total_res / $this->product_limit);
        $this->startpage = 1;
        $this->nextpage = $this->curpage + 1;
        $this->previouspage = $this->curpage - 1;
    }

    function word_cut_string($str, $start = 0, $words = 15) {

        $arr = preg_split("/[\s]+/", $str, $words + 1);
        $arr = array_slice($arr, $start, $words);
        return join(' ', $arr);
    }

}
