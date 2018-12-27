<?php

require_once('../config.php');

if (isset($_POST['s']) && !empty($_POST['s'])) {

    $search_products = new search_products();
    $search_products->product_limit = 5;
    $search_products->search_str_json = false;
    $search_products->search_str = trim($_POST['s']);

    $products = $search_products->search_products();

    header('Content-type: application/json');
    header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
    echo json_encode($products);
} else {

    header('Location: ' . HTTP_HOST . ROOT_URL . PROJECT_NAME . '/artikeluebersicht');
}
