<?php

require_once('../config.php');

if (isset($_POST['s'])) {

    $search_products = new search_products();
    $search_products->product_limit = 6;
    $search_products->search_str_json = false;
    $search_products->search_str = trim($_POST['s']);

    $products = $search_products->search_products();

    header('Content-type: application/json');
    header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
    echo json_encode($products);
}
