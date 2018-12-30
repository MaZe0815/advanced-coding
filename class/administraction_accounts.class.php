<?php

class administraction_accounts extends customer_account {

    public $conn;

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

    public function update_admin_account() {

        $this->customer_data_post = array_map('trim', $this->customer_data_post);
        $this->check_errors();

        if (strlen($this->conn->connect_error) === 0) {

            if (is_array($this->customer_data_error) && count($this->customer_data_error) === 0) {

                $sql_update = "UPDATE acs_userlegitimation SET userlevel = '" . $this->customer_data_post['userlevel'] . "', active = '" . $this->customer_data_post['active'] . "' WHERE id = '" . $this->customer_id . "' LIMIT 1";
                $this->conn->query($sql_update);

                header('Location: ' . HTTP_HOST . ROOT_URL . PROJECT_NAME . '/administration-konten?aid=' . $this->customer_id . '&s=1#notification');
            }
        } else {

            $this->conn->close();
            return false;
        }
    }

    public function check_errors() {

        if ($this->customer_data_post['active'] == '') {

            $this->customer_data_error['anrede'] = 'Bitte w&auml;hlen Sie den Status.';
        }

        if ($this->customer_data_post['userlevel'] == '') {

            $this->customer_data_error['userlevel'] = 'Bitte geben Sie die Rolle an.';
        }
    }

    public function humanize_userlevel($userlevel) {

        if ($userlevel === "1") {

            return "Admin";
        } else {

            return "Kunde";
        }
    }

    public function humanize_optin_state($state) {

        if ($state === "1") {

            return "Best&auml;tigt";
        } else {

            return "Offen";
        }
    }

    public function humanize_active_state($state) {

        if ($state === "1") {

            return "Aktiv";
        } else {

            return "Inaktiv";
        }
    }

}
