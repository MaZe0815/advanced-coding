<?php

require_once('../config.php');

if (isset($_POST['PROCESSING_RESULT']) && !empty($_POST['PROCESSING_RESULT'])) {

    echo HTTP_HOST . ROOT_URL . PROJECT_NAME . '/warenkorb?s=' . $_POST['PROCESSING_RESULT'];
} else {

    echo HTTP_HOST . ROOT_URL . PROJECT_NAME . '/warenkorb';
}
