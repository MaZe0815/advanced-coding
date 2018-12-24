<?php

require_once('config.php');

if (isset($_GET['u']) && strlen($_GET['u']) && isset($_GET['w']) && strlen($_GET['w'])) {

    $sendmail = new sendmail();
    $sendmail->send_mail = false;
    $sendmail->user = trim($_GET['u']);
    $sendmail->emailing_template = base64_decode(trim($_GET['w']));
    $sendmail->gen_email();
} else {

    header('Location: ' . HTTP_HOST . ROOT_URL . PROJECT_NAME);
}