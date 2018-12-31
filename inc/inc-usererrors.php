<?php if (isset($_GET['s']) && strlen($_GET['s'])) { ?>
    <div class="success" id="notification">
        Ihre Stammdaten wurden erfolgreich aktualisiert. Beachten Sie dass <strong style="font-weight: 600;">Ihre Bestellung</strong> ab sofort an die von Ihnen <strong style="font-weight: 600;">neu angegebene Versandadresse</strong> Ihres Kundenkontos <strong style="font-weight: 600;">versendet</strong> werden!<br>
        <a href="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME . '/kundenkonto' ?>" target="_self">Zur&uuml;ck</a> zum Kundenkonto.
    </div>
<?php } elseif (is_array($customer_account->customer_data_error) && count($customer_account->customer_data_error) > 0) { ?>
    <div class="error" id="notification">
        Leider ist ein Fehler aufgetreten, bitte pr&uuml;fen Sie nochmals Ihre Eingaben auf Vollst&auml;ndigkeit!<br>
        <a href="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME . '/kundenkonto' ?>" target="_self">Zur&uuml;ck</a> zum Kundenkonto.
    </div>
<?php } ?>