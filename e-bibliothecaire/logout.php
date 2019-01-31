<?php
   require_once $_SERVER['DOCUMENT_ROOT'].'/e-bibliothecaire/core/init.php';
   unset($_SESSION['bibliothecaire']);
   header('Location: login.php');
