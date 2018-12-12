<?php require_once('config.php'); ?>
<!DOCTYPE html>
<html>
    <head>
        <?php include 'inc/inc-meta.php'; ?>
        <?php
        $set_meta_tags = new set_meta_tags();
        $set_meta_tags->seo_array['title'] = "Logoout - Shop";
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
                    <h1>Ausloggen</h1>
                    <form role="form" method="post" action="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME; ?>/login" autocomplete="off">
                        <div class="row">
                            <div class="col-12">
                                <p>Sie haben sich erfolgreich ausgeloggt, um Ihre Daten zu schützen. Wir freuen uns auf Ihren nächsten Besuch.</p>
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php include 'inc/inc-footer.php'; ?>
        <script src="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME; ?>/js/js_functions.js" type="text/javascript"></script>
        <?php include "inc/inc-debug-console.php"; ?>
    </body>
</html>