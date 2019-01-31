<?php
require_once '../core/init.php';


$id=$_POST['id'];
$id= (int)$id;

$sql="SELECT * FROM ouvrages WHERE id = '$id'";
$result = $pdo->query($sql);
$ouvrages=mysqli_fetch_assoc($result);


$classe_id= $ouvrages['classe'];
$sql="SELECT classe FROM classes WHERE id='$classe_id'";
$classe_query=$pdo->query($sql);
$classes=mysqli_fetch_assoc($classe_query);

 ?>

<?php ob_start(); ?>
	<div class="modal fade details-1" id="details-modal" tabindex="-1" role="dialog" aria-labelledby="details-1" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
			<div class="modal-header">
				<div class="product_name">
				   <h4 class="modal-title text-center"><?= $ouvrages['nom']; ?></h4>
				</div>
				<button type="button" class="close" onclick="closeModal()" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
				</button>

			</div>
			<div class="modal-body">
				<div class="container-fluid">
          <span id="modal_errors" ></span>
					<div class="row">

				  <div class="col-sm-6">
				  	<img src="<?= $ouvrages['photo']; ?>" style="width:150px;"alt="<?php echo $ouvrages['nom']; ?>" style="width: 99%;
            margin: 15px auto;"  >
				  </div>
					<div class="col-sm-6">

						<h4>Description</h4>
						<p><?php //echo $products['description']; ?></p>
						<hr>
						<div class="product_price">PRIX: <?php echo $ouvrages['prix']; ?>FCFA <br>
						CLASSE: <?php echo $classes['classe']; ?></div>

                         <br>
						<form class="" action="add_cart.php" method="post" id="add_product_form">
               <input type="hidden" name="book_id" value="<?= $id; ?>" >
               <input type="hidden" name="available" id="available" value="">
							 <div class="form-group">
							 	 <div class="col-xs-6">
									 <label for="quantity">QUANTITE:</label>
									 <input type="number" min="0" name="quantity" class="form-control" id="quantity">
							 	 </div>
								 <div class="form-group">

								 </div>
							 </div>
						</form>

					</div>
				</div>
			</div>
		</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" onclick="closeModal()">Fermer</button>
				<button  class="btn btn-primary" onclick="add_to_cart(); return false;"><span ><i class="fas fa-cart-plus"></i>  </span>Ajouter au panier </button>

			</div>
		</div>
	</div>
	</div>

	<script type="text/javascript">

	function closeModal() {

		jQuery('#details-modal').modal('hide');
		setTimeout(function () {
			jQuery('#details-modal').remove();
			jQuery('.modal-backdrop').remove();
		},500)
	}

	</script>

<?php echo ob_get_clean(); ?>
