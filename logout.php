<?php require_once('Connections/conn.php');?>
<?php
session_start();
if(isset($_SESSION['id'])){
  $username=$_COOKIE["loginName"];
  $updatasql="UPDATE user SET isLoggedIn='N' WHERE loginName='$username';";
  unset($_COOKIE['loginName']);
  @mysqli_query($conn,$updatasql);
  session_unset();
  session_destroy();
  header("Location:index.html");
}else{
  echo "<h3>You need to login first</h3>";
}
?>
<!doctype HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Logout Page</title>
<link rel="stylesheet" href="./material.min.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="styles.css">
<script src="./material.min.js"></script>
<!-- favicon -->
<link rel="apple-touch-icon" sizes="57x57" href="images/favicon/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="images/favicon/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="images/favicon/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="images/favicon/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="images/favicon/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="images/favicon/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="images/favicon/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="images/favicon/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="images/favicon/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="images/favicon/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="images/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="images/favicon/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="images/favicon/favicon-16x16.png">
<link rel="manifest" href="images/favicon/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="images/favicon/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
<style>
#view-source {
  position: fixed;
  display: block;
  right: 0;
  bottom: 0;
  margin-right: 40px;
  margin-bottom: 40px;
  z-index: 900;
}
</style>
</head>
<body>
  <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">

    <div class="android-header mdl-layout__header mdl-layout__header--waterfall">
      <div class="mdl-layout__header-row">
        <span class="android-title mdl-layout-title">
          <a href="index.html"><img class="android-logo-image" src="images/Logo.png"></a>
        </span>
        <!-- Add spacer, to align navigation to the right in desktop -->
        <div class="android-header-spacer mdl-layout-spacer"></div>
        <div class="android-search-box mdl-textfield mdl-js-textfield mdl-textfield--expandable mdl-textfield--floating-label mdl-textfield--align-right mdl-textfield--full-width">
          <label class="mdl-button mdl-js-button mdl-button--icon" for="search-field">
            <i class="material-icons">search</i>
          </label>
          <div class="mdl-textfield__expandable-holder">
            <input class="mdl-textfield__input" type="text" id="search-field" />
          </div>
        </div>

        <!-- Navigation -->
        <div class="android-navigation-container">
          <nav class="android-navigation mdl-navigation">
            <a class="mdl-navigation__link mdl-typography--text-uppercase" href="">All</a>
            <a class="mdl-navigation__link mdl-typography--text-uppercase" href="">Phones</a>
            <a class="mdl-navigation__link mdl-typography--text-uppercase" href="">Tablets</a>
            <a class="mdl-navigation__link mdl-typography--text-uppercase" href="">Wear</a>
            <a class="mdl-navigation__link mdl-typography--text-uppercase" href="">About</a>

          </nav>
        </div>

        <button class="android-cart-button mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect" id="cart-button">
          <a href=""><i class="material-icons">shopping_cart</i></a>
        </button>

        <button class="android-more-button mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect" id="more-button">
          <i class="material-icons">more_vert</i>
        </button>
        <ul class="mdl-menu mdl-js-menu mdl-menu--bottom-right mdl-js-ripple-effect" for="more-button">
          <li class="mdl-menu__item"><a href="login.php">Login</a></li>
          <li disabled class="mdl-menu__item">Logout</li>
        </ul>
        <span class="android-mobile-title mdl-layout-title">
          <img class="android-logo-image" src="images/Logo.png">
        </span>
      </div>
    </div>

    <div class="android-drawer mdl-layout__drawer">
      <span class="mdl-layout-title">
        <img class="android-logo-image" src="images/Logo-white.png">
      </span>
      <nav class="mdl-navigation">
        <a class="mdl-navigation__link" href="">All</a>
        <a class="mdl-navigation__link" href="">Phones</a>
        <a class="mdl-navigation__link" href="">Tablets</a>
        <a class="mdl-navigation__link" href="">Wear</a>
        <a class="mdl-navigation__link" href="">About</a>
        <div class="android-drawer-separator"></div>
        <span class="mdl-navigation__link" href="">Hi <?php echo $_SESSION["userName"]; ?></span>
        <a class="mdl-navigation__link" href="">Login</a>
        <!--<php if(!isset($_SESSION["userName"])){
          echo "<a class="mdl-navigation__link" href="login.php">Login</a>";
        }else {
          echo "<a class="mdl-navigation__link" href="logout.php">Logout</a>"
        }
         ?> -->
        <a class="mdl-navigation__link" href="">KitKat 4.4</a>
        <a class="mdl-navigation__link" href="">Jelly Bean 4.3</a>
        <a class="mdl-navigation__link" href="">Android history</a>
        <div class="android-drawer-separator"></div>
        <span class="mdl-navigation__link" href="">Resources</span>
        <a class="mdl-navigation__link" href="">Official blog</a>
        <a class="mdl-navigation__link" href="">Android on Google+</a>
        <a class="mdl-navigation__link" href="">Android on Twitter</a>
        <div class="android-drawer-separator"></div>
        <span class="mdl-navigation__link" href="">For Supplier</span>
        <a class="mdl-navigation__link" href="">Add Product</a>
        <a class="mdl-navigation__link" href="">Android Open Source Project</a>
        <a class="mdl-navigation__link" href="">Android SDK</a>
      </nav>
    </div>

    <div class="android-content mdl-layout__content">
      <a name="top"></a>
  </div>

  <div class="mdl-grid" id="login">
<div id="c" class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet mdl-cell--4-col-phone mdl-card mdl-shadow--3dp">


  <div class="mdl-spinner mdl-js-spinner is-active"></div>


</div>
</div>

      <footer class="android-footer mdl-mega-footer">
        <div class="mdl-mega-footer--top-section">
          <div class="mdl-mega-footer--left-section">
            <button class="mdl-mega-footer--social-btn"></button>
            &nbsp;
            <button class="mdl-mega-footer--social-btn"></button>
            &nbsp;
            <button class="mdl-mega-footer--social-btn"></button>
          </div>
          <div class="mdl-mega-footer--right-section">
            <a class="mdl-typography--font-light" href="#top">
              Back to Top
              <i class="material-icons">expand_less</i>
            </a>
          </div>
        </div>

        <div class="mdl-mega-footer--middle-section">
          <p class="mdl-typography--font-light">Satellite imagery: © 2014 Astrium, DigitalGlobe</p>
          <p class="mdl-typography--font-light">Some features and devices may not be available in all areas</p>
        </div>

        <div class="mdl-mega-footer--bottom-section">
          <a class="android-link android-link-menu mdl-typography--font-light" id="version-dropdown">
            Versions
            <i class="material-icons">arrow_drop_up</i>
          </a>
          <ul class="mdl-menu mdl-js-menu mdl-menu--top-left mdl-js-ripple-effect" for="version-dropdown">
            <li class="mdl-menu__item">5.0 Lollipop</li>
            <li class="mdl-menu__item">4.4 KitKat</li>
            <li class="mdl-menu__item">4.3 Jelly Bean</li>
            <li class="mdl-menu__item">Android History</li>
          </ul>
          <a class="android-link android-link-menu mdl-typography--font-light" id="developers-dropdown">
            For Developers
            <i class="material-icons">arrow_drop_up</i>
          </a>
          <ul class="mdl-menu mdl-js-menu mdl-menu--top-left mdl-js-ripple-effect" for="developers-dropdown">
            <li class="mdl-menu__item">App developer resources</li>
            <li class="mdl-menu__item">Android Open Source Project</li>
            <li class="mdl-menu__item">Android SDK</li>
            <li class="mdl-menu__item">Android for Work</li>
          </ul>
          <a class="android-link mdl-typography--font-light" href="">Blog</a>
          <a class="android-link mdl-typography--font-light" href="">Privacy Policy</a>
        </div>

      </footer>
    </div>
  </div>
</body>
</html>
<?php
exit;
?>
