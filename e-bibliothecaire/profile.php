<?php
require_once 'core/init.php';

if (!is_logged_in()) {
	login_error_redirect();
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
    <?php include 'include/header.php'; ?>
    <!-- LOGO HEADER END-->
  <?php include 'include/menu.php'; ?>
     <!-- MENU SECTION END-->
    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line"><?= (isset($_GET['edit']))?"Changer de mot de passe":" Profile" ?></h4>
            </div>

        </div>
             <div class="row">
               <?php if(isset($_GET['edit'])){ ?>
                 <div class="col-md-3"></div>
                 <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="panel panel-danger">
                                         <div class="panel-heading">
                                            CHANGER DE MOT DE PASSE
                                         </div>
                                         <div class="panel-body">
                                             <form role="form">

                                                  <div class="form-group">
                                                             <label>Mot de passe</label>
                                                             <input class="form-control" type="password" name="password"  />
                                                  </div>
                                                  <div class="form-group">
                                                             <label>Nouveau Mot de Passe</label>
                                                             <input class="form-control" type="password" />
                                                  </div>
                                                 <div class="form-group">
                                                             <label>Comfirmer Mot de Passe </label>
                                                             <input class="form-control"  type="password" />
                                                  </div>
                                                         <button type="reset" class="btn btn-danger">Annuler </button>
                                                         <button type="submit" class="btn btn-success">Valider </button>
                                                     </form>
                                             </div>
                                         </div>
                                    </div>
                                    <div class="col-md-4"></div>

              <?php }else{ ?>
                <div class="col-md-12">
                  <div class="col-md-12">
                      <a class="btn btn-primary pull-right" href="?edit=1"><i class="fa fa-edit "></i> Changer de Mot de Passe</a>
                      <br><br><br>
                  </div>
                  <div class="col-md-4 col-sm-4">
                      <div class="panel panel-default">
                          <div class="panel-heading">
                              Photo de profile
                          </div>
                          <div class="panel-body">
                              <img src="<?= $user_data['photo']; ?>" alt="">
                          </div>
                          <div class="panel-footer">
														<form class="" action="" method="post">
                            <div class="row">
                              <div class="col-md-8">
                                <div class="form-group">
                                    <input class="form-control" type="file" name="photo"/>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <button type="submit" class="btn btn-primary "><i class=" fa fa-refresh "></i> Modifier</button>
                              </div>
                            </div>
														</form>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-8 col-sm-8">
                      <div class="panel panel-default">
                          <div class="panel-heading">
                              informations
                          </div>
                          <div class="panel-body">
                            <form method="post" action="">
                            <div class="form-group">
                                <label>Nom & Prenom</label>
                                <input class="form-control" type="text" name="name" value="<?= $user_data['nom']; ?>"/>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" type="text" name="email" value="<?= $user_data['email']; ?>"/>
                            </div>
                            <div class="form-group">
                                <label>Role</label>
                                <input class="form-control" type="text" name="permission" value="<?= $user_data['permissions']; ?>"/>
                            </div>
                          </div>
                          <div class="panel-footer">
                              <button type="submit" class="btn btn-primary "><i class=" fa fa-refresh "></i> Modifier</button>
                          </div>
                        </form>
                      </div>
                  </div>
                  </div>
              <?php } ?>
              </div>
        </div>
    </div>
     <!-- CONTENT-WRAPPER SECTION END-->
<?php include 'include/footer.php'; ?>
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
