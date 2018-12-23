<?php if (isset($_GET['s']) && strlen($_GET['s']) && $_GET['s'] === "ACK") { ?>
    <div class="row">
        <div class="col-12">
            <p style="font-weight: 600;">Wir haben Ihre Bestellung erhalten<p>
            <p>
                Vielen Dank f&uuml;r Ihre Bestellung in unserem Online-shop. Wir haben Ihre Bestellung erhalten und diese ist bereits in Bearbeitung.<br>
                Ihre Bestellnummer entnehmen Sie bitte der E-Mail, welche wir soeben an Sie versandt haben. Bitte geben Sie diese in der Kommunikation immer als Referenz zu Ihrer Bestellung an.<br><br>
                Ihre Bestellung wird an die Versandadresse versendet, die Sie in Ihrem Benutzerkonto angegeben und hinterlegt haben.<br><br>
                Sie k&ouml;nnen Ihre Bestellung jederzeit in Ihrem Benutzerkonto einsehen, falls Sie R&uuml;ckfragen haben, stehen wir Ihnen unter einer der folgenden <a href="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME . '/impressum/'; ?>">Kontaktm&ouml;glichkeiten</a> jederzeit nat&uuml;rlich gerne zur Verf&uuml;gung!<br><br>
                Hilfreiche Antworten zu vielen häufigen Fragen finden Sie jedoch auch direkt in unseren <a href="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME . '/agb/'; ?>">AGBs</a>
            </p>
        </div>
    </div>
<?php } else { ?>
    <div class="row">
        <div class="col-12">
            <p style="font-weight: 600;">Es ist ein Fehler aufgetreten<p>
            <p>
                Leider ist bei der Transaktion Ihrer Zahlung eine Fehler unterlaufen. Bitte versuchen Sie es erneut, wir bitten dies zu entschuligen!<br>
                <a href="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME . '/warenkorb/?c=true'; ?>" class="button" style="margin-top: 35px; margin-bottom: 35px;">Zur&uuml;ck zum Warenkorb</a><br>
                Falls Sie R&uuml;ckfragen haben, stehen wir Ihnen unter einer der folgenden <a href="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME . '/impressum/'; ?>">Kontaktm&ouml;glichkeiten</a> jederzeit nat&uuml;rlich gerne zur Verf&uuml;gung!
            </p>
        </div>
    </div>
<?php } ?>
