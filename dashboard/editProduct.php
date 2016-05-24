<?php require_once('../Connections/conn.php');?>
<?php
session_start();
//get next prodNo
if(!$_SESSION["id"]="supplier"){
header("Location:../index.html");
}

$pNo=mysqli_query($conn,"SELECT IFNULL(MAX(prodNo),'P0000') FROM product") or die(mysql_error());
$pNoa=mysqli_fetch_array($pNo);
preg_match("/([a-zA-Z]+)(\d+)/",$pNoa[0],$rs);
$tt=(int)$rs[2]+1;
$tt=sprintf('%04d',$tt);
$prodNo=$rs[1].$tt;

if(isset($_POST["add"])) {
$prodName=$_POST["prodName"];
$prodPrice=$_POST["prodPrice"];
$uploaddir="../images/product/";
$uploadfile=$uploaddir . basename($_FILES['prodPhoto']['name']);
$temp = explode(".", $_FILES["prodPhoto"]["name"]);
$newfilename = $prodNo . '.' . end($temp);
    if (move_uploaded_file($_FILES["prodPhoto"]["tmp_name"], $uploaddir.$newfilename)) {
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
$prodPhoto=$newfilename;
$stockQty=$_POST["stockQty"];
$catNo=$_POST["catNo"];
$suppNo=$_POST["suppNo"];
@mysqli_query($conn,"INSERT INTO product VALUES('$prodNo','$prodName','$prodPrice','$prodPhoto','$stockQty','$catNo','$suppNo')") or die(mysql_error());
echo "done";
header("Location:productmaintain.php");
}

$prodNo=$_GET['prodNo'];
$query=mysqli_query($conn,"SELECT * FROM product WHERE prodNo='$prodNo';") or die(mysql_error());
$rs=mysqli_fetch_assoc($query);

if(isset($_POST['update'])){
  $prodName=$_POST["prodName"];
  $prodPrice=$_POST["prodPrice"];
  $uploadimg=$_POST["uploadimg"];
  if(isset($uploadimg)){
  $uploaddir="../images/product/";
  $uploadfile=$uploaddir . basename($_FILES['prodPhoto']['name']);
  $temp = explode(".", $_FILES["prodPhoto"]["name"]);
  $newfilename = $prodNo . '.' . end($temp);
      if (move_uploaded_file($_FILES["prodPhoto"]["tmp_name"], $uploaddir.$newfilename)) {
      } else {
          echo "Sorry, there was an error uploading your file.";
      }
  $prodPhoto=$newfilename;
  $stockQty=$_POST["stockQty"];
  $catNo=$_POST["catNo"];
  $suppNo=$_POST["suppNo"];
  $sqll="UPDATE product SET prodNo='$prodNo',prodName='$prodName',prodPrice='$prodPrice',prodPhoto='$prodPhoto',stockQty='$stockQty',catNo=$catNo,suppNo='$suppNo' WHERE prodNo='$prodNo';";
  @mysqli_query($conn,$sqll)or die(mysql_error());
  header("Location:productmaintain.php");
}else {
  $stockQty=$_POST["stockQty"];
  $catNo=$_POST["catNo"];
  $suppNo=$_POST["suppNo"];
  $sqll="UPDATE product SET prodNo='$prodNo',prodName='$prodName',prodPrice='$prodPrice',stockQty='$stockQty',catNo=$catNo,suppNo='$suppNo' WHERE prodNo='$prodNo';";
  @mysqli_query($conn,$sqll)or die(mysql_error());
  header("Location:productmaintain.php");
}


}
if($_SESSION["id"]=="customer"){
header("Location:../index.html");
}
?>
<!doctype html>
<!--
  Material Design Lite
  Copyright 2015 Google Inc. All rights reserved.

  Licensed under the Apache License, Version 2.0 (the "License");
  you may not use this file except in compliance with the License.
  You may obtain a copy of the License at

      https://www.apache.org/licenses/LICENSE-2.0

  Unless required by applicable law or agreed to in writing, software
  distributed under the License is distributed on an "AS IS" BASIS,
  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
  See the License for the specific language governing permissions and
  limitations under the License
-->

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
          <span class="mdl-layout-title">Add/Update Product</span>
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
              echo '          <a class="mdl-navigation__link" href="updateinfo.php"><i class="mdl-color-text--blue-grey-400 material-icons">autorenew</i>Update info</a>';
              }
                  ?>
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
              <input class="mdl-textfield__input" type="text" id="prodName" name="prodName" value="<?php echo $rs['prodName']; ?>" />
              <label class="mdl-textfield__label" for="prodName">Product Name</label>
            </div>
            <div class="mdl-textfield mdl-js-textfield textfield-demo">
              <input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" id="prodPrice" name="prodPrice" value="<?php echo $rs['prodPrice']; ?>" />
              <label class="mdl-textfield__label" min="0" for="prodPrice">Product Price</label>
              <span class="mdl-textfield__error">Input is not a number!</span>
            </div>
            <br />
          <div class="mdl-textfield mdl-js-textfield ">
            <input class="mdl-textfield__input" min="1" type="text" pattern="-?[0-9]*(\.[0-9]+)?" id="stockQty" name="stockQty" value="<?php echo $rs['stockQty']; ?>" />
            <label class="mdl-textfield__label" for="stockQty">Stock Quantity</label>
            <span class="mdl-textfield__error">Input is not a number!</span>
          </div>
          <?php
          $query=mysqli_query($conn,"SELECT * FROM category")or die(mysql_error());
          $suppNo=$_SESSION["uid"];
          $sup=mysqli_query($conn,"SELECT * FROM supplier WHERE suppNo='$suppNo'")or die(mysql_error());
          ?>
          <label>Category :
            <select id="catNo" name="catNo">
              <option value="NULL"></option>
            <?php
            while($rss=mysqli_fetch_assoc($query)){
              if(count($rss)==0)break;
              echo '<option ' . ($rs["catNo"]==$rss["catNo"] ? 'selected' : '') . ' value="'.$rss["catNo"].'">'.$rss["catName"].'</option>';
            //printf ('<option value="%s">%s</option>', $rss["catNo"], $rss["catName"]);
          }
          ?>
            </select>
          </label>
          <label>Supplier :
            <select id="suppNo" name="suppNo">
              <?php
              while($srss=mysqli_fetch_assoc($sup)){
                if(count($srss)==0)break;
                echo '<option ' . ($rs["suppNo"]==$srss["suppNo"] ? 'selected' : '') . ' value="'.$srss["suppNo"].'">'.$srss["suppName"].'</option>';
              //printf ('<option value="%s">%s</option>', $srss["suppNo"], $srss["suppName"]);
            }
              ?>
            </select>
          </label>
            <br />
          <label>Product Photo :</label>
          <input type="file" name="prodPhoto" id="prodPhoto" >

          <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="uploadimg">
            <input type="checkbox" id="uploadimg" name="uploadimg" class="mdl-checkbox__input" />
              <span class="mdl-checkbox__label">Update photo</span>
            </label>
          <button  name="add" type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
          add
          </button>
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
