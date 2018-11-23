<div class="container">
    <div class="row">
        <div class="header ac_card">
            <div class="topnav">
                <div class="twelve columns">
                    <a class="topnav-icons fa fa-home ac-left ac-bar-item ac-button <?php echo (SCRIPT_NAME === "index.php" ? 'active' : ''); ?>" href="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME; ?>"></a>
                    <a class="ac-bar-item ac-button <?php echo (SCRIPT_NAME === "artikeluebersicht.php" ? 'active' : ''); ?>" href="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME; ?>/artikeluebersicht">Artikel&uuml;bersicht</a>
                    <div class="ac-right">
                        <a class="ac-bar-item ac-button <?php echo (SCRIPT_NAME === "login.php" ? 'active' : ''); ?>" href="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME; ?>/login">Login</a>
                        <a class="ac-bar-item ac-button <?php echo (SCRIPT_NAME === "registrieren.php" ? 'active' : ''); ?>" href="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME; ?>/registrieren">Registrieren</a>
                        <a class="topnav-icons fa fa-search ac-bar-item ac-button" id="search_click" onclick="display_function('inline_search', this.id);"></a>
                        <a class="topnav-icons fa fa-shopping-cart ac-bar-item ac-button" id="cart_click" onclick="display_function('inline_search', this.id);"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>