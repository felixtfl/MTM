<?php require_once('Connections/conn.php');?>
<?php
session_start();
if(isset($_POST["tfU"])){
$username=$_POST["tfU"];
$password=$_POST["tfP"];

$sql="SELECT loginPswd,isLoggedIn,drvID,custNo,suppNo,adminNo FROM user WHERE loginName='$username';";
$lg=mysqli_query($conn,$sql) or die(mysql_error());
$spw=mysqli_fetch_array($lg);

$isLoggedIn=$spw[1];
$drvID=$spw[2];
$custNo=$spw[3];
$suppNo=$spw[4];
$adminNo=$spw[5];

if($password==$spw[0]){
  //echo "Login successfully";
  $updatasql="UPDATE user SET isLoggedIn='Y' WHERE loginName='$username';";
  @mysqli_query($conn,$updatasql);
  $_SESSION['userName']=$username;
  setcookie("loginName", $username, time()+604800);
  if(isset($drvID)){
    $_SESSION['uid']=$drvID;
    $_SESSION['id']="driver";
    if($isLoggedIn=="Y"){
      session_unset();
      echo "You alerady logined in other computer";
      header("Location:index.html");
    }
  }
  else if(isset($suppNo)){
    $_SESSION['uid']=$suppNo;
    $_SESSION['id']="supplier";
    if($isLoggedIn=="Y"){
      session_unset();
      echo "You alerady logined in other computer";
      header("Location:index.html");
    }
    header("Location:/dashboard");
  }
  else if(isset($adminNo)){
    $_SESSION['uid']=$adminNo;
    $_SESSION['id']="administrator";
    header("Location:/dashboard");
  }else if(isset($custNo)){
    $_SESSION['uid']=$custNo;
    $_SESSION['id']="customer";
    if($isLoggedIn=="Y"){
      $_SESSION['userName']="";
      echo "You alerady logined in other computer";
    }
    header("Location:index.html");
  }

}else{
  echo "Wrong User Name/Password !";
}
}
?>
<!doctype HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login Page</title>
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
<script type="text/javascript">
function checkF(){
  var uName = document.getElementById("tfU").value;
  var pd = document.getElementById("tfP").value;
  if(uName==""){
    alert("Input User Name please ");
}
  else if(pd==""){
    alert("Input password please ");
    document.getElementById("tfP").focus();
  }
  else{
    document.getElementById("fin").submit();
  }
}
</script>
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
        <span class="mdl-navigation__link" href="">Hi <?php echo $_SESSION["userName"] ?></span>
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
        <a class="mdl-navigation__link" href="addproduct.php">Add Product</a>
        <a class="mdl-navigation__link" href="">Android Open Source Project</a>
        <a class="mdl-navigation__link" href="">Android SDK</a>
      </nav>
    </div>

    <div class="android-content mdl-layout__content">
      <a name="top"></a>
  </div>

  <div class="mdl-grid" id="login">
<div id="c" class="mdl-cell mdl-cell--6-col mdl-cell--6-col-tablet mdl-cell--4-col-phone mdl-card mdl-shadow--3dp">
<form id="fin" method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label textfield-demo">
  <input class="mdl-textfield__input" type="text" id="tfU" name="tfU" />
  <label class="mdl-textfield__label" for="tfU">User Name</label>
</div><br />
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label textfield-demo">
  <input class="mdl-textfield__input" type="password" id="tfP" name="tfP" />
    <label class="mdl-textfield__label" for="tfP">Password</label>
    </div>
<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="cbRM">
  <input type="checkbox" id="cbRM" class="mdl-checkbox__input" />
  <span class="mdl-checkbox__label">Remember ME</span>
</label>
<!-- Raised button with ripple -->
<button onclick="checkF()" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
  Login
</button>
</form>

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
