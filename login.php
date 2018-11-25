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
            <?php include 'inc/inc-menu.php'; ?>
            <div class="container">
                <div class="wrapper">
                    <h1>Einloggen</h1>
                    <form role="form" method="post" action="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME; ?>/login" autocomplete="off">
                        <div class="row">
                            <div class="col-12">
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.< Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.</p>
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <label for="username">Benutzername</label><br>
                                <input type="text" name="username" id="username" placeholder="Benutzername" value="<?php
                                if (isset($error)) {
                                    echo $_POST['username'];
                                }
                                ?>" tabindex="1">
                            </div>
                            <div class="col-4">
                                <label for="pass">Passwort</label><br>
                                <input type="password" name="pass" id="pass" placeholder="Passwort" tabindex="2">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <input type="submit" name="submit" value="Jetzt einloggen!" tabindex="3">
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