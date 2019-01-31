<?php
require_once 'core/init.php';

if (!is_logged_in()) {
	login_error_redirect();
}

$req="SELECT * FROM classes";
	$reket=$pdo->query($req);

  //delete classe
  if (isset($_GET['delete'] ) && !empty($_GET['delete'])) {
    $delete_id=(int)$_GET['delete'];


    $dsql="DELETE FROM classes WHERE id='$delete_id'";
    $pdo->query($dsql);
    header('location:?list=1');
  }

if (isset($_POST['valider'])){

$error=array();

     $classe=$_POST['classe'];
     $cycle=$_POST['cycle'];
     $sql = "INSERT INTO classes (classe, cycle)
    VALUES ('$classe', '$cycle')";
     //use exec() because no results are returned
		 $message="nouvelle classe  ajouté avec success,merci !";
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
                <h4 class="header-line"><?= (isset($_GET['list']))?"LISTE DES ":" "; ?>CLASSES</h4>
            </div>
        </div>

             <div class="row">
               <?php if(isset($_GET['list'])){ ?>
                 <div class="col-md-12">
                     <!-- Advanced Tables -->
										 <div class="flash">

										 </div>
                     <div class="panel panel-default">
                         <div class="panel-heading">
                              Liste des classes
                         </div>

                         <div class="panel-body">
                             <div class="table-responsive">
                                 <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                     <thead>
                                         <tr>
                                             <th>#</th>
                                             <th>Classe</th>
                                             <th>Cycle</th>
                                             <th>Action</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                       <?php
                                          while($res=mysqli_fetch_assoc($reket)){
                                        ?>
                                         <tr class="gradeA">
                                             <td><?= $res['id']; ?></td>
                                             <td><?= $res['classe']; ?></td>
                                             <td><?= $res['cycle']; ?></td>
                                             <td class="center">
                                               <a href="classe.php?edit=<?= $res['id'] ?>">
                                                 <button class="btn btn-primary"><i class="fa fa-edit "></i> Editer</button>
                                               </a>
                                               <a href="classe.php?delete=<?= $res['id'] ?>">
                                                 <button class="btn btn-danger"><i class="fa fa-pencil"></i> Supprimer</button>
                                              </a>
                                             </td>
                                         </tr>
                                     <?php }  ?>
                                     </tbody>
                                 </table>
                             </div>

                         </div>
                     </div>
                     <br><br><br><br><br><br><br>
                   <?php }else{ ?>
               <div class="col-md-1"></div>
            <div class="col-md-10 col-sm-10 col-xs-12">
              <a href="classe.php?list=1"class="btn btn-info pull-right"><i class="fa fa-eye"> Voir les classes</i></a><br><br>
               <div class="panel panel-info">
                        <div class="panel-heading">
                           ENREGISTRER UNE CLASSE
                        </div>
                        <div class="panel-body">
                            <form role="form" method="post" action="classe.php">
                                        <div class="form-group">
                                            <label>Classe</label>
                                            <input class="form-control" type="text" name="classe" required placeholder="Entrez le libelle de la classe"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Cycle</label>
                                            <input class="form-control" type="text" name="cycle" required placeholder=""/>
                                        </div>

                                        <button type="submit" class="btn btn-info" name="valider">Ajouter </button>
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
