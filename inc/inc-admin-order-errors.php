<?php if (isset($_GET['s']) && strlen($_GET['s'])) { ?>
    <div class="success" id="notification">
        Die Stammdaten dieser Bestellung wurden erfolgreich aktualisiert!<br>
        <a href="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME . '/administration-bestellungen' ?>" target="_self">Zur&uuml;ck</a> zur Hauptseite.
    </div>
<?php } elseif (is_array($administration_orders->order_data_error) && count($administration_orders->order_data_error) > 0) { ?>
    <div class="error" id="notification">
        Leider ist ein Fehler aufgetreten, bitte pr&uuml;fen Sie nochmals Ihre Eingaben auf Vollst&auml;ndigkeit!
        <a href="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME . '/administration-bestellungen' ?>" target="_self">Zur&uuml;ck</a> zur Hauptseite.
    </div>
<?php } ?>