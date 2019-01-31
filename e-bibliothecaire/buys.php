<?php
require_once 'core/init.php';

if (!is_logged_in()) {
	login_error_redirect();
}

if (isset($_GET['statut'])) {

  $id= (int)$_GET['id'];
  $statut= (int)$_GET['statut'];
  $statutSql="UPDATE transactions SET statut = '$statut' WHERE id = '$id'";
  $pdo->query($statutSql);
  header('location:buys.php');

}

$req="SELECT * FROM transactions";
	$reket=$pdo->query($req);

  if (isset($_GET['delete'] )) {
    $delete_id=(int)$_GET['delete'];
    $dsql="DELETE FROM transactions WHERE id='$delete_id'";
    $pdo->query($dsql);
    header('location:buys.php');
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
    <title>LISTE DES VENTES</title>
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
                <h4 class="header-line">LISTES DES VENTES</h4>
            </div>
       </div>
       <div class="row">
            <div class="col-md-1"></div>

              <div class="col-md-12">
                  <!-- Advanced Tables -->
                  <div class="panel panel-default">
                      <div class="panel-heading">
                           Listes des ventes
                      </div>
                      <div class="panel-body">
                          <div class="table-responsive">
                              <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                  <thead>
                                      <tr>
                                          <th>N°</th>
                                          <th>Nom Etudiant</th>
                                          <th>Adresse</th>
                                          <th>Contact</th>
                                          <th>Classe</th>
                                          <th>Date Achat</th>
                                          <th>Date Livraison</th>
                                          <th>Total Achat</th>
                                          <th>Status</th>
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
                                          <td><?= $result['full_name']; ?></td>
                                          <td><?= $result['adresse']; ?></td>
                                          <td><?= $result['contact']; ?> </td>
                                          <td><?= $res['classe']; ?></td>
                                          <td><?= pretty_date($result['date_achat']); ?></td>
                                          <td><?= pretty_date($result['date_rdv']); ?></td>
                                          <td><?= money($result['total_achat']); ?></td>
                                          <td>
                                            <a href="buys.php?statut=<?=(($result['statut']==0)?'1':'0');?>&id=<?= $result['id'];?>" class="btn btn-xs btn-default">
                                              <span class="glyphicon glyphicon-<?= (($result['statut']==1)?'minus':'plus');?>"></span>&nbsp;
                                            </a>
                                            <?=(($result['statut']== 1)?'Livré':'pas livré');?></td>
                                          <td>
                                          <a onclick="buysmodal(<?= $result['id']?>)">
                                            <button class="btn btn-primary"><i class="fa fa-eye "></i> Détails</button>
                                          </a>
                                          <a href="buys.php?delete=<?= $result['id']; ?>">
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
