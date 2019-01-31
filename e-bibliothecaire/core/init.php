<?php
$pdo= mysqli_connect('127.0.0.1','root','','e-biblio');

if (mysqli_connect_errno()) {

  echo 'database connection failled with following errors: '.mysqli_connect_errors();
  die();

}

session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/e-bibliothecaire/config.php';

$cart_id='';
if (isset($_COOKIE[BIBLIO_COOKIE])) {
  $cart_id=sanitize($_COOKIE[BIBLIO_COOKIE]);
}

if (isset($_SESSION['bibliothecaire'])) {
   $user_id=$_SESSION['bibliothecaire'];
   $query=$pdo->query("SELECT * FROM users WHERE id='$user_id'");
   $user_data=mysqli_fetch_assoc($query);


}
