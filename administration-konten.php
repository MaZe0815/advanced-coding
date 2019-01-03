<?php
require_once('config.php');

if (isset($_SESSION['user']) && strlen($_SESSION['user']) && (isset($_SESSION['userlevel']) && strlen($_SESSION['userlevel']) && $_SESSION['userlevel'] == 1)) {

    if (empty($_GET)) {

        $administraction_accounts = new administraction_accounts();
        $administraction_accounts->customer_id = false;
        $administraction_accounts->get_customer_data();
    } elseif (isset($_GET['aid']) & !empty($_GET['aid'])) {

        $administraction_accounts = new administraction_accounts();
        $administraction_accounts->customer_id = trim($_GET['aid']);
        $administraction_accounts->get_customer_data();

        if (isset($_POST['update_account_data']) && strlen($_POST['update_account_data'])) {

            $administraction_accounts = new administraction_accounts();
            $administraction_accounts->customer_id = trim($_GET['aid']);

            $administraction_accounts->customer_data = $_POST;
            $administraction_accounts->customer_data_post = $_POST;
            $administraction_accounts->update_admin_account();
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
        $set_meta_tags->seo_array['title'] = "Administration Konten - Placeholder - Shop";
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
                <img src="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME; ?>/img/administration.jpg" alt="Benutzerkonten">
            </div>
            <div class="container">
                <div class="wrapper">
                    <h1>Benutzerkonten</h1>
                    <div class="row">
                        <div class="col-12">
                            <?php
                            if (!isset($_GET['aid']) && empty($_GET['aid'])) {

                                include 'inc/inc-admin-accounts.php';
                            } else if (isset($_GET['aid']) && !empty($_GET['aid'])) {

                                include 'inc/inc-admin-account-errors.php';
                                include 'inc/inc-admin-account.php';
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