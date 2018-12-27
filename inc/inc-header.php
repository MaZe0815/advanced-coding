<div class="container">
    <div class="wrapper">
        <div class="header ac_card">
            <div class="topnav" id="toggle_menu">
                <a class="topnav_logo ac-bar-item ac-button <?php echo (SCRIPT_NAME === "index.php" ? 'active' : ''); ?>" href="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME; ?>">
                    <img src="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME; ?>/img/placeholder-logo.png" alt="Placeholder Logo">
                </a>
                <a class="ac-bar-item ac-button <?php echo (SCRIPT_NAME === "artikeluebersicht.php" ? 'active' : ''); ?>" href="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME; ?>/artikeluebersicht">Artikel&uuml;bersicht</a>
                <?php if (isset($_SESSION['user'])) { ?>
                    <a class="ac-bar-item ac-button <?php echo (SCRIPT_NAME === "logout.php" ? 'active' : ''); ?>" href="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME; ?>/logout">Logout</a>
                <?php } else { ?>
                    <a class="ac-bar-item ac-button <?php echo (SCRIPT_NAME === "login.php" ? 'active' : ''); ?>" href="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME; ?>/login">Login</a>
                <?php } ?>
                <?php if (!isset($_SESSION['user'])) { ?>
                    <a class="ac-bar-item ac-button <?php echo (SCRIPT_NAME === "registrieren.php" ? 'active' : ''); ?>" href="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME; ?>/registrieren">Registrieren</a>
                <?php } ?>
                <?php if (isset($_SESSION['order'])) { ?>
                    <a class="ac-bar-item ac-button fa fa-shopping-cart <?php echo (SCRIPT_NAME === "warenkorb.php" ? 'active' : ''); ?>" href="<?php echo HTTP_HOST . ROOT_URL . PROJECT_NAME; ?>/warenkorb"></a>
                <?php } ?>
                <input type="text" placeholder="Ihr Suchbegriff..." id="input_inline_search" onkeyup="asyn_search(csrfObject.baseURL + '/ajax/async_search/', 'inline_search', this.value);">
                <a class="icon" onclick="toggle_menu();">
                    <i class="fa fa-bars"></i>
                </a>
            </div>
        </div>
    </div>
</div>
<?php include 'inc/inc-inline-search.php'; ?>
