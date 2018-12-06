<div class="container">
    <div class="wrapper">
        <div class="header ac_card">
            <div class="topnav">
                <div class="row">
                    <div class="col-6">
                        <a class="topnav_logo ac-bar-item ac-button <?php echo (SCRIPT_NAME === "index.php" ? 'active' : ''); ?>" href="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME; ?>">
                            <img src="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME; ?>/img/placeholder-logo.png" alt="Placeholder Logo">
                        </a>
                        <a class="ac-bar-item ac-button <?php echo (SCRIPT_NAME === "artikeluebersicht.php" ? 'active' : ''); ?>" href="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME; ?>/artikeluebersicht">Artikel&uuml;bersicht</a>
                    </div>
                    <div class="col-6">
                        <div class="ac-right">
                            <a class="ac-bar-item ac-button <?php echo (SCRIPT_NAME === "login.php" ? 'active' : ''); ?>" href="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME; ?>/login">Login</a>
                            <a class="ac-bar-item ac-button <?php echo (SCRIPT_NAME === "registrieren.php" ? 'active' : ''); ?>" href="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME; ?>/registrieren">Registrieren</a>
                            <input type="text" placeholder="Hier Ihr Suchbegriff..." onkeyup="asyn_search(csrfObject.baseURL + '/ajax/async_search/', 'inline_search', this.value);">
                            <a class="topnav-icons fa fa-shopping-cart ac-bar-item ac-button" id="cart_click" onclick="display_function('inline_search', this.id);"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="wrapper">
        <div class="row">
            <div class="col-12">
                <div class="inline_search" id="inline_search"></div>
            </div>
        </div>

    </div>
</div>
