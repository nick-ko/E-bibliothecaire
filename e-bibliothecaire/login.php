<?php

require_once  $_SERVER['DOCUMENT_ROOT'].'/e-bibliothecaire/core/init.php';

$errors=array();

if (isset($_POST) && !empty($_POST)){

  $email=((isset($_POST['email']))?sanitize($_POST['email']):'');
  $email= trim($email);
  $password=((isset($_POST['password']))?sanitize($_POST['password']):'');
  $password= trim($password);
  $hashed=password_hash($password,PASSWORD_DEFAULT);

  // form validation
  if (empty($_POST['email']) || empty($_POST['password'])) {
    $errors[]='Veuillez entrer votre email et votre mot de passe svp!';
  }

  //Validate Email
  if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
    $errors[]='Entrez un email valide svp !';
  }

   //password is more than 8 caractere
   if (strlen($password) < 8) {
     $errors[]='Votre mot de passe doit avoir au moins 8 caractere';
   }

  //check if email exist in database
  $sqlUser=$pdo->query("SELECT * FROM users WHERE email='$email'");
  $user=mysqli_fetch_assoc($sqlUser);
  $userCount= mysqli_num_rows($sqlUser);
  if ($userCount < 1) {
    $errors[]='Cette adresse mail n\'existe pas,merci !';
  }

  if (!password_verify($password,$user['password'])) {
    $errors[]='Votre mot de passe est incorrect';
  }


  //check for errors
  if (!empty($errors)) {
    $error = display_errors($errors);
  }else {

    //log in users
    $user_id=$user['id'];
    login($user_id);
  }

}

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
    <title>BIBLIOTHEQUE 2.0</title>
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

    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">Connexion</h4>
            </div>
        </div>
             <div class="row">
               <?php echo @$error; ?>
               <div class="col-md-4"></div>
               <div class="col-md-4 col-sm-4 col-xs-12">
                              <div class="panel panel-danger" style="height:350px;">
                                       <div class="panel-heading">
                                          CONNEXION
                                       </div>

                                       <div class="panel-body">
                                           <form role="form" method="post" action="login.php">
                                                <div class="form-group">
                                                           <label> Email</label>
                                                           <input class="form-control" type="text" name="email"/>
                                                  </div>
                                                  <div class="form-group">
                                                           <label>Mot de Passe</label>
                                                           <input class="form-control" type="password" name="password"/>
                                                    </div>
                                                    <div class="form-group">
                                                             <p>
                                                               <input  type="checkbox" name="remenber" />
                                                               Se souvenir de moi.
                                                            </p>
                                                      </div>

                                                   <button type="submit" class="btn btn-danger">Connexion </button>
                                              </form>
                                           </div>
                                       </div>
                            </div>
                            <div class="col-md-4"></div>

        </div>
    </div>
 </div>
     <!-- CONTENT-WRAPPER SECTION END-->

      <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
    <!--BACKSTRETCH-->
  <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
  <script type="text/javascript" src="assets/js/jquery.backstretch.min.js"></script>
  <script>
      $.backstretch("assets/img/login-bg.jpg", {speed: 500});
  </script>
</body>
</html>
