<section class="menu-section">
    <div class="container">
        <div class="row ">
            <div class="col-md-12">
                <div class="navbar-collapse collapse ">
                    <ul id="menu-top" class="nav navbar-nav navbar-right">
                        <li><a href="index.php" class="menu-top-active">DASHBOARD</a></li>

                        <li><a href="sale.php?etape1">VENTES</a></li>
                        <li><a href="books.php">OUVRAGES</a></li>
                        <li><a href="classe.php">CLASSES</a></li>

                        <li>
                            <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown"><?= $user_data['nom']; ?> <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                                 <li role="presentation"><a role="menuitem" tabindex="-1" href="profile.php">PROFILE</a></li>
                                 <?php if($user_data['permissions']=='admin'): ?>
                                 <li role="presentation"><a role="menuitem" tabindex="-1" href="users.php">UTILISATEURS</a></li>
                               <?php else:
                               endif; ?>
                            </ul>
                        </li>


                    </ul>
                </div>
            </div>

        </div>
    </div>
</section>
