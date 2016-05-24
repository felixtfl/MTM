<?php require_once('../Connections/conn.php');?>
<?php
session_start();
//get next prodNo
if(!$_SESSION["id"]="supplier"){
header("Location:.html");
}
$suppNo=$_SESSION["uid"];

$query=mysqli_query($conn,"SELECT * FROM supplier WHERE suppNo='$suppNo'");
$rs=mysqli_fetch_assoc($query);
if(isset($_POST["update"])){
  $suppName=$_POST["suppName"];
  $suppTel=$_POST["suppTel"];
  $suppAddr=$_POST["suppAddr"];
  $sql="UPDATE supplier SET suppName='$suppName',suppTel='$suppTel',suppAddr='$suppAddr' WHERE suppNo='$suppNo' ;";
  @mysqli_query($conn,$sql)or die (mysql_error());

  $query=mysqli_query($conn,"SELECT * FROM supplier WHERE suppNo='$suppNo'");
  $rs=mysqli_fetch_assoc($query);
}

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Material Design Lite</title>

    <!-- SEO: If your mobile URL is different from the desktop URL, add a canonical link to the desktop page https://developers.google.com/webmasters/smartphone-sites/feature-phones -->
    <!--
    <link rel="canonical" href="http://www.example.com/">
    -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="material.min.css">
    <link rel="stylesheet" href="styles.css">
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
    <div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
      <header class="demo-header mdl-layout__header mdl-color--white mdl-color--grey-100 mdl-color-text--grey-600">
        <div class="mdl-layout__header-row">
          <span class="mdl-layout-title">Update Supplier info</span>
          <div class="mdl-layout-spacer"></div>
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
            <label class="mdl-button mdl-js-button mdl-button--icon" for="search">
              <i class="material-icons">search</i>
            </label>
            <div class="mdl-textfield__expandable-holder">
              <input class="mdl-textfield__input" type="text" id="search" />
              <label class="mdl-textfield__label" for="search">Enter your query...</label>
            </div>
          </div>
          <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" id="hdrbtn">
            <i class="material-icons">more_vert</i>
          </button>
          <ul class="mdl-menu mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right" for="hdrbtn">
            <li class="mdl-menu__item">About</li>
            <li class="mdl-menu__item">Contact</li>
            <li class="mdl-menu__item">Legal information</li>
          </ul>
        </div>
      </header>
      <div class="demo-drawer mdl-layout__drawer mdl-color--blue-grey-900 mdl-color-text--blue-grey-50">
        <header class="demo-drawer-header">
          <img src="images/user.jpg" class="demo-avatar">
          <div class="demo-avatar-dropdown">
            <span><?php echo $_SESSION['id']?></span>
            <div class="mdl-layout-spacer"></div>
            <button id="accbtn" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
              <i class="material-icons">arrow_drop_down</i>
            </button>
            <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="accbtn">
              <button class="mdl-menu__item">hello@email.com</button>
              <button class="mdl-menu__item">info@domain.net</button>
              <button class="mdl-menu__item">Add another account...</button>
            </ul>
          </div>
        </header>
        <nav class="demo-navigation mdl-navigation mdl-color--blue-grey-800">
          <a class="mdl-navigation__link" href=""><i class="mdl-color-text--blue-grey-400 material-icons">home</i>Home</a>
          <?php if($_SESSION["id"]=="administrator"){
          echo '<a class="mdl-navigation__link" href="categorymaintain.php"><i class="mdl-color-text--blue-grey-400 material-icons">report</i>Category maintain</a>';
          }
          else if($_SESSION["id"]=="supplier"){
              echo '<a class="mdl-navigation__link" href="productmaintain.php"><i class="mdl-color-text--blue-grey-400 material-icons">report</i>Product maintain</a>';
              }
                  ?>
          <a class="mdl-navigation__link" href="updateinfo.php"><i class="mdl-color-text--blue-grey-400 material-icons">autorenew</i>Update info</a>
          <a class="mdl-navigation__link" href=""><i class="mdl-color-text--blue-grey-400 material-icons">shopping_cart</i>Purchases</a>
          <a class="mdl-navigation__link" href=""><i class="mdl-color-text--blue-grey-400 material-icons">people</i>User</a>
          <div class="mdl-layout-spacer"></div>
<a class="mdl-navigation__link" href="../logout.php"><i class="mdl-color-text--blue-grey-400 material-icons">exit_to_app</i>Logout</a>
        </nav>
      </div>


      <main class="mdl-layout__content mdl-color--grey-100">
        <div class="mdl-grid">
          <div class="mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
          <form id="Product" method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" >
            <div class="mdl-textfield mdl-js-textfield">
              <input class="mdl-textfield__input" type="text" id="suppTel" name="suppName" value="<?php echo $rs['suppName']; ?>" />
              <label class="mdl-textfield__label" for="suppName">Supplier Name</label>
            </div><br />
            <div class="mdl-textfield mdl-js-textfield">
              <input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" id="suppTel" name="suppTel" value="<?php echo $rs['suppTel']; ?>" />
              <label class="mdl-textfield__label" min="0" for="suppTel">Supplier Tel</label>
              <span class="mdl-textfield__error">Input is not a number!</span>
            </div><br />
            <div class="mdl-textfield mdl-js-textfield">
              <textarea class="mdl-textfield__input" type="text" rows= "3" name="suppAddr" id="suppAddr" ><?php echo $rs['suppAddr']; ?></textarea>
              <label class="mdl-textfield__label" for="suppAddr">Detail address</label>
            </div><br />
            <button  name="update" type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
          update
          </button>
        </form>
      </div>
    </div>
  </main>
  <script src="../../material.min.js"></script>
</body>
</html>
<?php exit;//onclick="check()" ?>
