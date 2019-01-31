<?php
require_once 'core/init.php';

if (!is_logged_in()) {
	login_error_redirect();
}

$domain=($_SERVER['HTTP_HOST'] != 'localhost')? '.'.$_SERVER['HTTP_HOST']:false;
setcookie(BIBLIO_COOKIE,'',1,"/",$domain,false);


?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>E-BIBLIOTEHEQUE 2.0</title>
    <link rel="icon" type="image/png" href="assets/img/logo2.png"/>
    <!--===============================================================================================-->
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body>
    <?php include 'include/header.php'; ?>
    <!-- LOGO HEADER END-->
   <?php include 'include/menu.php'; ?>
     <!-- MENU SECTION END-->
    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">Confirmation</h4>
            </div>
        </div>
             <div class="row">
            <div class="col-md-12">
               <div class="alert alert-success text-center">
                   Merci,Votre achat a étè effectué avec succes
                   <br />
                   Nous vous envoyerons un mail avec les references de votre achat.
                   <br />

               </div>
            </div>

        </div>
    </div>
    </div>
     <!-- CONTENT-WRAPPER SECTION END-->
     <?php  include 'include/footer.php'; ?>
      <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
</body>
</html>
