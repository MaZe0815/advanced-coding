<a href="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME . '/administration?pa=true' ?>" class="button" target="_self">Artikel hinzuf&uuml;gen</a>
<a href="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME . '/administration-konten' ?>" class="button" target="_self">Benutzerkonten</a>
<a href="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME . '/administration-bestellungen' ?>" class="button" target="_self">Bestellungen</a>
<?php if (is_array($products) && count($products) > 0) { ?>
    <table class="u-full-width resp_table">
        <thead>
            <tr>
                <th>Artikelnummer</th>
                <th>Artikelname</th>
                <th>Plattform</th>
                <th>Genre</th>
                <th>Preis (Netto)</th>
                <th>Bestand</th>
                <th>Status</th>
                <th>&Auml;ndern</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($products !== false) {
                foreach ($products as $key => $value) {
                    ?>
                    <tr>
                        <td><?php echo $products[$key]['id']; ?></td>
                        <td><?php echo $products[$key]['product_name']; ?></td>
                        <td><?php echo $products[$key]['manucafturer_platform']['manufacturer'] . " " . $products[$key]['manucafturer_platform']['platform']; ?></td>
                        <td><?php echo $products[$key]['genre']['name']; ?></td>
                        <td><?php echo number_format($products[$key]['price'], 2, ',', '.'); ?> &euro;</td>
                        <td><?php echo $products[$key]['quantity']; ?> Stk.</td>
                        <td><?php echo $administration->humanize_active_state($products[$key]['active']); ?></td>
                        <td><a href="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME . '/administration?pid=' . $products[$key]['id']; ?>" target="_self">&Auml;ndern</a></td>
                    </tr>
                    <?php
                }
            }
            ?>
        </tbody>
    </table>
<?php } else { ?>
    <tr>
        <td colspan="3">Leider konnten keine Produkte ermittelt werden!</td>
    </tr>
<?php } ?>