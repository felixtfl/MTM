<?php require_once('../Connections/conn.php');?>
<?php
session_start();
//get next prodNo
if(isset($_POST['delete'])){
  $arr =$_POST['prodNo'];
  $num=count($arr);
  if($num>0){
  	$SQL="DELETE FROM product  Where ";
  	foreach($arr as $index => $value){
  	$c =" prodNo='$value'";
  	echo "<h2>Will execute : $SQL $c</h2>";
  	@mysqli_query($conn,$SQL.$c)or die(mysql_error());
  	}
  echo "<h2>$num data deleted.</h2>";
  }
  else
  echo "<h2>No record to delete </h2>";
}
if($_SESSION["id"]=="customer"){
header("Location:../index.html");
}
if(!$_SESSION["id"]=="supplier"){
header("Location:/dashboard/");
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
          <span class="mdl-layout-title">Product Maintain</span>
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
          <a class="mdl-navigation__link" href="index.php"><i class="mdl-color-text--blue-grey-400 material-icons">home</i>Home</a>
          <a class="mdl-navigation__link" href="productmaintain.php"><i class="mdl-color-text--blue-grey-400 material-icons">report</i>Product maintain</a>
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
            <form enctype="multipart/form-data" method="post">
            <table class="mdl-data-table mdl-js-data-table  mdl-shadow--2dp">
              <!-- mdl-data-table- -selectable -->
    <thead>
      <tr><th><?php echo '<input type="checkbox" />' ?></th>
        <th class="mdl-data-table__cell--non-numeric">Product Name</th>
        <th>Product Price(HK$)</th>
        <th>Product Photo</th>
        <th>Stock Quantity</th>
        <th>Category No</th>
        <th>Supplier No</th>
        <th>Update Product</th>
      </tr>
    </thead>
    <tbody><?php
    $suppNo=$_SESSION["uid"];
    $query=mysqli_query($conn,"SELECT * FROM product WHERE suppNo='$suppNo'");
      while($rs=mysqli_fetch_assoc($query)) {
        if (count($rs) == 0) break;
    ?>
      <tr >
        <td><?php echo '<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" >'; ?>
        <?php printf ('<input class="mdl-checkbox__input" type="checkbox" name="prodNo[]" value="%s"/> </label>',$rs['prodNo']); ?>
      </td>
        <td class="mdl-data-table__cell--non-numeric"><?php echo $rs['prodName']; ?></td>
        <td><?php echo $rs['prodPrice']; ?></td>
        <td><?php printf ('<a href="../images/product/%s" >pic</a>',$rs['ProdPhoto']); ?></td>
        <td><?php echo $rs['stockQty']; ?></td>
        <td><?php echo $rs['catNo']; ?></td>
        <td><?php echo $rs['suppNo']; ?></td>
        <td><?php printf('<a value="update" href="editproduct.php?prodNo=%s">Update Product</a> ', $rs['prodNo']); ?></td>
      </tr>
      <?php }?>
    </tbody>
  </table>
  <button  name="delete" type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
Delete
</button>
</form>
        </div>
        </div>
      </main>
<script src="../../material.min.js"></script>
  </body>
</html>
<?php exit;//onclick="check()" ?>
