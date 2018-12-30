<div class="row">
    <div class="col-5">
        <form action="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME; ?>/administration-konten/?aid=<?php echo $administraction_accounts->customer_id; ?>#notification" method="post">
            <input type="hidden" name="update_account_data" value="1">
            <label for="active">Benutzerkonto aktiv oder inaktiv schalten</label>
            <select class="eingabefeld <?php if (array_key_exists('active', $administraction_accounts->customer_data_error)) { ?>fehler<?php } ?>" name="active">
                <option value="1"<?php if ($administraction_accounts->customer_data['active'] === "1") { ?> selected="selected"<?php } ?>>Aktiv</option>
                <option value="0"<?php if ($administraction_accounts->customer_data['active'] === "0") { ?> selected="selected"<?php } ?>>Inaktiv</option>
            </select>
            <label for="userlevel">Rolle des Benutzerkontos wechselns</label>
            <select class="eingabefeld <?php if (array_key_exists('userlevel', $administraction_accounts->customer_data_error)) { ?>fehler<?php } ?>" name="userlevel">
                <option value="1"<?php if ($administraction_accounts->customer_data['userlevel'] === "1") { ?> selected="selected"<?php } ?>>Administrator</option>
                <option value="2"<?php if ($administraction_accounts->customer_data['userlevel'] === "2") { ?> selected="selected"<?php } ?>>Kunde</option>
            </select>
            <input class="eingabefeld" type="submit" value="Jetzt aktualisieren!">
        </form>
    </div>
</div>