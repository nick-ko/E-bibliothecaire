<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/e-bibliothecaire/core/init.php';

$book_id=sanitize($_POST['book_id']);
$quantity=sanitize($_POST['quantity']);

$item=array();
$item[]=array(
   'id'=>$book_id,
   'quantity'=>$quantity
);

$domain=($_SERVER[HTTP_HOST] != 'localhost')?'.'.$_SERVER[HTTP_HOST]:false;
$query="SELECT * FROM ouvrages WHERE id='{$book_id}'";
$ouvrages=mysqli_fetch_assoc($query);
$_SESSION['success_flash']= $ouvrages['nom'].'a été ajouté a votre panier.';

//check if cart cookie existe

if ($cart_id != '') {

  $cartQ=$pdo->query("SELECT * FROM cart WHERE id='{$cart_id}'");
  $cart=mysqli_fetch_assoc($cartQ);
  $previous_items= json_decode($cart['items'],true);
  $item_match = 0;
  $new_items=array();

  foreach ($previous_items as $pitem) {
    if ($item[0]['id'] == $pitem['id']) {
      $pitem['quantity']=$pitem['quantity']+$item[0]['quantity'];
      $item_match=1;
    }
    $new_items[] = $pitem;
  }

  if ($item_match!=1) {
    $new_items=array_merge($item,$previous_items);
  }
  $items_json=json_encode($new_items);
  $cart_expire=date("Y-m-d H:i:s",strtotime("+1 days"));
  $pdo->query("UPDATE cart SET items='{$items_json}',expire_date='{$cart_expire}' WHERE id='{$cart_id}'");
  setcookie(BIBLIO_COOKIE,'',1,"/",$domain,false);
  setcookie(BIBLIO_COOKIE,$cart_id,BIBLIO_COOKIE_EXPIRE,'/',$domain,false);

}else {

  $items_json=json_encode($item);
  $cart_expire=date("Y-m-d H:i:s",strtotime("+1 days"));
  $pdo->query("INSERT INTO cart (items,expire_date) VALUES ('{$items_json}','{$cart_expire}')");
  $cart_id=$pdo->insert_id;
  setcookie(BIBLIO_COOKIE,$cart_id,BIBLIO_COOKIE_EXPIRE,'/',$domain,false);
}
