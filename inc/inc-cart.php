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
                        <input type="hidden" value="0">
                        <button class="add_to_cart button button-primary">
                            <i class="fa fa-plus"></i>
                        </button>
                        <input type="number" name="quantity" min="1" max="5" value="1">
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
