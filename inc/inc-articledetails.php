<?php foreach ($products as $key => $value) {
    ?>
    <div class="col-4">
        <div class="card">
            <div class="large_detail_wrapper">
                <img src="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME . "/" . $products[$key]['images'][0]; ?>" alt="<?php echo $products[$key]['product_name']; ?>" id="large_detail">
            </div>
            <div id="slideshow">
                <?php
                for ($i = 0; $i <= 2; $i++) {
                    if (array_key_exists($i, $products[$key]['images'])) {
                        ?>
                        <a onclick="show_large('<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME . "/" . $products[$key]['images'][$i]; ?>');">
                            <img src="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME . "/" . $products[$key]['images'][$i]; ?>" alt="<?php echo $products[$key]['product_name']; ?>">
                        </a>
                    <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <div class="col-8">
        <div class="card">
            <div>
                <h2><?php echo $products[$key]['product_name']; ?></h2>
            </div>
            <div class="manufacturer_platform">
                <p class="manufacturer_platform">
                    Plattform: <span><?php echo $products[$key]['manucafturer_platform']['manufacturer'] . " " . $products[$key]['manucafturer_platform']['platform']; ?></span><br>
                    Genre: <span><?php echo $products[$key]['genre']['name']; ?></span><br>
                </p>
            </div>
            <div class="description_details crop">
                <p class="description">
    <?php echo nl2br($products[$key]['description']); ?>
                </p>
            </div>
            <div class="product_sub">
                <p>
                    <span class="price"><?php echo number_format($products[$key]['gross_price'], 2, ',', '.'); ?> &euro;</span><br>
                    <span class="gross">inkl. Mwst</span>
                </p>
                <form action="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME; ?>/warenkorb/" method="post">
                    <input type="hidden" name="id" value="<?php echo $products[$key]['id']; ?>">
                    <button class="add_to_cart button-primary">
                        <i class="fa fa-shopping-cart"></i>
                    </button>
                    <input type="number" name="quantity" min="1" max="5" value="1">
                </form>
            </div>
        </div>
    </div>
<?php } ?>