<div class="col-3 article_col">
    <div class="card">
        <p>
            <a class="clear_filters" onclick="filter_function('p_g', 0);" > <i class="fa fa-close"></i> Alle Filter l&ouml;schen</a>
        </p>
        <p>Welche Konsole?</p>
        <?php foreach ($product_platforms as $key => $value) { ?>
            <label for="p_<?php echo $product_platforms[$key]['platformID']; ?>"><?php echo $product_platforms[$key]['manufacturer'] . " " . $product_platforms[$key]['platform']; ?></label>
            <input type="radio" name="platform>" id="p_<?php echo $product_platforms[$key]['platformID']; ?>" value="<?php echo $product_platforms[$key]['platformID']; ?>"  onclick="filter_function('p', <?php echo $product_platforms[$key]['platformID']; ?>);"
            <?php
            if ($get_products->filter_console == $product_platforms[$key]['platformID']) {
                echo 'checked="checked"';
            };
            ?>
                   ><br>
               <?php } ?>
        <p>Welches Genre?</p>
        <?php foreach ($product_genres as $key => $value) { ?>
            <label for="g_<?php echo $product_genres[$key]['id']; ?>"><?php echo $product_genres[$key]['name']; ?></label>
            <input type="radio" name="genre" id="g_<?php echo $product_genres[$key]['id']; ?>" value="<?php echo $product_genres[$key]['id']; ?>" onclick="filter_function('g', <?php echo $product_genres[$key]['id']; ?>);"
            <?php
            if ($get_products->filter_genre == $product_genres[$key]['id']) {
                echo 'checked="checked"';
            };
            ?>><br>
               <?php } ?>
        <p>
            <a class="clear_filters" onclick="filter_function('p_g', 0);" > <i class="fa fa-close"></i> Alle Filter l&ouml;schen</a>
        </p>
    </div>
</div>
<?php
if ($products !== false) {
    foreach ($products as $key => $value) {
        ?>
        <div class="col-3">
            <div class="card">
                <div class="limited">
                    <a href="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME . '/artikeluebersicht?pid=' . $products[$key]['id']; ?>" target="_self">
                        <img src="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME . "/" . $products[$key]['images'][0]; ?>" alt="<?php echo $products[$key]['product_name']; ?>">
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
                <div class="description crop">
                    <p class="description">
                        <?php echo nl2br($get_products->word_cut_string($products[$key]['description'], 0, 20)); ?>
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
        <?php
    }
} else {
    ?>
    <p>Leider konnten zu Ihrer Suchanfrage bzw. zur Ihrer Filterung keine Ergebnisse ermittelt werden!</p>
<?php } ?>
