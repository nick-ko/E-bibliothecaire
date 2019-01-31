<?php
require_once 'core/init.php';

if (!is_logged_in()) {
	login_error_redirect();
}

if (!has_permission('admin')) {
    permission_error_redirect('index.php');
}

$req="SELECT * FROM users";
	$reket=$pdo->query($req);

  //ajout d'un nouveau utilisateur

  if (isset($_POST['ajouter'])) {

      $dbpath='';
      $errors = array();

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


      $name=sanitize($_POST['name']);
      $email=sanitize($_POST['email']);
      $password=sanitize($_POST['password']);
      $confirm=sanitize($_POST['confirm']);
      $permissions=sanitize($_POST['permissions']);


      $emailQuery = $pdo->query("SELECT * FROM users WHERE email='$email'");
      $emailCount =mysqli_num_rows($emailQuery);
      if ($emailCount != 0) {
          $errors[] = 'Cet email exist déja,Veuillez entrer un autre SVP';
      }
      $required = array('name', 'email', 'password', 'confirm', 'permissions');
      foreach ($required as $fvalue) {
          if(empty($_POST[$fvalue])) {
              $errors[] = 'Vous devez renseigner tous les champs SVP';
              break;
          }
      }
      if (strlen($password) < 8) {
          $errors[] = 'Votre mot de passe doit avoir au mois 8 caractere';
      }
      if ($password != $confirm) {
          $errors[] = 'Mot de passe incorrect.';
      }
      if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
          $errors[] = 'Votre email est invalide,Veuillez entrer un autre';
      }
      if (!empty($errors)) {

          $helper=display_errors($errors);

      }else{

          $hashed = password_hash($password,PASSWORD_DEFAULT);
          $insertSql="INSERT INTO users(nom,email,password,permissions,photo)
                      VALUES('$name','$email','$hashed','$permissions','$dbpath')";

          $pdo->query($insertSql);
          $_SESSION['success_flash'] = 'Nouveau utilisateur enregistrer avec succes.';
          header('Location: users.php');
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
                <h4 class="header-line"><?= (isset($_GET['list']))?"LISTE DES ":" "; ?>UTILISATEURS</h4>
            </div>
       </div>
       <div class="row">
            <div class="col-md-1"></div>
            <?php if(isset($_GET['list'])){ ?>
              <div class="col-md-12">
                  <!-- Advanced Tables -->
                  <div class="panel panel-default">
                      <div class="panel-heading">
                           Listes des utilisateurs
                      </div>
                      <div class="panel-body">
                          <div class="table-responsive">
                              <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                  <thead>
                                      <tr>
                                          <th>#</th>
                                          <th>Nom & Prenom</th>
                                          <th>Email</th>
                                          <th>Derniere Connexion</th>
                                          <th>Role</th>
                                          <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                       while($result=mysqli_fetch_assoc($reket)):
                                     ?>
                                      <tr class="odd gradeX">
                                          <td><?= $result['id']; ?></td>
                                          <td><?= $result['nom']; ?></td>
                                          <td><?= $result['email']; ?></td>
                                          <td><?= pretty_date($result['last_login']); ?></td>
                                          <td><?= $result['permissions']; ?></td>
                                          <td>
                                          <a href="books.php?edit=<?= $result['id'] ?>">
                                            <button class="btn btn-primary"><i class="fa fa-edit "></i> Editer</button>
                                          </a>
                                          <a href="users.php?delete=<?= $result['id'] ?>">
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
              <a href="users.php?list=1"class="btn btn-info pull-right"> <i class="fa fa-eye"> Voir les utilisateurs </i></a><br><br>
              <?= @$helper; ?>
               <div class="panel panel-info">
                        <div class="panel-heading">
                           ENREGISTRER UN ADMINISTRATEUR
                        </div>
                        <div class="panel-body">
                            <form role="form" method="post" action="" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Nom & Prenom</label>
                                            <input class="form-control" type="text" name="name" required/>
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input class="form-control" type="email" name="email" required min="0"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Mot de Passe</label>
                                            <input class="form-control" type="password" name="password" required min="0"/>
                                        </div>
                                         <div class="form-group">
                                            <label>Confirmer Mot de Passe</label>
                                            <input class="form-control" type="password" name="confirm" placeholder="" required/>
                                        </div>
																				<div class="form-group">
																					 <label>Photo</label>
																					 <input class="form-control" type="file" name="photo" placeholder="" required/>
																			 </div>
                                        <div class="form-group">
                                            <label>Role</label>
                                            <select class="form-control" name="permissions">
                                              <option value="">definissez votre role</option>
                                              <option value="admin">Administrateur</option>
                                              <option value="editor">Editeur</option>
                                            </select>
                                        </div>
                                        <br>

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
