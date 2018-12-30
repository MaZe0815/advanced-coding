<div class="row">
    <div class="col-5">
        <form action="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME; ?>/administration/?pid=<?php echo $administration->product_id; ?>#notification" method="post">
            <input type="hidden" name="set_article_data" value="1">
            <label for="active">Artikel aktiv oder inaktiv schalten</label>
            <select class="eingabefeld <?php if (array_key_exists('active', $administration->product_data_error)) { ?>fehler<?php } ?>" name="active">
                <option value="1"<?php if ($products[0]['active'] === "1") { ?> selected="selected"<?php } ?>>Online</option>
                <option value="0"<?php if ($products[0]['active'] === "0") { ?> selected="selected"<?php } ?>>Offline</option>
            </select>
            <label for="product_name">Artikelname</label>
            <input type="text" placeholder="Artikelname*" class="eingabefeld <?php if (array_key_exists('product_name', $administration->product_data_error)) { ?>fehler<?php } ?>" name="product_name" value="<?php echo $products[0]['product_name']; ?>"<?php if ($products[0]['active'] === "0") { ?> readonly="readonly"<?php } ?>>
            <label for="price">Preis (Netto)</label>
            <input type="text" placeholder="Preis*" class="eingabefeld <?php if (array_key_exists('price', $administration->product_data_error)) { ?>fehler<?php } ?>" name="price" value="<?php echo $products[0]['price']; ?>"<?php if ($products[0]['active'] === "0") { ?> readonly="readonly"<?php } ?>>
            <label for="quantity">Bestand</label>
            <input type="text" placeholder="Bestand*" class="eingabefeld <?php if (array_key_exists('quantity', $administration->product_data_error)) { ?>fehler<?php } ?>" name="quantity" value="<?php echo $products[0]['quantity']; ?>"<?php if ($products[0]['active'] === "0") { ?> readonly="readonly"<?php } ?>>
            <label for="description">Beschreibung</label>
            <textarea placeholder="Beschreibung*" class="eingabefeld <?php if (array_key_exists('description', $administration->product_data_error)) { ?>fehler<?php } ?>" name="description" rows="50"<?php if ($products[0]['active'] === "0") { ?> readonly="readonly"<?php } ?>><?php echo $products[0]['description']; ?></textarea>
            <input class="eingabefeld" type="submit" value="Jetzt aktualisieren!">
        </form>
    </div>
    <div class="col-7">
        <p>Image stuff goes here...</p>
    </div>
</div>