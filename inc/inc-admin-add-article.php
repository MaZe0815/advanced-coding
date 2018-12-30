<div class="row">
    <div class="col-5">
        <form action="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME; ?>/administration/?pa=true#notification" method="post">
            <input type="hidden" name="add_article_data" value="1">
            <label for="product_name">Artikel aktiv oder inaktiv schalten</label>
            <select class="eingabefeld <?php if (array_key_exists('active', $administration->product_data_error)) { ?>fehler<?php } ?>" name="active">
                <option value=""<?php if ($administration->product_data_post['active'] === "") { ?> selected="selected"<?php } ?>>Bitte w&auml;hlen</option>
                <option value="1"<?php if ($administration->product_data_post['active'] === "1") { ?> selected="selected"<?php } ?>>Online</option>
                <option value="0"<?php if ($administration->product_data_post['active'] === "0") { ?> selected="selected"<?php } ?>>Offline</option>
            </select>
            <label for="pid">Plattform</label>
            <select class="eingabefeld <?php if (array_key_exists('pid', $administration->product_data_error)) { ?>fehler<?php } ?>" name="pid">
                <option value=""<?php if ($administration->product_data_post['pid'] === "") { ?> selected="selected"<?php } ?>>Bitte w&auml;hlen</option>
                <?php foreach ($platforms as $key => $value) { ?>
                    <option value="<?php echo $platforms[$key]['platformID']; ?>"<?php if ($administration->product_data_post['pid'] === $platforms[$key]['platformID']) { ?> selected="selected"<?php } ?>><?php echo $platforms[$key]['manufacturer'] . " " . $platforms[$key]['platform']; ?></option>
                <?php } ?>
            </select>

            <label for="gid">Genre</label>
            <select class="eingabefeld <?php if (array_key_exists('gid', $administration->product_data_error)) { ?>fehler<?php } ?>" name="gid">
                <option value=""<?php if ($administration->product_data_post['gid'] === "") { ?> selected="selected"<?php } ?>>Bitte w&auml;hlen</option>
                <?php foreach ($genres as $key => $value) { ?>
                    <option value="<?php echo $genres[$key]['id']; ?>"<?php if ($administration->product_data_post['gid'] === $genres[$key]['id']) { ?> selected="selected"<?php } ?>><?php echo $genres[$key]['name']; ?></option>
                <?php } ?>
            </select>

            <label for="product_name">Artikelname</label>
            <input type="text" placeholder="Artikelname*" class="eingabefeld <?php if (array_key_exists('product_name', $administration->product_data_error)) { ?>fehler<?php } ?>" name="product_name" value="<?php echo $administration->product_data_post['product_name']; ?>">
            <label for="price">Preis (Netto)</label>
            <input type="text" placeholder="Preis (Netto)*" class="eingabefeld <?php if (array_key_exists('price', $administration->product_data_error)) { ?>fehler<?php } ?>" name="price" value="<?php echo $administration->product_data_post['price']; ?>">
            <label for="quantity">Bestand</label>
            <input type="text" placeholder="Bestand*" class="eingabefeld <?php if (array_key_exists('quantity', $administration->product_data_error)) { ?>fehler<?php } ?>" name="quantity" value="<?php echo $administration->product_data_post['quantity']; ?>">
            <label for="description">Beschreibung</label>
            <textarea placeholder="Beschreibung*" class="eingabefeld <?php if (array_key_exists('description', $administration->product_data_error)) { ?>fehler<?php } ?>" name="description" rows="50"><?php echo $administration->product_data_post['description']; ?></textarea>
            <input class="eingabefeld" type="submit" value="Jetzt anlegen!">
        </form>
    </div>
    <div class="col-7">
        <p>Image stuff goes here...</p>
    </div>
</div>