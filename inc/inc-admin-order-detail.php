<div class="row">
    <div class="col-3">
        <form action="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME; ?>/administration-bestellungen/?od=<?php echo $administration_orders->customer_orders_ordernr; ?>&id=<?php echo $administration_orders->customer_id; ?>" method="post">
            <input type="hidden" name="update_order_data" value="1">
            <label for="status">Status der Bestellung</label>
            <select class="eingabefeld <?php if (array_key_exists('status', $administration_orders->order_data_error)) { ?>fehler<?php } ?>" name="status">
                <option value=""<?php if ($administration_orders->customer_orders[$administration_orders->customer_orders_ordernr]['order_shipping']['status'] === "") { ?> selected="selected"<?php } ?> disabled="disabled">Bitte w&auml;hlen</option>
                <option value="ordered"<?php if ($administration_orders->customer_orders[$administration_orders->customer_orders_ordernr]['order_shipping']['status'] === "ordered") { ?> selected="selected"<?php } ?>>Bestellt</option>
                <option value="on_delivery"<?php if ($administration_orders->customer_orders[$administration_orders->customer_orders_ordernr]['order_shipping']['status'] === "on_delivery") { ?> selected="selected"<?php } ?>>Lieferung</option>
                <option value="canceled"<?php if ($administration_orders->customer_orders[$administration_orders->customer_orders_ordernr]['order_shipping']['status'] === "canceled") { ?> selected="selected"<?php } ?>>Storniert</option>
            </select>
            <input class="eingabefeld" type="submit" value="Jetzt aktualisieren!">
        </form>
    </div>
</div>
<table class="u-full-width resp_table">
    <thead>
        <tr>
            <th>Bestellnummer</th>
            <th>Anrede</th>
            <th>Vorname</th>
            <th>Nachname</th>
            <th>Strasse</th>
            <th>Postleitzahl</th>
            <th>Ort</th>
        </tr>
    </thead>
    <tbody>
        <?php if (is_array($administration_orders->customer_orders) && count($administration_orders->customer_orders) > 0) { ?>
            <?php foreach ($administration_orders->customer_orders as $key => $value) { ?>
                <tr>
                    <td><?php echo $key; ?></td>
                    <td><?php echo $administration_orders->gen_salutation_string($value['order_shipping']['anrede']); ?></td>
                    <td><?php echo $value['order_shipping']['vorname']; ?></td>
                    <td><?php echo $value['order_shipping']['nachname']; ?></td>
                    <td><?php echo $value['order_shipping']['strasse']; ?></td>
                    <td><?php echo $value['order_shipping']['plz']; ?></td>
                    <td><?php echo $value['order_shipping']['stadt']; ?></td>
                </tr>
            <?php } ?>
        <?php } ?>
    </tbody>
</table>
<h2>Die bestellten Artikel</h2>
<table class="u-full-width resp_table">
    <thead>
        <tr>
            <th>Artikelnummer</th>
            <th>Artikelname</th>
            <th>Menge</th>
            <th>Preis inkl. Mwst.</th>
            <th>Versankosten inkl. Mwst.</th>
            <th>Status</th>
            <th>Datum Bestellung</th>
            <?php if ($administration_orders->customer_orders[$administration_orders->customer_orders_ordernr]['order_shipping']['status'] != "canceled") { ?>
                <th>Datum Lieferung</th>
            <?php } else { ?>
                <th>Datum Storno</th>
            <?php } ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($administration_orders->customer_orders[$administration_orders->customer_orders_ordernr] as $key => $value) { ?>
            <?php
            $vat;
            if (is_int($key)) {

                $vat = floatval($value['vat']) * floatval($value['amount']);
                ?>
                <tr>
                    <td><?php echo $value['item']; ?></td>
                    <td><a href="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME . '/artikeluebersicht?pid=' . $value['item']; ?>" target="_blank"><?php echo $administration_orders->get_article($value['item']); ?></a></td>
                    <td><?php echo $value['amount']; ?> Stk.</td>
                    <td><?php echo number_format($value['price'], 2, ',', '.'); ?> &euro; pro Stk.</td>
                    <td><?php echo number_format($value['vat'], 2, ',', '.'); ?> &euro; pro Stk.</td>
                    <td><?php echo $administration_orders->humanize_order_state($value['status']); ?></td>
                    <td><?php echo $administration_orders->format_date($value['date_ordered']); ?></td>
                    <?php if ($value['status'] != "canceled") { ?>
                        <td><?php echo $administration_orders->format_date($value['date_delivered']); ?></td>
                    <?php } else { ?>
                        <td><?php echo $administration_orders->format_date($value['date_canceled']); ?></td>
                    <?php } ?>
                </tr>
            <?php } ?>
        <?php } ?>
    </tbody>
</table>
<h2>Gesamtsumme der Bestellung</h2>
<table class="u-full-width resp_table">
    <thead>
        <tr>
            <th>Gesamtsumme Bestellung inkl. Versandkosten</th>
            <th>Gesamtsumme Versandkosten</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?php echo number_format($administration_orders->order_total, 2, ',', '.'); ?> &euro;</td>
            <td><?php echo number_format($administration_orders->order_total_shipping, 2, ',', '.'); ?> &euro;</td>
        </tr>
    </tbody>
</table>