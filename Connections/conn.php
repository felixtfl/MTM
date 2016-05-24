<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_conn = "localhost";
$database_conn = "projectdb";
$username_conn = "root";
$password_conn = "root";
$conn = mysqli_connect($hostname_conn, $username_conn, $password_conn,$database_conn );
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
