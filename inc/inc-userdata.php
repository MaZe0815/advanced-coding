<form action="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME; ?>/kundenkonto/#notification" method="post">
    <input type="hidden" name="set_customer_data" value="1">
    <div class="zeilenwrapper">
        <div class="zellelinks">
            <label for="anrede">Anrede</label>
        </div>
        <div class="zellerechts">
            <select class="eingabefeld <?php if (array_key_exists('anrede', $customer_account->customer_data_error)) { ?>fehler<?php } ?>" name="anrede">
                <option value="" disabled="disabled">Bitte w&auml;hlen</option>
                <option value="w"<?php if ($customer_account->customer_data['anrede'] === "w") { ?> selected="selected"<?php } ?>>Frau</option>
                <option value="m"<?php if ($customer_account->customer_data['anrede'] === "m") { ?> selected="selected"<?php } ?>>Herr</option>
            </select>
        </div>
    </div>
    <div class="zeilenwrapper">
        <div class="zellelinks">
            <label for="vorname">Vorname</label>
        </div>
        <div class="zellerechts">
            <input type="text" placeholder="Ihr Vorname*" class="eingabefeld <?php if (array_key_exists('vorname', $customer_account->customer_data_error)) { ?>fehler<?php } ?>" name="vorname" value="<?php echo $customer_account->customer_data['vorname']; ?>">
        </div>
    </div>
    <div class="zeilenwrapper">
        <div class="zellelinks">
            <label for="nachname">Nachname</label>
        </div>
        <div class="zellerechts">
            <input type="text" placeholder="Ihr Nachname*" class="eingabefeld <?php if (array_key_exists('nachname', $customer_account->customer_data_error)) { ?>fehler<?php } ?>" name="nachname" value="<?php echo $customer_account->customer_data['nachname']; ?>">
        </div>
    </div>
    <div class="zeilenwrapper">
        <div class="zellelinks">
            <label for="strasse">Stra&szlig;e und Hausnr.</label>
        </div>
        <div class="zellerechts">
            <input type="text" placeholder="Ihre Stra&szlig;e und Hausnr.*" class="eingabefeld <?php if (array_key_exists('strasse', $customer_account->customer_data_error)) { ?>fehler<?php } ?>" name="strasse" value="<?php echo $customer_account->customer_data['strasse']; ?>">
        </div>
    </div>
    <div class="zeilenwrapper">
        <div class="zellelinks">
            <label for="plz">PLZ</label>
        </div>
        <div class="zellerechts">
            <input type="text" placeholder="Ihre Postleitzahl*" class="eingabefeld <?php if (array_key_exists('plz', $customer_account->customer_data_error)) { ?>fehler<?php } ?>" name="plz" value="<?php echo $customer_account->customer_data['plz']; ?>">
        </div>
    </div>
    <div class="zeilenwrapper">
        <div class="zellelinks">
            <label for="stadt">Stadt</label>
        </div>
        <div class="zellerechts">
            <input type="text" placeholder="Ihre Stadt*" class="eingabefeld <?php if (array_key_exists('stadt', $customer_account->customer_data_error)) { ?>fehler<?php } ?>" name="stadt" value="<?php echo $customer_account->customer_data['stadt']; ?>">
        </div>
    </div>
    <div class="zeilenwrapper">
        <div class="zellerechts">
            <input class="eingabefeld" type="submit" value="Jetzt aktualisieren!">
        </div>
    </div>
</form>