<?php
require_once '../core/init.php';

$id=$_POST['id'];
$id= (int)$id;
 $i=1;

$sql="SELECT * FROM transactions WHERE id = '$id'";
$result = $pdo->query($sql);
$transactions=mysqli_fetch_assoc($result);


$classe_id= $transactions['classe'];
$sql="SELECT classe FROM classes WHERE id='$classe_id'";
$classe_query=$pdo->query($sql);
$classes=mysqli_fetch_assoc($classe_query);

$cart_id=$transactions['cart_id'];
$sqlCart="SELECT * FROM cart WHERE id='$cart_id'";
$cart_query=$pdo->query($sqlCart);
$carts=mysqli_fetch_assoc($cart_query);
$items=json_decode($carts['items'],true);

 ?>

<?php ob_start(); ?>
	<div class="modal fade details-1" id="buys-modal" tabindex="-1" role="dialog" aria-labelledby="details-1" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
			<div class="modal-header">
				<div class="product_name">
				   <h4 class="modal-title text-center">Détails de l'Achat</h4>
				</div>
				<button type="button" class="close" onclick="closeModal()" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
				</button>

			</div>
			<div class="modal-body">
				<div class="container-fluid">
          <span id="modal_errors" ></span>
					<div class="row">

				  <div class="col-sm-6" style="font-size:16px;">
            <h4><u>Informations sur l'etudiant</u></h4>
            <div class="form-group" >
                <label>Nom & Prenom de L'etudiant: </label>
                <?= $transactions['full_name']; ?>
            </div>
            <div class="form-group">
                <label>Classe : </label>
                <?= $classes['classe']; ?>
            </div>
            <div class="form-group">
                <label>Adresse & Contact : </label>
                <?= $transactions['adresse']; ?> : <?= $transactions['contact']; ?>
            </div>
				  </div>
					<div class="col-sm-6">
            <div class="form-group">
                <h4><u>Ouvrage(s) Acheté(s) </u></h4>
                <table class="table table-hover">
                    <thead>
                        <tr>
                             <th>#</th>
                            <th>Nom de l'Ouvrage</th>
                            <th>Prix</th>
                            <th>Quantité</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php
                        foreach($items as $item) {

                             $book_id = $item['id'];
                             $bookQ = $pdo->query("SELECT * FROM ouvrages where id = '{$book_id}'");
                             $books = mysqli_fetch_assoc($bookQ);
                      ?>
                        <tr>
                             <td><?= $i; ?></td>
                            <td><?= $books['nom']; ?></td>
                            <td><?= money($books['prix']); ?></td>
                            <td><?= $item['quantity']; ?></td>
                        </tr>
                        <?php $i++; } ?>
                    </tbody>
                </table>

              <div class="form-group">
                  <label>Total Achat : </label>
                  <?= money($transactions['total_achat']); ?>
              </div>
            </div>

					</div>
				</div>
			</div>
		</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" onclick="closeModal()">Fermer</button>
			</div>
		</div>
	</div>
	</div>

	<script type="text/javascript">

	function closeModal() {

		jQuery('#buys-modal').modal('hide');
		setTimeout(function () {
			jQuery('#buys-modal').remove();
			jQuery('.modal-backdrop').remove();
		},500)
	}

	</script>

<?php echo ob_get_clean(); ?>
