<a href="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME . '/administration' ?>" class="button" target="_self">Artikel anzeigen</a>
<a href="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME . '/administration-konten' ?>" class="button" target="_self">Benutzerkonten</a>
<a href="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME . '/administration-bestellungen' ?>" class="button" target="_self">Bestellungen</a>
<?php if (is_array($administraction_accounts->customer_data) && count($administraction_accounts->customer_data) > 0) { ?>
    <table class="u-full-width resp_table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Rolle</th>
                <th>Anrede</th>
                <th>Vorname</th>
                <th>Nachname</th>
                <th>E-Mail Adresse</th>
                <th>Strasse</th>
                <th>Postleitzahl</th>
                <th>Stadt</th>
                <th>Ändern</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($administraction_accounts->customer_data !== false) {
                foreach ($administraction_accounts->customer_data as $key => $value) {
                    ?>
                    <tr>
                        <td><?php echo $administraction_accounts->customer_data[$key]['id']; ?></td>
                        <td><?php echo $administraction_accounts->humanize_userlevel($administraction_accounts->customer_data[$key]['userlevel']); ?></td>
                        <td><?php echo $administraction_accounts->gen_short_salutation_string($administraction_accounts->customer_data[$key]['anrede']); ?></td>
                        <td><?php echo $administraction_accounts->customer_data[$key]['vorname']; ?></td>
                        <td><?php echo $administraction_accounts->customer_data[$key]['nachname']; ?></td>
                        <td><a href="mailtto:<?php echo $administraction_accounts->customer_data[$key]['username']; ?>?subject=Ihr Benutzerkonto (Placeholder Shop)"><?php echo $administraction_accounts->customer_data[$key]['username']; ?></a></td>
                        <td><?php echo $administraction_accounts->customer_data[$key]['strasse']; ?></td>
                        <td><?php echo $administraction_accounts->customer_data[$key]['plz']; ?></td>
                        <td><?php echo $administraction_accounts->customer_data[$key]['stadt']; ?></td>
                        <td><a href="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME . '/administration-konten?aid=' . $administraction_accounts->customer_data[$key]['id']; ?>" target="_self">&Auml;ndern</a></td>
                    </tr>
                    <tr>
                        <td colspan="3">Datenschutz: <?php echo $administraction_accounts->humanize_optin_state($administraction_accounts->customer_data[$key]['dataprotection']); ?></td>
                        <td colspan="2">Double Opt-in: <?php echo $administraction_accounts->humanize_optin_state($administraction_accounts->customer_data[$key]['double_opt_in']); ?></td>
                        <td colspan="5">Benutzerkonto: <?php echo $administraction_accounts->humanize_active_state($administraction_accounts->customer_data[$key]['active']); ?></td>
                    </tr>
                    <?php
                }
            }
            ?>
        </tbody>
    </table>
<?php } else { ?>
    <tr>
        <td colspan="3">Leider konnten keine Benutzerkonten ermittelt werden!</td>
    </tr>
<?php } ?>