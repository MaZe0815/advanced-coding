<?php foreach ($products as $key => $value) { ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="limited">
                    <img src="<?php echo $products[$key]['rand_image']; ?>" alt="<?php echo $products[$key]['product_name']; ?>">
                </div>
                <div class="cart_details">
                    <a class="del_cart_item" href="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME; ?>/warenkorb?d=<?php echo $products[$key]['item']; ?>">
                        <i class="fa fa-close"></i>
                    </a>
                    <div>
                        <h2><?php echo $products[$key]['product_name']; ?></h2>
                    </div>
                    <div class="manufacturer_platform">
                        <p>
                            Plattform: <span><?php echo $products[$key]['manucafturer_platform']['manufacturer'] . " " . $products[$key]['manucafturer_platform']['platform']; ?></span><br>
                            Genre: <span><?php echo $products[$key]['genre']['name']; ?></span><br>
                        </p>
                    </div>
                    <div class="description crop">
                        <p class="description">
                            <?php echo nl2br($products[$key]['description']); ?>
                        </p>
                    </div>
                    <div class="product_sub">
                        <p>
                            Einzelpreis: <span class="price"><?php echo number_format($products[$key]['gross_price'], 2, ',', '.'); ?> &euro;</span>, <span class="gross">inkl. Mwst</span><br>
                            Gesamtpreis: <span class="price"><?php echo number_format($products[$key]['gross_price_sum'], 2, ',', '.'); ?> &euro;</span>, <span class="gross">inkl. Mwst</span>
                        </p>
                        <form action="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME; ?>/warenkorb/" method="post">
                            <input type="hidden" name="id" value="<?php echo $products[$key]['item']; ?>">
                            <button class="add_to_cart button button-primary">
                                <i class="fa fa-plus"></i>
                            </button>
                            <input type="number" name="quantity" min="1" max="5" value="<?php echo $products[$key]['amount']; ?>">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<div class="row">
    <div class="col-12">
        <div class="card cart_amounts">
            <div class="checkout_buttons">
                <a class="checkout button button-primary" href="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME; ?>/warenkorb/?c=true">
                    <i class="fa fa-check"></i> Artikel kaufen
                </a>
                <a class="checkout button button" href="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME; ?>/warenkorb/?da=true">
                    <i class="fa fa-close"></i> Warenkorb leeren
                </a>
            </div>
            <p>
                Versandkosten: <span class="price"><?php echo number_format($cart->order_total_shipping, 2, ',', '.'); ?> &euro;</span><br>
                Gesamtpreis: <span class="price"><?php echo number_format($cart->order_total, 2, ',', '.'); ?> &euro;</span><br>
                <span class="gross">inkl. Mwst</span>
            </p>
        </div>
    </div>
</div>
