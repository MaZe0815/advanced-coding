<?php

class sendmail {

    public $send_mail;
    public $mail_to_id;
    private $salutation = array(
        'w' => 'Sehr geehrte Frau',
        'm' => 'Sehr geehrter Herr',
        'default' => 'Sehr geehrte Damen und Herren'
    );
    private $mail_SMTP = true;
    private $mail_host = 'smtp.gmail.com';
    private $mail_SMTP_user = '';
    private $mail_SMTP_pass = '';
    private $mail_dir = '/mail_templates/';
    public $mail_to;
    public $mail_to_name;
    public $mail_subject;
    public $mail_template_HTML;
    public $mail_success_send;
    private $from_email = 'bestellungen@example.biz';
    private $from_email_name = 'Bestellungen (Placeholder Shop)';
    private $no_reply_email = 'noreply@example.biz';
    private $no_reply_email_name = 'Bestellungen (Placeholder Shop)';
    protected $admin_email_bcc = array();
    private $root_url;
    private $url_web_version = '/webversion.php?w=###EMAILINGTEMPLATE###&amp;u=###USER###';
    private $url_web_version_params;
    public $emailing_template;
    public $emailing_message;
    public $user;
    public $id_encoded;
    public $id_decoded;
    public $id_string;
    private $id_delemiter = ':';
    private $opt_secret = 'PlaceholderShop';

    /**
     * sendmail constructor.
     */
    function __construct() {

        $this->root_url = HTTP_HOST . ROOT_URL . PROJECT_NAME;

        try {

            $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            //$this->conn->set_charset("utf8");

            if ($this->conn->connect_error) {

                throw new Exception('Unable to load database ' . $this->conn->connect_error);
            }
        } catch (Exception $e) {

            echo $e->getMessage(), "\n";
        }
    }

    /**
     * @throws phpmailerException
     */
    function gen_email() {

        if (isset($this->send_mail) && $this->send_mail === true && (HTTP_HOST === "https://acws191.erlenkaemper.eu" || HTTP_HOST === "http://acws191.erlenkaemper.eu")) {

            $this->replace_placeholder_markup();

            $mail = new phpmailer;
            $mail->isSMTP(true);
            $mail->SMTPDebug = 0;
            $mail->Debugoutput = 'html';
            $mail->Host = $this->mail_host;
            $mail->Port = 587;
            $mail->SMTPSecure = 'tls';
            $mail->SMTPAuth = true;
            $mail->Username = $this->mail_SMTP_user;
            $mail->Password = $this->mail_SMTP_pass;
            $mail->setFrom($this->from_email, $this->from_email_name);
            $mail->addReplyTo($this->no_reply_email, $this->no_reply_email_name);
            $mail->addAddress($this->mail_to, $this->mail_to_name);

            foreach ($this->admin_email_bcc as $bccer) {

                $mail->AddBCC($bccer);
            }

            $mail->Subject = $this->mail_subject;
            $mail->msgHTML($this->emailing_message, dirname(__FILE__));

            if (!$mail->send()) {

                $this->mail_success_send = false;
            } else {

                $this->mail_success_send = true;
            }
        } else {

            $this->replace_placeholder_markup();

            echo $this->emailing_message;
            exit();
        }
    }

    /**
     *
     */
    function replace_placeholder_markup() {

        if (isset($this->send_mail) && $this->send_mail === true) {

            $this->user = $this->gen_hash();
        }

        $salutation_string = $this->gen_salutation_string();

        $this->url_web_version_params = str_replace("###USER###", $this->user, $this->root_url . $this->url_web_version);
        $this->url_web_version_params = str_replace("###EMAILINGTEMPLATE###", base64_encode($this->emailing_template), $this->url_web_version_params);

        $this->emailing_message = file_get_contents($this->root_url . $this->mail_dir . $this->emailing_template);
        $this->emailing_message = str_replace("###WEBVERSION###", $this->url_web_version_params, $this->emailing_message);
        $this->emailing_message = str_replace("###SALUTATIONSTRING###", $salutation_string, $this->emailing_message);
        $this->emailing_message = str_replace("###ROOTPATH###", $this->root_url . $this->mail_dir, $this->emailing_message);
        $this->emailing_message = str_replace("###ROOTPATHSITE###", $this->root_url, $this->emailing_message);
        $this->emailing_message = str_replace("###USER###", $this->user, $this->emailing_message);
    }

    /**
     * @return mixed|string
     */
    function gen_salutation_string() {

        if (isset($this->mail_to) && (strlen($this->mail_to) && $this->send_mail === true)) {

            $sql_user = "SELECT anrede, vorname, nachname FROM acs_userlegitimation WHERE id =" . $this->mail_to_id . " LIMIT 1";
            $result_user = $this->conn->query($sql_user);

            $row_user = $result_user->fetch_array(MYSQLI_ASSOC);
        } elseif (isset($this->user) && (isset($this->user) && $this->send_mail === false)) {

            $this->id_encoded = $this->user;
            $decr_hash = $this->decr_hash();

            $sql_user = "SELECT anrede, vorname, nachname FROM acs_userlegitimation WHERE id =" . $decr_hash[0] . " LIMIT 1";
            $result_user = $this->conn->query($sql_user);

            $row_user = $result_user->fetch_array(MYSQLI_ASSOC);
        }

        if (is_array($row_user) && (isset($row_user['anrede']) && strlen($row_user['anrede'])) && (isset($row_user['nachname']) && strlen($row_user['nachname']))) {

            $retString = $this->salutation[$row_user['anrede']];

            if (isset($this->send_mail) && $this->send_mail === false) {
                $retString .= ' <span style="color: #6cf;">' . utf8_encode($row_user['nachname']) . '</span>';
            } else {
                $retString .= ' <span style="color: #6cf;">' . $row_user['nachname'] . '</span>';
            }
        } else {

            $retString = ' <span style="color: #6cf;">' . $this->salutation['default'] . '</span>';
        }

        return $retString;
    }

    /**
     * @return string
     */
    function gen_hash() {

        if (isset($this->mail_to_id) && strlen($this->mail_to_id)) {

            $sql_user = "SELECT id, username, anrede, vorname, nachname FROM acs_userlegitimation WHERE id =" . $this->mail_to_id . " LIMIT 1";
            $result_user = $this->conn->query($sql_user);

            $result = "";

            if ($result_user->num_rows > 0) {

                $row_user = $result_user->fetch_array(MYSQLI_ASSOC);

                if ((isset($row_user['id']) && strlen($row_user['id'])) && (isset($row_user['username']) && strlen($row_user['username']))) {

                    unset($this->id_encoded);
                    $this->id_string = $row_user['id'] . $this->id_delemiter . $row_user['anrede'] . $this->id_delemiter . $row_user['username'];

                    for ($i = 0; $i < strlen($this->id_string); $i++) {

                        $char = substr($this->id_string, $i, 1);
                        $keychar = substr($this->opt_secret, ($i % strlen($this->opt_secret)) - 1, 1);
                        $ordChar = ord($char);
                        $ordKeychar = ord($keychar);
                        $sum = $ordChar + $ordKeychar;
                        $char = chr($sum);
                        $result .= $char;
                    }

                    $this->id_encoded = rtrim(strtr(base64_encode($result), '+/', '-_'), '=');
                    return $this->id_encoded;
                }
            }
            $this->conn->close();
        }
    }

    /**
     * @return array
     */
    function decr_hash() {

        if (isset($this->id_encoded) && strlen($this->id_encoded)) {

            unset($this->id_decoded);
            $result = "";
            $this->id_string = base64_decode(str_pad(strtr($this->id_encoded, '-_', '+/'), strlen($this->id_encoded) % 4, '=', STR_PAD_RIGHT));

            for ($i = 0; $i < strlen($this->id_string); $i++) {

                $char = substr($this->id_string, $i, 1);
                $keychar = substr($this->opt_secret, ($i % strlen($this->opt_secret)) - 1, 1);
                $ordChar = ord($char);
                $ordKeychar = ord($keychar);
                $sum = $ordChar - $ordKeychar;
                $char = chr($sum);
                $result .= $char;
            }

            $this->id_decoded = $result;
            $user_exploded = explode($this->id_delemiter, $this->id_decoded);

            return $user_exploded;
        }
    }

    /**
     *
     */
    function set_double_opt_in() {

        $sql_user = "SELECT id FROM acs_userlegitimation WHERE id = " . $this->id_decoded[0] . " and dataprotection = '1' LIMIT 1";
        $result_user = $this->conn->query($sql_user);

        if ($result_user->num_rows === 1) {

            $sql_update = "UPDATE acs_userlegitimation SET double_opt_in = '1' WHERE id = " . $this->id_decoded[0] . " and dataprotection = '1' LIMIT 1";
            $this->conn->query($sql_update);

            header('Location: ' . HTTP_HOST . ROOT_URL . PROJECT_NAME . '/login/');
        }
        $this->conn->close();
    }

}
