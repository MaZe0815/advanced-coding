<?php foreach ($products as $key => $value) {
    ?>
    <div class="col-4">
        <div class="card">
            <img src="../<?php echo $products[$key]['rand_image']; ?>" alt="<?php echo $products[$key]['product_name']; ?>">
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
            <div class="description">
                <p class="description">
                    <?php echo nl2br($products[$key]['description']); ?>
                </p>
            </div>
            <div class="product_sub">
                <p>
                    <span class="price"><?php echo number_format($products[$key]['gross_price'], 2, ',', '.'); ?> &euro;</span><br>
                    <span class="gross">inkl. Mwst</span>
                </p>
                <button class="add_to_cart button-primary">
                    <i class="fa fa-shopping-cart"></i>
                </button>
            </div>
        </div>
    </div>
<?php } ?>
