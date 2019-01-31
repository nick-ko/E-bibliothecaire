<?php
require_once 'core/init.php';

if (!is_logged_in()) {
	login_error_redirect();
}

if ($cart_id != '') {
  	$cartQ = $pdo->query("SELECT * FROM cart WHERE id = '{$cart_id}'");
  	$result = mysqli_fetch_assoc($cartQ);
  	$items = json_decode($result['items'],true);
  	$i = 1;
  	$sub_total = 0;
  	$item_count = 0;
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
    <title>FREE RESPONSIVE HORIZONTAL ADMIN</title>
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
                <h4 class="header-line">Récapitulatif</h4>
            </div>

        </div>
             <div class="row">
                 <div class="col-md-12">
                   <?php if ($cart_id==''):?>
                     <div class="bg-danger">
                       <p class="text-center text-danger">Votre panier est vide</p>
                     </div>
                   <?php else: ?>
                     <table class="table table-bordered table-condensed table-striped">
                       <thead>
                         <th>#</th>
                         <th>Photo</th>
                         <th>Ouvrage</th>
                         <th>Prix</th>
                         <th>Quantité</th>
                         <th>Total</th>
                       </thead>
                       <tbody>
                         <?php
                           foreach($items as $item) {

                                $book_id = $item['id'];
                                $bookQ = $pdo->query("SELECT * FROM ouvrages where id = '{$book_id}'");
                                $books = mysqli_fetch_assoc($bookQ);
                         ?>
                         <tr>
                           <td><?=$i; ?></td>
                           <td><img src="<?= $books['photo'];  ?>" alt=""style="width:50px; height:50px;"></td>
                           <td><?= $books['nom'];  ?></td>
                           <td><?= money($books['prix']);  ?></td>
                           <td><?= $item['quantity']; ?></td>
                           <td><?= money($books['prix']*$item['quantity']); ?></td>
                         </tr>
                       <?php 	$i++;
						                 	$item_count += $item['quantity'];
							                $sub_total += ($books['prix'] * $item['quantity']);
                       } ?>
                       </tbody>
                     </table>
                     <table class="table table-bordered table-condensed table-striped">
                       <legend>Total</legend>
                       <thead class="totals-table-header">
                         <th>Nombre total d'ouvrage</th>
                         <th>Total General</th>
                       </thead>
                       <tbody>
                         <tr>
                           <td><?=$item_count; ?></td>
                           <td><?= money($sub_total); ?></td>
                         </tr>

                       </tbody>
                     </table>
                     <div class="pull-right">
                       <button type="button" class="btn btn-danger " >Annuler</button>
               				 <a  href="thankyou.php" class="btn btn-primary"><span ><i class="fas fa-cart-plus"></i>  </span>Confirmer </a>
                     </div>

                   <?php endif;  ?>
                 </div>
            </div>
    </div>
    <br><br>
    <?php
      include 'app/transactions.php';
     ?>
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
