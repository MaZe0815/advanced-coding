<?php require_once('config.php'); ?>
<!DOCTYPE html>
<html>
    <head>
        <?php include 'inc/inc-meta.php'; ?>
        <?php
        $set_meta_tags = new set_meta_tags();
        $set_meta_tags->seo_array['title'] = "Login - Placeholder - Shop";
        $set_meta_tags->seo_array['description'] = "Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.";
        $set_meta_tags->seo_array['keywords'] = "Lorem, ipsum, dolor, sit, amet, consectetuer, adipiscin, elit, Aenean commodo";
        $set_meta_tags->seo_array['index_allow'] = false;
        $set_meta_tags->set_meta_tags_index(true);
        ?>
    </head>
    <body>
        <?php include 'inc/inc-header.php'; ?>
        <div class="content">
            <div class="haeder_logo">
                <img src="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME; ?>/img/register-login.jpg" alt="Registrieren">
            </div>
            <div class="container">
                <div class="wrapper">
                    <h1>Einloggen</h1>
                    <div class="row">
                        <div class="col-12">
                            <p>Loggen Sie sich ein und erhalten Sie Zugang zu unserem Onlineshop.</p>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <?php
                            // Pr&uuml;fung Anmeldedaten auf Fehler
                            if (isset($_POST['gesendet']) && $_POST['gesendet'] == 1) {
                                $fehler = array();
                                if ($_POST['username'] == '' || filter_var($_POST['username'], FILTER_VALIDATE_EMAIL) === false) {
                                    $fehler['username'] = 'Bitte geben Sie Ihre E-Mail Adresse an.';
                                }
                                if ($_POST['password'] == '') {
                                    $fehler['password'] = 'Bitte geben Sie Ihr Passwort an.';
                                }
                                if ($_POST['username'] != '' && $_POST['password'] != '') {
                                    $fehler['kein_account'] = 'Bitte pr&uuml;fen Sie Ihre Anmeldedaten';
                                    $verbindung = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                                    mysqli_set_charset($verbindung, "utf8");

                                    $query = "SELECT id,userlevel,password_hash,vorname,nachname from acs_userlegitimation WHERE username='" . $_POST['username'] . "' AND (dataprotection = '1' AND double_opt_in = '1') AND active = '1'";
                                    $result = mysqli_query($verbindung, $query);
                                    while ($row = mysqli_fetch_array($result)) {
                                        if (password_verify($_POST['password'], $row['password_hash']) === TRUE) {
                                            $userid = $row['id'];
                                            $userlevel = $row['userlevel'];
                                            $username = $row['vorname'] . " " . $row['nachname'];
                                            unset($fehler['kein_account']);
                                        }
                                    }
                                }
                            }
                            // Begr&uuml;&szlig;ung des Users wenn Anmeldung ok
                            if (isset($userid) && count($fehler) == 0) {
                                echo("<div class='zeilenwrapper'>");
                                echo("<div>Hallo <strong>" . $username . "</strong> &ndash; Herzlich Willkommen in unserem Shop!</div>");
                                echo("<div style='margin-top: 35px; margin-bottom: 150px;'>Klicken Sie <a href='" . HTTP_HOST . ROOT_URL . PROJECT_NAME . "/artikeluebersicht'>hier</a>, um direkt zu unserer Artikel&uuml;bersicht zu gelangen!</div>");
                                echo("</div>");
                                $_SESSION['user'] = $userid;
                                $_SESSION['userlevel'] = $userlevel;
                            }
                            // Ausgabe Formular wenn keine Anmeldedaten oder Anmeldedaten ung&uuml;ltig
                            if (!isset($fehler) || count($fehler) > 0) {
                                echo("<form action='" . HTTP_HOST . ROOT_URL . PROJECT_NAME . "/login/' method='post'>");
                                echo("<input type='hidden' name='gesendet' value='1'>");
                                if (isset($fehler['kein_account'])) {
                                    echo("<div class='zeilenwrapper'>");
                                    echo("<div class='fehlerzelle'>" . $fehler['kein_account'] . "</div>");
                                    echo("</div>");
                                }
                                echo("<div class='zeilenwrapper'>");
                                echo("<div class='zellelinks'>");
                                echo("<label for='username'>E-Mailadresse</label>");
                                echo("</div>");
                                echo("<div class='zellerechts'>");
                                echo("<input placeholder='Benutzername*'");
                                if (isset($fehler['username'])) {
                                    echo(" class='eingabefeld fehler'");
                                } else {
                                    echo(" class='eingabefeld'");
                                }
                                echo(" type='text'");
                                if (isset($_POST['username'])) {
                                    echo("value='" . $_POST['username'] . "'");
                                }
                                echo(" name='username'>");
                                echo("</div>");
                                echo("</div>");
                                if (isset($fehler['username'])) {
                                    echo("<div class='zeilenwrapper'>");
                                    echo("<div class='fehlerzelle'>" . $fehler['username'] . "</div>");
                                    echo("</div>");
                                }
                                echo("<div class='zeilenwrapper'>");
                                echo("<div class='zellelinks'>");
                                echo("<label for='password'>Passwort</label>");
                                echo("</div>");
                                echo("<div class='zellerechts'>");
                                echo("<input placeholder='Passwort*'");
                                if (isset($fehler['password']) || isset($fehler['password_uebereinstimmung'])) {
                                    echo(" class='eingabefeld fehler'");
                                } else {
                                    echo(" class='eingabefeld'");
                                }
                                if (isset($_POST['password'])) {
                                    echo(" value='" . $_POST['password'] . "'");
                                }
                                echo(" name='password'");
                                echo(" type='password'>");
                                echo("</div>");
                                echo("</div>");
                                if (isset($fehler['password'])) {
                                    echo("<div class='zeilenwrapper'>");
                                    echo("<div class='fehlerzelle'>" . $fehler['password'] . "</div>");
                                    echo("</div>");
                                }
                                echo("<div class='zeilenwrapper'>");
                                echo("<div class='zellelinks platzhalter'>");
                                echo("&nbsp;");
                                echo("</div>");
                                echo("<div class='zellerechts'>");
                                echo("<input class='eingabefeld' type='submit' value='Jetzt einloggen!' style='margin-bottom: 150px;'>");
                                echo("</div>");
                                echo("</div>");
                                echo("</form>");
                            }
                            if (isset($verbindung)) {
                                mysqli_close($verbindung);
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'inc/inc-footer.php'; ?>
        <script src="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME; ?>/js/js_functions.js" type="text/javascript"></script>
        <?php include "inc/inc-debug-console.php";
        ?>
    </body>
</html>