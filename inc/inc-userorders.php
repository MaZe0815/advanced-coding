<table class="u-full-width resp_table">
    <thead>
        <tr>
            <th>Bestellnummer</th>
            <th>Versandname</th>
            <th>Versandadresse</th>
            <th>Details</th>
        </tr>
    </thead>
    <tbody>
        <?php if (is_array($customer_orders->customer_orders) && count($customer_orders->customer_orders) > 0) { ?>
            <?php foreach ($customer_orders->customer_orders as $key => $value) { ?>
                <tr>
                    <td><?php echo $key; ?></td>
                    <td><?php echo $customer_orders->gen_salutation_string($value['order_shipping']['anrede']) . "<br>" . $value['order_shipping']['vorname'] . " " . $value['order_shipping']['nachname']; ?></td>
                    <td><?php echo $value['order_shipping']['strasse'] . "<br>" . $value['order_shipping']['plz'] . " " . $value['order_shipping']['stadt']; ?></td>
                    <td><a href="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME . '/kundenkonto/?od=' . $key; ?>">Details</a></td>
                </tr>
            <?php } ?>
        <?php } else { ?>
            <tr>
                <td colspan="3">Leider konnten keine bisherigen Bestellungen ermittelt werden!</td>
            </tr>
        <?php } ?>
    </tbody>
</table>