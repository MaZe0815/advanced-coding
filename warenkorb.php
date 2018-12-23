<?php
require_once('config.php');

$cart = new cart();
$products = $cart->get_cart();
$cart->calc_cart_amounts();

if (isset($_POST['id']) && strlen($_POST['id']) && isset($_POST['quantity']) && strlen($_POST['quantity'])) {

    $cart->add_to_cart($_POST['id'], $_POST['quantity']);
} elseif (isset($_GET['da']) && strlen($_GET['da']) && $_GET['da'] === "true") {

    $cart->delete_cart();
} elseif (isset($_GET['d']) && strlen($_GET['d'])) {

    $cart->delete_cart($_GET['d']);
} elseif (isset($_GET['c']) && strlen($_GET['c'])) {

    $checkout = new checkout();
    $checkout->set_heidelpay_basics();
    $checkout->set_user();
    $checkout->set_amounts();
    $checkout->request_heidelpay();
    $checkout->init_payments();
} elseif (isset($_GET['s']) && strlen($_GET['s'])) {

    switch ($_GET['s']) {

        case "ACK":
            $checkout = new checkout();
            $checkout->cpt_response_frontend = true;
            $checkout->cpt_response_frontend = $_GET['s'];

            $cart = new cart();
            $cart->set_final_amounts();
            $cart->check_out_order($checkout->cpt_response_frontend);
            break;

        case "NOK":
            $checkout = new checkout();
            $checkout->cpt_response_frontend = false;
            $checkout->cpt_response_frontend = $_GET['s'];
            break;
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include 'inc/inc-meta.php'; ?>
        <?php
        $set_meta_tags = new set_meta_tags();
        $set_meta_tags->seo_array['title'] = "Warenkorb - Shop";
        $set_meta_tags->seo_array['description'] = "Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.";
        $set_meta_tags->seo_array['keywords'] = "Lorem, ipsum, dolor, sit, amet, consectetuer, adipiscin, elit, Aenean commodo";
        $set_meta_tags->seo_array['index_allow'] = false;
        $set_meta_tags->set_meta_tags_index(true);
        ?>
    </head>
    <body>
        <?php include 'inc/inc-header.php'; ?>
        <div class="content cart">
            <div class="haeder_logo">
                <img src="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME; ?>/img/cart.jpg" alt="Warenkorb">
            </div>
            <div class="container">
                <div class="wrapper">
                    <h1>Warenkorb</h1>
                    <?php
                    if (isset($_GET['c']) && strlen($_GET['c'])) {

                        include 'inc/inc-checkout.php';
                    } elseif (isset($_GET['s']) && strlen($_GET['s'])) {

                        include 'inc/inc-checkout-response.php';
                    } else {

                        include 'inc/inc-cart.php';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php include 'inc/inc-footer.php'; ?>
    <script src="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME; ?>/js/js_functions.js" type="text/javascript"></script>
    <?php include "inc/inc-debug-console.php"; ?>
</body>
</html>