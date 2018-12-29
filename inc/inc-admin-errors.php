<?php if (isset($_GET['s']) && strlen($_GET['s'])) { ?>
    <div class="success" id="notification">
        Die Stammdaten des Artikels wurden erfolgreich aktualisiert bzw. angelegt!
    </div>
<?php } elseif (is_array($administration->product_data_error) && count($administration->product_data_error) > 0) { ?>
    <div class="error" id="notification">
        Leider ist ein Fehler aufgetreten, bitte pr&uuml;fen Sie nochmals Ihre Eingaben auf Vollst&auml;ndigkeit!
    </div>
<?php } ?>