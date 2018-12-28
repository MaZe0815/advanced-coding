<?php

class customer_account {

    public $conn;
    public $customer_id;
    public $customer_data;
    public $customer_data_post;
    public $customer_data_error = array();
    private $salutation = array(
        'w' => 'Sehr geehrte Frau',
        'm' => 'Sehr geehrter Herr',
        'default' => 'Sehr geehrte Damen und Herren'
    );

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

    public function get_customer_data() {

        if (strlen($this->conn->connect_error) === 0) {

            $sql_user = "SELECT anrede, vorname, nachname, strasse, plz, stadt FROM acs_userlegitimation WHERE id = " . $this->customer_id . " AND dataprotection = '1' LIMIT 1";
            $result_user = $this->conn->query($sql_user);

            if ($result_user->num_rows > 0) {

                $row_user = $result_user->fetch_array(MYSQLI_ASSOC);

                $this->customer_data = $row_user;
            }
        } else {

            $this->conn->close();
            return false;
        }
    }

    public function set_customer_data() {

        $this->customer_data = $this->customer_data_post;
        $this->customer_data = array_map('trim', $this->customer_data);
        $this->check_errors();

        if (strlen($this->conn->connect_error) === 0) {

            if (is_array($this->customer_data_error) && count($this->customer_data_error) === 0) {

                $sql_update = "UPDATE acs_userlegitimation SET anrede = '" . $this->customer_data['anrede'] . "', vorname = '" . $this->customer_data['vorname'] . "', nachname = '" . $this->customer_data['nachname'] . "', strasse = '" . $this->customer_data['strasse'] . "', plz = '" . $this->customer_data['plz'] . "', stadt = '" . $this->customer_data['stadt'] . "' WHERE id = '" . $this->customer_id . "' AND dataprotection = '1' LIMIT 1";
                $this->conn->query($sql_update);

                header('Location: ' . HTTP_HOST . ROOT_URL . PROJECT_NAME . '/kundenkonto?s=1#notification');
            }
        } else {

            $this->conn->close();
            return false;
        }
    }

    public function gen_salutation_string() {

        if (is_array($this->customer_data) && (isset($this->customer_data['anrede']) && strlen($this->customer_data['anrede'])) && (isset($this->customer_data['nachname']) && strlen($this->customer_data['nachname']))) {

            $retString = $this->salutation[$this->customer_data['anrede']];
            $retString .= " " . $this->customer_data['nachname'];
        } else {

            $retString = $this->salutation['default'];
        }

        return $retString;
    }

    public function check_errors() {

        if ($this->customer_data_post['anrede'] == '') {

            $this->customer_data_error['anrede'] = 'Bitte w&auml;hlen Sie Ihre Anrede.';
        }

        if ($this->customer_data_post['vorname'] == '') {

            $this->customer_data_error['vorname'] = 'Bitte geben Sie Ihren Vornamen an.';
        }

        if ($this->customer_data_post['nachname'] == '') {

            $this->customer_data_error['nachname'] = 'Bitte geben Sie Ihren Nachnamen an.';
        }

        if ($this->customer_data_post['strasse'] == '') {

            $this->customer_data_error['strasse'] = 'Bitte geben Sie Ihre Strasse an.';
        }

        if ($this->customer_data_post['plz'] == '') {

            $this->customer_data_error['plz'] = 'Bitte geben Sie Ihre Postleitzahl an.';
        }

        if ($this->customer_data_post['stadt'] == '') {

            $this->customer_data_error['stadt'] = 'Bitte geben Sie Ihre Stadt an.';
        }
    }

}
