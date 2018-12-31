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
        <?php if (is_array($customer_orders->customer_orders) && count($customer_orders->customer_orders) > 0) { ?>
            <?php foreach ($customer_orders->customer_orders as $key => $value) { ?>
                <tr>
                    <td><?php echo $key; ?></td>
                    <td><?php echo $customer_orders->gen_salutation_string($value['order_shipping']['anrede']); ?></td>
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
<h2>Ihre bestellten Artikel</h2>
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
            <?php if ($customer_orders->customer_orders[$customer_orders->customer_orders_ordernr]['order_shipping']['status'] != "canceled") { ?>
                <th>Datum Lieferung</th>
            <?php } else { ?>
                <th>Datum Storno</th>
            <?php } ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($customer_orders->customer_orders[$customer_orders->customer_orders_ordernr] as $key => $value) { ?>
            <?php
            $vat;
            if (is_int($key)) {

                $vat = floatval($value['vat']) * floatval($value['amount']);
                ?>
                <tr>
                    <td><?php echo $value['item']; ?></td>
                    <td><a href="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME . '/artikeluebersicht?pid=' . $value['item']; ?>" target="_blank"><?php echo $customer_orders->get_article($value['item']); ?></a></td>
                    <td><?php echo $value['amount']; ?> Stk.</td>
                    <td><?php echo number_format($value['price'], 2, ',', '.'); ?> &euro; pro Stk.</td>
                    <td><?php echo number_format($value['vat'], 2, ',', '.'); ?> &euro; pro Stk.</td>
                    <td><?php echo $customer_orders->humanize_order_state($value['status']); ?></td>
                    <td><?php echo $customer_orders->format_date($value['date_ordered']); ?></td>
                    <?php if ($value['status'] != "canceled") { ?>
                        <td><?php echo $customer_orders->format_date($value['date_delivered']); ?></td>
                    <?php } else { ?>
                        <td><?php echo $customer_orders->format_date($value['date_canceled']); ?></td>
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
            <td><?php echo number_format($customer_orders->order_total, 2, ',', '.'); ?> &euro;</td>
            <td><?php echo number_format($customer_orders->order_total_shipping, 2, ',', '.'); ?> &euro;</td>
        </tr>
    </tbody>
</table>