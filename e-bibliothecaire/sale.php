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
    <link rel="icon" type="image/png" href="assets/img/logo2.png"/>
    <!--===============================================================================================-->
    <title>BIBLIOTHEQUE 2.0</title>
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
                <h4 class="header-line">Achat d'ouvrage</h4>
            </div>

        </div>

             <div class="row">
               <a href="buys.php"class="btn btn-info pull-right"><i class="fa fa-eye"> Voir les Ventes</i></a><br><br>

               <?php if(isset($_GET['etape2'])){
                @$bookclasses=$_POST['classe'];
                $query=$pdo->query("SELECT * FROM ouvrages WHERE classe='$bookclasses'");
                $nbbooks=mysqli_num_rows($query);
                unset($_POST['classe']);
                  ?>
                 <h3>ETAPE 2 : CHOIX DES OUVRAGES</h3>

                 <div class="progress progress-striped active">
                    <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                        <span class="sr-only">40% Complete (success)</span>
                    </div>
                 </div>
                 <div class="">
                   <span><?= $nbbooks; ?>  Ouvrage(s) trouvé(s).</span>
                 </div><br>
                 <?php
                 while($result=mysqli_fetch_assoc($query)):
                   $bookclass=$result['classe'];
                   $pclass="SELECT * FROM classes WHERE id='$bookclass' ";
                   $class=$pdo->query($pclass);
                   $res=mysqli_fetch_assoc($class);

                   ?>
                 <div class="col-md-4 col-sm-4">
                     <div class="panel panel-success">
                         <div class="panel-heading">
                            <?= $result['nom']; ?>
                         </div>
                         <div class="panel-body">
                           <div class="row">
                             <div class="col-md-6">
                                <img src="<?= $result['photo']; ?>" alt="" style="width:100px;">
                             </div>
                             <div class="col-md-6">
                               <p><strong>NOM :</strong><?= $result['nom']; ?> </p>
                               <p><strong>PRIX :</strong><?= $result['prix']; ?> FCFA</p>
                               <p><strong>AUTEUR :</strong><?= $result['auteur']; ?> </p>
                               <p><strong>CLASSE :</strong><?= $res['classe']; ?> </p>
                              </div>
                             </div>
                           </div>

                         <div class="panel-footer">
                               <a type="button" class="btn btn-primary btn-lg" onclick="detailsmodal(<?= $result['id']?>)">Selectionner</a>
                         </div>
                     </div>
                 </div>


               <?php endwhile; ?>
               <div class="row">
                 <div class="col-md-12">
                   <hr>
                   <br>
                    <a type="button" href="?etape1" class="btn btn-danger"> << Retour </a>
                   <a type="button" href=?etape3 class="btn btn-info">  Suivant >> </a>
                 </div>

               </div>

              <?php }elseif(isset($_GET['etape1'])){ ?>

               <h3>ETAPE 1 : CHOIX DE LA CLASSE DE L'ETUDIANT</h3>
               <div class="progress progress-striped active">
                  <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 30%">
                      <span class="sr-only">40% Complete (success)</span>
                  </div>
               </div>
               <form class="" action="?etape2" method="post" role="form">
                 <div class="form-group">
                     <label>Selectionner la classe de l'etudiant</label>

                       <select class="form-control" name="classe" required placeholder="selectionner le conseil d'enseignement">
                         <option value="">Selectionner la classe</option>
                         <?php
                          $reponse= $pdo->query("SELECT * FROM classes");
                          while ($donnees = mysqli_fetch_assoc($reponse)){
                         ?>
                         <option value="<?=  $donnees['id']; ?>">
                           <?=  $donnees['classe'].':'. $donnees['cycle'];?>
                         </option>
                         <?php } ?>
                       </select>

                 </div>
                 <hr>
                 <br>

                 <button type="submit" class="btn btn-info"><i class="fa fa-search">  Suivant </i></button>

               </form>
             <?php } elseif(isset($_GET['etape3'])){ ?>
             <h3>ETAPE 3 : INFORMATION DE L'ETUDIANT</h3>
             <div class="progress progress-striped active">
                <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                    <span class="sr-only">40% Complete (success)</span>
                </div>
             </div>
             <div class="panel panel-info">
                      <div class="panel-heading">
                         INFORMATION DE L'ETUDIANT
                      </div>
                      <div class="panel-body">
                          <form role="form" method="post" action="cart.php" enctype="multipart/form-data">
                                      <div class="form-group">
                                          <label>Nom & Prenom </label>
                                          <input class="form-control" type="text" name="name" required/>
                                      </div>
                                      <div class="form-group">
                                          <label>Adresse</label>
                                          <input class="form-control" type="text" name="adresse" required min="0"/>
                                      </div>
                                       <div class="form-group">
                                          <label>Contact</label>
                                          <input class="form-control" type="text" name="contact" required/>
                                      </div>
                                      <div class="form-group">
                                            <label>Classe</label>
                                            <select class="form-control" name="classestudent" required>
                                              <option value="">Selectionner la classe</option>
                                              <?php
                                               $reponse= $pdo->query("SELECT * FROM classes");
                                               while ($donnees = mysqli_fetch_assoc($reponse)){
                                              ?>
                                              <option value="<?=  $donnees['id']; ?>">
                                                <?=  $donnees['classe'].':'. $donnees['cycle'];?>
                                              </option>
                                              <?php } ?>
                                            </select>
                                      </div>
                                      <div class="form-group">
                                         <label>Date de recuperation de(s) ouvrage(s)</label>
                                         <input class="form-control" type="date" name="daterdv" required/>
                                     </div>


                                      <button type="submit" class="btn btn-info" name="valider">Valider </button>
                                      <button type="reset" class="btn btn-danger">Annuler </button>
                                </form>
                          </div>
                      </div>
           <?php } ?>

            </div>
    </div>
    </div>
     <!-- CONTENT-WRAPPER SECTION END-->
  <?php include 'include/footer.php';  ?>
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
