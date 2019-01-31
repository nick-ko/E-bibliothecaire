<?php
require_once 'core/init.php';

if (!is_logged_in()) {
      header('location: login.php');
    }
    if (!has_permission()) {
      permission_error_redirect('books.php');
    }

    $bookquery=$pdo->query("SELECT * FROM ouvrages");
    $nbbooks=mysqli_num_rows($bookquery);

    $classquery=$pdo->query("SELECT * FROM classes");
    $nbclasse=mysqli_num_rows($classquery);

    $salequery=$pdo->query("SELECT * FROM transactions");
    $nbsale=mysqli_num_rows($salequery);

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
    <!-- Icomoon Icon Fonts-->
    <link rel="stylesheet" href="css/icomoon.css">
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
                <h4 class="header-line">DASHBOARD</h4>
            </div>

        </div>

             <div class="row">

                 <div class="col-md-3 col-sm-3 col-xs-6">
                      <div class="alert alert-info back-widget-set text-center">
                            <i class="fa fa-history fa-5x"></i>
                            <h3><?= $nbsale; ?>&nbsp; Ventes</h3>

                        </div>
                    </div>
              <div class="col-md-3 col-sm-3 col-xs-6">
                      <div class="alert alert-success back-widget-set text-center">
                            <i class="fa fa-bars fa-5x"></i>
                            <h3><?= $nbbooks ?> Ouvrages</h3>
                        </div>
                    </div>
               <div class="col-md-3 col-sm-3 col-xs-6">
                      <div class="alert alert-warning back-widget-set text-center">
                            <i class="fa fa-recycle fa-5x"></i>
                            <h3>56+ Calls</h3>
                        </div>
                    </div>
               <div class="col-md-3 col-sm-3 col-xs-6">
                      <div class="alert alert-danger back-widget-set text-center">
                            <i class="fa fa-briefcase fa-5x"></i>
                            <h3><?= $nbclasse; ?> Classes </h3>
                        </div>
                    </div>

        </div>
             <div class="row">
                <div class="">
                  <!-- Area Chart Example-->
  <div class="panel panel-default">
    <div class="panel-heading">
      <i class="fa fa-area-chart"></i> Statistiques
    </div>
    <div class="panel-body">
      <canvas id="myAreaChart" width="100%" height="30"></canvas>
    </div>
    <div class="panel-footer"><?= date('d / m / Y  H:i'); ?></div>
  </div>
               </div>
              <div class="col-md-8 col-sm-8 col-xs-12">
                    <div id="carousel-example" class="carousel slide slide-bdr" data-ride="carousel" >

                    <div class="carousel-inner">
                        <div class="item active">

                            <img src="assets/img/1.jpg" alt="" />

                        </div>
                        <div class="item">
                            <img src="assets/img/news_2.jpg" alt="" />

                        </div>
                        <div class="item">
                            <img src="assets/img/3.jpg" alt="" />
                        </div>


                    </div>
                    <!--INDICATORS-->
                     <ol class="carousel-indicators">
                        <li data-target="#carousel-example" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example" data-slide-to="1"></li>
                        <li data-target="#carousel-example" data-slide-to="2"></li>
                    </ol>
                    <!--PREVIUS-NEXT BUTTONS-->
                     <a class="left carousel-control" href="#carousel-example" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
  </a>
  <a class="right carousel-control" href="#carousel-example" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
  </a>
                </div>
              </div>

                 <div class="col-md-4 col-sm-4 col-xs-12">
                 <div class="panel panel-primary ">
                        <div class="panel-heading">
                            Livres les plus achétés
                        </div>
                        <div class="panel-body chat-widget-main">
                            <div class="chat-widget-left">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                           Lorem ipsum dolor.
                            </div>
                            <div class="chat-widget-name-left">
                                <img class="media-object img-circle img-left-chat" src="assets/img/user2.png" />
                                <h4>  Amanna Seiar</h4>
                                <h5>Time 2:00 pm at 25th july</h5>
                            </div>
                            <hr />
                            <div class="chat-widget-right">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                           Lorem ipsum dolor sit amet.
                            </div>
                            <div class="chat-widget-name-right">
                                 <img class="media-object img-circle img-right-chat" src="assets/img/user2.png" />
                                <h4>  Amanna Seiar</h4>
                                <h5>Time 2:00 pm at 25th july</h5>
                            </div>
                            <hr />
                            <div class="chat-widget-left">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                           Lorem ipsum dolor sit amet.
                            </div>
                            <div class="chat-widget-name-left">
                                 <img class="media-object img-circle img-left-chat" src="assets/img/user2.png" />
                                <h4>  Amanna Seiar</h4>
                                <h5>Time 2:00 pm at 25th july</h5>
                            </div>
                            <hr />
                            <div class="chat-widget-right">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                           Lorem ipsum dolor sit amet.
                            </div>
                            <div class="chat-widget-name-right">
                               <img class="media-object img-circle img-right-chat" src="assets/img/user2.png" />
                                <h4>  Amanna Seiar</h4>
                                <h5>Time 2:00 pm at 25th july</h5>
                            </div>
                            <hr />
                        </div>

                    </div>
             </div>

                 </div>


             <div class="row">

                  <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="panel panel-success">
                        <div class="panel-heading">
                           Etudiants ayant effectué un achat récemment
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Ref</th>
                                            <th>Noms & Prénom</th>
                                            <th>Classe</th>
                                            <th>Contact</th>
                                             <th>Total achat.</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php while($data=mysqli_fetch_assoc($salequery)):
                                        $studentclass=$data['classe'];
                                        $pclass="SELECT * FROM classes WHERE id='$studentclass'";
                                        $class=$pdo->query($pclass);
                                        $res=mysqli_fetch_assoc($class);?>
                                        <tr>
                                            <td><?= $data['id']; ?></td>
                                            <td><?= $data['full_name']; ?></td>
                                            <td><?= $res['classe']; ?></td>
                                            <td><?= $data['contact']; ?></td>
                                            <td><?= money($data['total_achat']); ?></td>
                                        </tr>
                                      <?php  endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
             </div>
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
    <!-- Page level plugin JavaScript-->
   <script src="assets/js/chart.js/Chart.min.js"></script>
   <!-- Charts for this page-->
   <script src="assets/js/sb-admin-charts.min.js"></script>

</body>
</html>
