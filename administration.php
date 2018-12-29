<?php
require_once('config.php');

if (isset($_SESSION['user']) && strlen($_SESSION['user']) && (isset($_SESSION['userlevel']) && strlen($_SESSION['userlevel']) && $_SESSION['userlevel'] == 1)) {

    $administration = new administration();
    $products = $administration->get_admin_products();

    if (isset($_GET['p']) & !empty($_GET['p'])) {
        $administration->curpage = trim($_GET['p']);
        $products = $administration->get_admin_products();
    }

    if (isset($_GET['pid']) && strlen($_GET['pid'])) {

        $administration->product_id = trim($_GET['pid']);
        $products = $administration->get_admin_products();

        if (isset($_POST['set_article_data']) && strlen($_POST['set_article_data'])) {

            $administration->product_data_post = $_POST;
            $products[0] = $_POST;
            $administration->update_admin_product();

            print_r($administration->product_data_error);
        }
    } else {
        $genres = $administration->get_genres();
        $platforms = $administration->get_manufacturers_platforms();
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
        $set_meta_tags->seo_array['title'] = "Administration - Shop";
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
                <img src="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME; ?>/img/administration.jpg" alt="Administration">
            </div>
            <div class="container">
                <div class="wrapper">
                    <h1>Administration</h1>
                    <div class="row">
                        <div class="col-12">
                            <?php
                            if (!isset($_GET['pid']) && empty($_GET['pid'])) {

                                include 'inc/inc-admin-pagination.php';
                                include 'inc/inc-admin-articles.php';
                                include 'inc/inc-admin-pagination.php';
                            } elseif (isset($_GET['pid']) && !empty($_GET['pid'])) {

                                include 'inc/inc-admin-errors.php';
                                include 'inc/inc-admin-article.php';
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