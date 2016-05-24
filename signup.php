<?php require_once('Connections/conn.php');?>
<?php
session_start();
//next userNo
$sql="SELECT IFNULL(MAX(userNo),'U0000') FROM user";
$nNo=mysqli_query($conn,$sql) or die(mysql_error());
$sNO=mysqli_fetch_array($nNo);
preg_match("/([a-zA-Z]+)(\d+)/",$sNO[0],$result);
$test=(int)$result[2]+1;
$test=sprintf('%04d',$test);
$userNo =$result[1].$test;

//next custNo
$sql2="SELECT IFNULL(MAX(custNo),'C0000') FROM customer";
$cNo=mysqli_query($conn,$sql2) or die(mysql_error());
$cNoa=mysqli_fetch_array($cNo);
preg_match("/([a-zA-Z]+)(\d+)/",$cNoa[0],$rs);
$tt=(int)$rs[2]+1;
$tt=sprintf('%04d',$tt);
$custNo=$rs[1].$tt;

//next distNo
$sql3="SELECT IFNULL(MAX(distNo),'DST00') FROM district";
$dNo=mysqli_query($conn,$sql3) or die(mysql_error());
$dNoa=mysqli_fetch_array($dNo);
preg_match("/([a-zA-Z]+)(\d+)/",$dNoa[0],$rsd);
$ttd=(int)$rsd[2]+1;
$ttd=sprintf('%02d',$ttd);
$distNo=$rsd[1].$ttd;


//$sql="INSERT INTO user VALUES ($fin,$username,$password,'Null',$custNo,'Null','NULL');"
$captcha=$_POST['g-recaptcha-response'];
$response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6Lf7yQkTAAAAAMwQcqgBx5HcALUdEO3oDcrhRYPs&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
if($response.success==false){
  echo '<h2>You are spammer ! Get the @$%K out</h2>';
}else{
  $custName=$_POST["custName"];
  $custGender=$_POST["custGender"];
  $custDOB=$_POST["custDOB"];
  $custTel=$_POST["custTel"];
  $custAddr=$_POST["custAddr"];
  $distName=$_POST["distName"];
  $loginName=$_POST["tfU"];
  $loginPswd=$_POST["tfP"];
  $isLoggedIn="N";
  //check loginName
  //echo "Hello";
  if(isset($_POST["custName"])){
$query = mysqli_query($conn,"SELECT loginName FROM user;") or die(mysql_error());
$count = mysqli_fetch_array($query);
for($i=0;$i<$count.length;$i++){
  if($loginName=$count[i]){
    $abc=ture;
  }else
    $abc=false;
}
echo $abc;
if ($abc) {
echo '<h2>Sorry! This Login Name already exists!</h2>';
} else {
  $sql="INSERT INTO district VALUES ('$distNo','$distName');";
  mysqli_query($conn,$sql)or die(mysql_error());
  $sql="INSERT INTO customer VALUES ('$custNo','$custName','$custGender','$custDOB','$custTel','$custAddr','$distNo');";
  mysqli_query($conn,$sql)or die(mysql_error());
  $sql="INSERT INTO user VALUES ('$userNo','$loginName','$loginPswd','$isLoggedIn',NULL,'$custNo',NULL,NULL);";
  mysqli_query($conn,$sql)or die(mysql_error());
  echo "Added !";
  header("Location:login.php");
}
}
}
?>
<!doctype HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Sign Up</title>
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
  var rpd = document.getElementById("tfRP").value;
  if(uName==""){
    alert("Input User Name please ");
  }
  else if(pd==""){
    alert("Input password please ");
  }else if(pd!=rpd){
    alert("password not the same ")
  }
  else{
    document.getElementById("register").submit();
  }
}
</script>
<script src='https://www.google.com/recaptcha/api.js'></script>
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
            <a class="mdl-navigation__link mdl-typography--text-uppercase" href="">Phones</a>
            <a class="mdl-navigation__link mdl-typography--text-uppercase" href="">Tablets</a>
            <a class="mdl-navigation__link mdl-typography--text-uppercase" href="">Wear</a>
            <a class="mdl-navigation__link mdl-typography--text-uppercase" href="">TV</a>
            <a class="mdl-navigation__link mdl-typography--text-uppercase" href="">Auto</a>
            <a class="mdl-navigation__link mdl-typography--text-uppercase" href="">One</a>
            <a class="mdl-navigation__link mdl-typography--text-uppercase" href="">Play</a>

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
        <a class="mdl-navigation__link" href="">Phones</a>
        <a class="mdl-navigation__link" href="">Tablets</a>
        <a class="mdl-navigation__link" href="">Wear</a>
        <a class="mdl-navigation__link" href="">TV</a>
        <a class="mdl-navigation__link" href="">Auto</a>
        <a class="mdl-navigation__link" href="">One</a>
        <a class="mdl-navigation__link" href="">Play</a>
        <div class="android-drawer-separator"></div>
        <span class="mdl-navigation__link" href="">Versions</span>
        <a class="mdl-navigation__link" href="">Lollipop 5.0</a>
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

  <div class="mdl-grid" id="signup">
<div id="c" class="mdl-cell mdl-cell--8-col mdl-cell--6-col-tablet mdl-cell--4-col-phone mdl-card mdl-shadow--3dp">
<form id="register" method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
  <input type="hidden" id="userNo" name="userNo" value="">
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label textfield-demo">
  <input class="mdl-textfield__input" type="text" id="custName" name="custName"/>
  <label class="mdl-textfield__label" for="custName">Full Name</label>
</div>
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label textfield-demo">
  <input class="mdl-textfield__input" type="text" id="tfU" name="tfU"/>
  <label class="mdl-textfield__label" for="tfU">Login Name</label>
</div><br />
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label textfield-demo">
  <input class="mdl-textfield__input" type="password" id="tfP" name="tfP" />
    <label class="mdl-textfield__label" for="tfP">Password</label>
  </div>
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label textfield-demo">
  <input class="mdl-textfield__input" type="password" id="tfRP" name="tfRP" />
    <label class="mdl-textfield__label" for="tfRP">Password again</label>
  </div><br />
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input class="mdl-textfield__input" type="date" id="custDOB" name="custDOB" />
    <label class="mdl-textfield__label" for="DOB">Birthday</label>
  </div>
  <label>Gender:
  <div class="mdl-radio">
    <input class="mdl-radio__button" type="radio" id="custGenderm" name="custGender" value="M" />
    <label class="mdl-radio__label" for="custGenderm">Male</label>
  </div>
  <div class="mdl-radio">
    <input class="mdl-radio__button" type="radio" id="custGender" name="custGender" value="F" />
    <label class="mdl-radio__label" for="custGender">Female</label>
  </div></label><br />
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" name="custTel" id="custTel" />
    <label class="mdl-textfield__label" for="custTel">Tel</label>
    <span class="mdl-textfield__error">Input is not a number!</span>
  </div><label>District:
  <select name="distName" id="distName">
  <option value="HK Island">HK Island</option>
  <option value="Kowloon">Kowloon</option>
  <option value="New Territories">New Territories</option>
</select> </label><br />
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <textarea class="mdl-textfield__input" type="text" rows= "3" name="custAddr" id="custAddr" ></textarea>
    <label class="mdl-textfield__label" for="custAddr">Detail address</label>
  </div>
  <div class="g-recaptcha" data-sitekey="6Lf7yQkTAAAAAI87vFDLFFYS1yV1m91iXjZ-7Yq5"></div>
<!-- Raised button with ripple -->
<button onclick="checkF()" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
  Sign UP
</button>
</form>
<p style="margin:10px">Already have an account?<a href="login.php"> Log In</a></p>
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
