<?php
if ($products !== false) {
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
                        <?php echo nl2br($get_products->word_cut_string($products[$key]['description'], 0, 20)); ?>
                    </p>
                </div>
                <div class="product_sub">
                    <p>
                        <span class="price"><?php echo number_format($products[$key]['gross_price'], 2, ',', '.'); ?> &euro;</span><br>
                        <span class="gross">inkl. Mwst</span>
                    </p>
                    <a class="add_to_cart button button-primary" href="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME . '/artikeluebersicht?pid=' . $products[$key]['id']; ?>" target="_self">
                        <i class="fa fa-share"></i>
                    </a>
                </div>
            </div>
        </div>
        <?php
    }
}
?>
