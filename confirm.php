<?php

require_once('config.php');

if (isset($_GET['u']) && strlen($_GET['u'])) {

    $sendmail = new sendmail();
    $sendmail->send_mail = false;
    $sendmail->id_encoded = trim($_GET['u']);
    $sendmail->id_decoded = $sendmail->decr_hash();

    $sendmail->user = $sendmail->id_decoded[0];
    $sendmail->set_double_opt_in();
} else {

    header('Location: ' . HTTP_HOST . ROOT_URL . PROJECT_NAME);
}