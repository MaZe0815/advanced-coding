<?php

class checkout {

    public $conn;
    private $heidelpay_url = "https://test-heidelpay.hpcgw.net/sgw/gtw";
    private $heidelpay_params = array();
    private $user_params = array();
    private $heidelpay_result;
    private $heidelpay_str;
    public $cpt;
    public $cpt_result;
    public $cpt_info;
    public $cpt_error;
    public $cpt_response = array();
    public $cpt_response_frontend = false;
    public $cpt_response_frontend_state = "NOK";

    /**
     * checkout constructor.
     */
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

    /**
     *
     */
    public function set_heidelpay_basics() {

        $this->heidelpay_params['SECURITY.SENDER'] = "31HA07BC810C91F08643A5D477BDD7C0";
        $this->heidelpay_params['USER.LOGIN'] = "31ha07bc810c91f086431f7471d042d6";
        $this->heidelpay_params['USER.PWD'] = "password";
        $this->heidelpay_params['TRANSACTION.CHANNEL'] = "31HA07BC810C91F086433734258F6628";
        $this->heidelpay_params['PRESENTATION.CURRENCY'] = "EUR";
        $this->heidelpay_params['FRONTEND.RESPONSE_URL'] = HTTP_HOST . ROOT_URL . PROJECT_NAME . "/ajax/async_checkout_response/";
        $this->heidelpay_params['FRONTEND.RETURN_ACCOUNT'] = false;
        $this->heidelpay_params['FRONTEND.MODE'] = "DEFAULT";
        $this->heidelpay_params['TRANSACTION.MODE'] = "INTEGRATOR_TEST";
        $this->heidelpay_params['FRONTEND.ENABLED'] = "true";
        $this->heidelpay_params['FRONTEND.POPUP'] = "false";
        $this->heidelpay_params['FRONTEND.REDIRECT_TIME'] = "0";
        $this->heidelpay_params['FRONTEND.LANGUAGE_SELECTOR'] = "false";
        $this->heidelpay_params['FRONTEND.LANGUAGE'] = "DE";
        $this->heidelpay_params['REQUEST.VERSION'] = "1.0";
        $this->heidelpay_params['FRONTEND.CSS_PATH'] = HTTP_HOST . ROOT_URL . PROJECT_NAME . "/css/styles.css";
    }

    /**
     * @return bool
     */
    public function set_user() {

        if (strlen($this->conn->connect_error) === 0) {

            $sql_user = "SELECT username, anrede, vorname, nachname, strasse, plz, stadt FROM acs_userlegitimation WHERE id = " . $_SESSION['user'] . " and dataprotection = 1 LIMIT 1";
            $result_user = $this->conn->query($sql_user);

            if ($result_user->num_rows === 1) {

                $this->user_params = $result_user->fetch_array(MYSQLI_ASSOC);

                $this->heidelpay_params['NAME.GIVEN'] = utf8_decode($this->user_params['vorname']);
                $this->heidelpay_params['NAME.FAMILY'] = utf8_decode($this->user_params['nachname']);
                $this->heidelpay_params['ADDRESS.STREET'] = utf8_decode($this->user_params['strasse']);
                $this->heidelpay_params['ADDRESS.ZIP'] = $this->user_params['plz'];
                $this->heidelpay_params['ADDRESS.CITY'] = utf8_decode($this->user_params['stadt']);
                $this->heidelpay_params['ADDRESS.COUNTRY'] = "DE";
                $this->heidelpay_params['CONTACT.EMAIL'] = $this->user_params['username'];
            }
        } else {

            $this->conn->close();
            return false;
        }
    }

    /**
     *
     */
    public function set_amounts() {

        $cart = new cart();
        $cart->calc_cart_amounts();

        $this->heidelpay_params['PRESENTATION.AMOUNT'] = number_format($cart->order_total, 2, '.', '');
        $this->heidelpay_params['IDENTIFICATION.TRANSACTIONID'] = $_SESSION['order']['order_number'];
        $this->heidelpay_params['PRESENTATION.USAGE'] = 'Bestellnummer: ' . $_SESSION['order']['order_number'];
        $this->heidelpay_params['PAYMENT.CODE'] = "CC.DB";
    }

    public function request_heidelpay() {

        foreach ($this->heidelpay_params AS $key => $value) {

            $this->heidelpay_result .= strtoupper($key) . '=' . urlencode($value) . '&';
            $this->heidelpay_str = stripslashes($this->heidelpay_result);
        }
    }

    /**
     *
     */
    public function init_payments() {

        $this->cpt = curl_init();
        curl_setopt($this->cpt, CURLOPT_URL, $this->heidelpay_url);
        curl_setopt($this->cpt, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($this->cpt, CURLOPT_USERAGENT, "php heidelpaypost");
        curl_setopt($this->cpt, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->cpt, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($this->cpt, CURLOPT_POST, 1);
        curl_setopt($this->cpt, CURLOPT_POSTFIELDS, $this->heidelpay_str);

        $this->cpt_result = curl_exec($this->cpt);
        $this->cpt_error = curl_error($this->cpt);
        $this->cpt_info = curl_getinfo($this->cpt);
        curl_close($this->cpt);

        $r_arr = explode("&", $this->cpt_result);

        foreach ($r_arr AS $buf) {

            $temp = urldecode($buf);
            $temp2 = explode('=', $temp, 2);
            $this->cpt_response[$temp2[0]] = $temp2[1];
            unset($temp2);
            unset($temp);
        }

        if (!isset($this->cpt_response['FRONTEND.REDIRECT_URL']) && !strlen($this->cpt_response['FRONTEND.REDIRECT_URL'])) {

            header('Location: ' . HTTP_HOST . ROOT_URL . PROJECT_NAME . '/warenkorb/');
        }
    }

}
