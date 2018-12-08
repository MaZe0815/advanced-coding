<?php require_once('config.php'); ?>
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
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="limited">
                                    <img src="../img/covers/BLES01874.jpg" alt="African lion">
                                </div>
                                <div class="cart_details">
                                    <a class="del_cart_item" href="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME; ?>/warenkorb?d=1">
                                        <i class="fa fa-close"></i>
                                    </a>
                                    <div>
                                        <h2>African lion</h2>
                                    </div>
                                    <div class="manufacturer_platform">
                                        <p>
                                            Plattform: <span>Microsoft Xbox One X</span><br>
                                            Genre: <span>Role Playing Spiele</span><br>
                                        </p>
                                    </div>
                                    <div class="product_sub">
                                        <p>
                                            Einzelpreis: <span class="price">112,56 &euro;</span>, <span class="gross">inkl. Mwst</span><br>
                                            Gesamtpreis: <span class="price">112,56 &euro;</span>, <span class="gross">inkl. Mwst</span>
                                        </p>
                                        <form action="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME; ?>/warenkorb" method="post">
                                            <button class="add_to_cart button button-primary">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                            <input type="number" name="quantity" min="1" max="5" readonly="readonly" value="1">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card cart_amounts">
                                <div class="checkout_buttons">
                                    <a class="checkout button button-primary" href="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME; ?>/warenkorb?d=1">
                                        <i class="fa fa-check"></i> Artikel kaufen
                                    </a>
                                    <a class="checkout button button" href="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME; ?>/warenkorb?da=1">
                                        <i class="fa fa-close"></i> Warenkorb leeren
                                    </a>
                                </div>
                                <p>
                                    Versandkosten: <span class="price">112,56 &euro;</span><br>
                                    Gesamtpreis: <span class="price">112,56 &euro;</span><br>
                                    <span class="gross">inkl. Mwst</span>
                                </p>
                            </div>
                        </div>
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