<?php
require_once('config.php');

if (isset($_SESSION['user']) && strlen($_SESSION['user']) && (isset($_SESSION['userlevel']) && strlen($_SESSION['userlevel']) && $_SESSION['userlevel'] == 1)) {

    if (empty($_GET)) {

        $administration_orders = new administration_orders();
        $administration_orders->customer_orders_all = true;
        $administration_orders->get_carts();
    } elseif (isset($_GET['od']) && strlen($_GET['od']) && isset($_GET['id']) && strlen($_GET['id'])) {

        $administration_orders = new administration_orders();
        $administration_orders->customer_id = trim($_GET['id']);
        $administration_orders->customer_orders_all = false;
        $administration_orders->customer_orders_ordernr = trim($_GET['od']);
        $administration_orders->get_carts();
        $administration_orders->calc_order_amounts();

        if (isset($_POST['update_order_data']) && strlen($_POST['update_order_data'])) {

            $administration_orders->order_data_post = $_POST;
            $administration_orders->update_admin_order_status();
        }
    }
} else {

    header('Location: ' . HTTP_HOST . ROOT_URL . PROJECT_NAME);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include 'inc/inc-meta.php'; ?>
        <?php
        $set_meta_tags = new set_meta_tags();
        $set_meta_tags->seo_array['title'] = "Bestellungen - Shop";
        $set_meta_tags->seo_array['description'] = "Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.";
        $set_meta_tags->seo_array['keywords'] = "Lorem, ipsum, dolor, sit, amet, consectetuer, adipiscin, elit, Aenean commodo";
        $set_meta_tags->seo_array['index_allow'] = false;
        $set_meta_tags->set_meta_tags_index(true);
        ?>
    </head>
    <body>
        <?php include 'inc/inc-header.php'; ?>
        <div class="content">
            <div class="haeder_logo">
                <img src="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME; ?>/img/administration.jpg" alt="Bestellungen">
            </div>
            <div class="container">
                <div class="wrapper">
                    <h1>Bestellungen</h1>
                    <div class="row">
                        <div class="col-12">
                            <?php
                            if (!isset($_GET['od']) && empty($_GET['od'])) {

                                include 'inc/inc-admin-orders.php';
                            } else if (isset($_GET['od']) && strlen($_GET['od']) && isset($_GET['id']) && strlen($_GET['id'])) {

                                include 'inc/inc-admin-order-errors.php';
                                include 'inc/inc-admin-order-detail.php';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'inc/inc-footer.php'; ?>
        <script src="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME; ?>/js/js_functions.js" type="text/javascript"></script>
        <?php include "inc/inc-debug-console.php"; ?>
    </body>
</html>