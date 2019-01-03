<?php
require_once('config.php');

$get_products = new get_products();

if (isset($_GET['pid']) && strlen($_GET['pid'])) {

    $get_products->product_id = trim($_GET['pid']);
    $products = $get_products->get_products();
} else {

    if (isset($_GET['p']) & !empty($_GET['p'])) {
        $get_products->curpage = trim($_GET['p']);
    }

    $products = $get_products->get_products();
    $product_genres = $get_products->get_genres();
    $product_platforms = $get_products->get_manufacturers_platforms();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include 'inc/inc-meta.php'; ?>
        <?php
        $set_meta_tags = new set_meta_tags();

        if (isset($get_products->article_list) && $get_products->article_list === true) {
            $set_meta_tags->seo_array['title'] = "Seite " . $get_products->curpage . " - Artikel&uuml;bersicht - Placeholder - Shop";
        } else {
            $set_meta_tags->seo_array['title'] = $products[0]['product_name'] . " - Artikeldeteialseite - Placeholder - Shop";
        }
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
                <img src="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME; ?>/img/articles.jpg" alt="Artikel&uuml;bersicht">
            </div>
            <div class="container" id="product-listing">
                <div class="wrapper">
                    <?php if (isset($get_products->article_list) && $get_products->article_list === true) { ?>
                        <h1>Artikel&uuml;bersicht</h1>
                    <?php } else { ?>
                        <h1> Artikeldeteialseite</h1>
                    <?php } ?>
                    <div class="row">
                        <?php
                        if (isset($get_products->article_list) && $get_products->article_list === true) {
                            if ($products !== false) {
                                include 'inc/inc-pagination.php';
                            }
                            include 'inc/inc-article-list.php';
                            if ($products !== false) {
                                include 'inc/inc-pagination.php';
                            }
                        } else {
                            include 'inc/inc-articledetails.php';
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