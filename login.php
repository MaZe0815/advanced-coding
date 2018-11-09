<?php require_once('config.php'); ?>
<!DOCTYPE html>
<html>
    <head>
        <?php include 'inc/inc-meta.php'; ?>
        <?php
        $set_meta_tags = new set_meta_tags();
        $set_meta_tags->seo_array['title'] = "Warenkorb - Shop";
        $set_meta_tags->seo_array['description'] = "Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.";
        $set_meta_tags->seo_array['keywords'] = "Lorem, ipsum, dolor, sit, amet, consectetuer, adipiscin, elit, Aenean commodo";
        $set_meta_tags->seo_array['index_allow'] = false;
        $set_meta_tags->set_meta_tags_index(true);
        ?>
    </head>
    <body>
        <div class="container">
            <?php include 'inc/inc-header.php'; ?>
            <div class="content">
                <div class="haeder_logo">
                    <img src="https://via.placeholder.com/1920x450" alt="Startseite">
                </div>
                <?php include 'inc/inc-menu.php'; ?>
                <h1>Warenkorb</h1>
                <p>
                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At
                    <br><a class="button" href="#">Button</a>
                </p>
            </div>
            <?php include 'inc/inc-footer.php'; ?>
        </div>
        <script src="js/js_functions.js" type="text/javascript"></script>
        <?php include "inc/inc-debug-console.php"; ?>
    </body>
</html>