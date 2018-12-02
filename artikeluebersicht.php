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
}
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include 'inc/inc-meta.php'; ?>
        <?php
        $set_meta_tags = new set_meta_tags();

        if (isset($get_products->article_list) && $get_products->article_list === true) {
            $set_meta_tags->seo_array['title'] = "Seite " . $get_products->curpage . " - Artikel&uuml;bersicht - Shop";
        } else {
            $set_meta_tags->seo_array['title'] = $products[0]['product_name'] . " - Artikeldeteialseite - Shop";
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
            <?php include 'inc/inc-menu.php'; ?>
            <div class="container">
                <div class="wrapper">
                    <h1>Artikel&uuml;bersicht</h1>
                    <?php
                    if (isset($get_products->article_list) && $get_products->article_list === true) {
                        include 'inc/inc-pagination.php';
                    }
                    ?>
                    <div class="row">
                        <?php
                        foreach ($products as $key => $value) {
                            ?>
                            <div class="col-3">
                                <div class="card">
                                    <div class="limited">
                                        <a href="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME . '/artikeluebersicht?pid=' . $products[$key]['id']; ?>" target="_self">
                                            <img src="<?php echo $products[$key]['img_url']; ?>" alt="<?php echo $products[$key]['product_name']; ?>">
                                        </a>
                                    </div>
                                    <div>
                                        <h2><?php echo $products[$key]['product_name']; ?></h2>
                                    </div>
                                    <div class="manufacturer_platform">
                                        <p class="manufacturer_platform">
                                            Plattform: <span><?php echo $products[$key]['manucafturer_platform']['manufacturer'] . " " . $products[$key]['manucafturer_platform']['platform']; ?></span><br>
                                            Genre: <span><?php echo $products[$key]['genre']['name']; ?></span><br>
                                            <a href="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME . '/artikeluebersicht?pid=' . $products[$key]['id']; ?>" target="_self">Jetzt Details ansehen</a>
                                        </p>
                                    </div>
                                    <div class="description">
                                        <p class="description">
                                            <?php echo $get_products->word_cut_string($products[$key]['description'], 0, 20); ?>
                                        </p>
                                    </div>
                                    <div class="product_sub">
                                        <p class="price"><?php echo number_format($products[$key]['price'], 2, '.', ''); ?> €</p>
                                        <button class="add_to_cart button-primary">
                                            <i class="fa fa-shopping-cart"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <?php
                    if (isset($get_products->article_list) && $get_products->article_list === true) {
                        include 'inc/inc-pagination.php';
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php include 'inc/inc-footer.php'; ?>
        <script src="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME; ?>/js/js_functions.js" type="text/javascript"></script>
        <?php include "inc/inc-debug-console.php"; ?>
    </body>
</html>