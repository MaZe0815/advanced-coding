<a href="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME . '/administration' ?>" class="button" target="_self">Artikel anzeigen</a>
<a href="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME . '/administration-konten' ?>" class="button" target="_self">Benutzerkonten</a>
<a href="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME . '/administration-bestellungen' ?>" class="button" target="_self">Bestellungen</a>
<?php if (is_array($administration_orders->customer_orders) && count($administration_orders->customer_orders) > 0) { ?>
    <table class="u-full-width resp_table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Bestellnummer</th>
                <th>Anrede</th>
                <th>Name</th>
                <th>Nachname</th>
                <th>Strasse</th>
                <th>PLZ</th>
                <th>Stadt</th>
                <th>Artikel</th>
                <th>Datum</th>
                <th>Details</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($administration_orders->customer_orders as $key => $value) { ?>
                <tr>
                    <td><?php echo $value['order_shipping']['id_shipping']; ?></td>
                    <td><a href="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME . '/administration-bestellungen/?od=' . $key . '&id=' . $value['order_shipping']['id_user']; ?>"><?php echo $key; ?></a></td>
                    <td><?php echo $administration_orders->gen_salutation_string($value['order_shipping']['anrede']); ?></td>
                    <td><?php echo $value['order_shipping']['vorname']; ?></td>
                    <td><?php echo $value['order_shipping']['nachname']; ?></td>
                    <td><?php echo $value['order_shipping']['strasse']; ?></td>
                    <td><?php echo $value['order_shipping']['plz']; ?></td>
                    <td><?php echo $value['order_shipping']['stadt']; ?></td>
                    <td><?php echo (count($value) - 1); ?> Stk.</td>
                    <td><?php echo $administration_orders->format_date($value['order_shipping']['date_ordered']); ?></td>
                    <td><a href="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME . '/administration-bestellungen/?od=' . $key . '&id=' . $value['order_shipping']['id_user']; ?>">Details</a></td>
                </tr>
                <tr>
                    <td colspan="11">Status der Bestellung: <?php echo $administration_orders->humanize_order_state($value['order_shipping']['status']); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } else { ?>
    <p>Leider konnten keine Bestellungen ermittelt werden!</p>
<?php }
?>