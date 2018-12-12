<?php require_once('config.php'); ?>
<!DOCTYPE html>
<html>
    <head>
        <?php include 'inc/inc-meta.php'; ?>
        <?php
        $set_meta_tags = new set_meta_tags();
        $set_meta_tags->seo_array['title'] = "Login - Shop";
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
                            // Prüfung Anmeldedaten auf Fehler
                            if (isset($_POST['gesendet']) && $_POST['gesendet'] == 1) {
                                $fehler = array();
                                if ($_POST['username'] == '') {
                                    $fehler['username'] = 'Bitte geben Sie Ihren Benutzernamen an';
                                }
                                if ($_POST['password'] == '') {
                                    $fehler['password'] = 'Bitte geben Sie Ihr Passwort an';
                                }
                                if ($_POST['username'] != '' && $_POST['password'] != '') {
                                    $fehler['kein_account'] = 'Bitte prüfen Sie Ihre Anmeldedaten';
                                    $verbindung = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

                                    $query = "SELECT id,password_hash from acs_userlegitimation
									WHERE username='" . $_POST['username'] . "'";
                                    $result = mysqli_query($verbindung, $query);
                                    while ($row = mysqli_fetch_array($result)) {
                                        if (password_verify($_POST['password'], $row['password_hash']) === TRUE) {
                                            $userid = $row['id'];
                                            unset($fehler['kein_account']);
                                        }
                                    }
                                }
                            }
                            // Begrüßung des Users wenn Anmeldung ok
                            if (isset($userid) && count($fehler) == 0) {
                                echo("<div class='zeilenwrapper'>");
                                echo("<div>Hallo User " . $userid . " – Herzlich Willkommen in unserem Shop</div>");
                                echo("</div>");
                                $_SESSION['id'] = session_id();
                                $_SESSION['user'] = $userid;
                            }
                            // Ausgabe Formular wenn keine Anmeldedaten oder Anmeldedaten ungültig
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
                                echo("<label for='username'>Benutzername bzw. E-Mailadresse</label>");
                                echo("</div>");
                                echo("<div class='zellerechts'>");
                                echo("<input class='eingabefeld' placeholder='Benutzername'");
                                if (isset($fehler['username'])) {
                                    echo(" fehler");
                                }
                                echo("'type='text'");
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
                                echo("<input class='eingabefeld'placeholder='Passwort'");
                                if (isset($fehler['password']) || isset($fehler['password_uebereinstimmung'])) {
                                    echo("fehler");
                                }
                                echo("'type='password'");
                                if (isset($_POST['password'])) {
                                    echo("value='" . $_POST['password'] . "'");
                                }
                                echo(" name='password'>");
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
                                echo("<input class='eingabefeld' type='submit' value='Jetzt einloggen!'>");
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