<?php
require_once 'core/init.php';

if (!is_logged_in()) {
	login_error_redirect();
}

$req="SELECT * FROM ouvrages";
	$reket=$pdo->query($req);


if (isset($_POST['ajouter'])) {
$dbpath='';
$error=array();
$message='';

if (!empty($_FILES)) {

    $photo=$_FILES['photo'];
    $name=$photo['name'];
    $nameArray=explode('.',$name);
    $fileName=$nameArray[0];
    @$fileExt=$nameArray[1];
    $mime=explode('/',$photo['type']);
    $mimeType=$mime[0];
    @$mimeExt=$mime[1];
    $tmpLoc=$photo['tmp_name'];
    $fileSize=$photo['size'];

    $allowed=array('png','jpeg','jpg','gif');
    $uploadName=md5(microtime()).'.'.$fileExt;
    $uploadPath=BASEURL.' /assets/img/'.$uploadName;
    $dbpath='/e-bibliothecaire/assets/img/'.$uploadName;


    if ($mimeType != 'image') {
      $errors[].='le fichier doit etre une image.';
    }

    if (!in_array($fileExt, $allowed)) {
      $errors[].='vous devez importer une image.';
    }

  }
  if (!empty($_FILES)) {
      move_uploaded_file($tmpLoc,$uploadPath);
    }

     $classe=$_POST['classe'];
     $name=$_POST['name'];
     $prix=$_POST['prix'];
     $auteur=$_POST['auteur'];
     $exemplaire=$_POST['exemplaire'];
     $photo=$_POST['photo'];

     $sql = "INSERT INTO ouvrages (nom,prix,exemplaire,classe,auteur,photo)
    VALUES ('$name','$prix', '$exemplaire','$classe','$auteur','$dbpath')";
     //use exec() because no results are returned
		$message="Nouvelle ouvrage  ajouté avec success,merci !";
    $pdo->query($sql);
    header('location:?list=1');
		$flash=display_success($message);
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
                <h4 class="header-line"><?= (isset($_GET['list']))?"LISTE DES ":" "; ?>OUVRAGES</h4>
            </div>
       </div>
			 <div class="success">
				 <?= @$flash; ?>
			 </div>
       <div class="row">
            <div class="col-md-1"></div>
            <?php if(isset($_GET['list'])){ ?>
              <div class="col-md-12">
                  <!-- Advanced Tables -->
                  <div class="panel panel-default">
                      <div class="panel-heading">
                           Listes des ouvrages
                      </div>

                      <div class="panel-body">
                          <div class="table-responsive">
                              <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                  <thead>
                                      <tr>
                                          <th>#</th>
                                          <th>Nom</th>
                                          <th>Nbre d'exemplaire</th>
                                          <th>Prix</th>
                                          <th>Auteur</th>
                                          <th>Classe</th>
                                          <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                       while($result=mysqli_fetch_assoc($reket)):
                                          $bookclass=$result['classe'];
                                          $pclass="SELECT * FROM classes WHERE id='$bookclass' ";
                                          $class=$pdo->query($pclass);
                                          $res=mysqli_fetch_assoc($class);
                                     ?>
                                      <tr class="odd gradeX">
                                          <td><?= $result['id']; ?></td>
                                          <td><?= $result['nom']; ?></td>
                                          <td><?= $result['exemplaire']; ?></td>
                                          <td><?= $result['prix']; ?>  FCFA</td>
                                          <td><?= $result['auteur']; ?></td>
                                          <td><?= $res['classe']; ?></td>
                                          <td>
                                          <a href="books.php?edit=<?= $result['id'] ?>">
                                            <button class="btn btn-primary"><i class="fa fa-edit "></i> Editer</button>
                                          </a>
                                          <a href="books.php?delete=<?= $result['id'] ?>">
                                            <button class="btn btn-danger"><i class="fa fa-pencil"></i> Supprimer</button>
                                         </a>
                                       </td>
                                      </tr>
                                    <?php endwhile;  ?>
                                  </tbody>
                              </table>
                          </div>

                      </div>
                  </div>
                  <br><br><br><br><br>
                <?php }else{ ?>
            <div class="col-md-10 col-sm-10 col-xs-12">
              <a href="books.php?list=1"class="btn btn-info pull-right"> <i class="fa fa-eye"> Voir les ouvrages </i></a><br><br>
               <div class="panel panel-info">
                        <div class="panel-heading">
                           ENREGISTRER UN OUVRAGE
                        </div>
                        <div class="panel-body">
                            <form role="form" method="post" action="" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Nom de l'ouvrage</label>
                                            <input class="form-control" type="text" name="name" required/>
                                        </div>
                                        <div class="form-group">
                                            <label>Prix</label>
                                            <input class="form-control" type="number" name="prix" required min="0"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Nombre d'exemplaire</label>
                                            <input class="form-control" type="number" name="exemplaire" required min="0"/>
                                        </div>
                                         <div class="form-group">
                                            <label>Auteur (Conseil d'enseignement)</label>
                                            <input class="form-control" type="text" name="auteur" placeholder="selectionner le conseil d'enseignement"/>
                                        </div>

                                            <div class="form-group">
                                              <label>Classe</label>
                                              <select class="form-control" name="classe" placeholder="selectionner le conseil d'enseignement">
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
                                           <label>Photo de l'ouvrage</label>
                                           <input class="form-control" type="file" name="photo" placeholder=""/>
                                       </div><br>

                                        <button type="submit" class="btn btn-info" name="ajouter">Ajouter </button>
                                        <button type="reset" class="btn btn-danger">Annuler </button>
                                  </form>
                            </div>
                        </div>
                  </div>
        <?php } ?>
          </div>
        </div>
    </div>

     <!-- CONTENT-WRAPPER SECTION END-->
<?php include 'include/footer.php';  ?>
    </section>
    <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- DATATABLE SCRIPTS  -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
</body>
</html>
