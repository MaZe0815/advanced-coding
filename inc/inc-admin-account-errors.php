<?php if (isset($_GET['s']) && strlen($_GET['s'])) { ?>
    <div class="success" id="notification">
        Das Benutzerkontos wurden erfolgreich aktualisiert!<br>
        <a href="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME . '/administration-konten' ?>" target="_self">Zur&uuml;ck</a> zu den Benutzerkonten.
    </div>
<?php } elseif (is_array($administraction_accounts->customer_data_error) && count($administraction_accounts->customer_data_error) > 0) { ?>
    <div class="error" id="notification">
        Leider ist ein Fehler aufgetreten, bitte pr&uuml;fen Sie nochmals Ihre Eingaben auf Vollst&auml;ndigkeit!<br>
        <a href="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME . '/administration-konten' ?>" target="_self">Zur&uuml;ck</a> zu den Benutzerkonten.
    </div>
<?php } ?>