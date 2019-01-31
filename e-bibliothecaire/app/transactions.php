<?php

   @$cart_id;
   @$sub_total;
   @$full_name=$_POST['name'];
   @$adresse=$_POST['adresse'];
   @$contact=$_POST['contact'];
   @$classestudent=$_POST['classestudent'];
   @$daterdv=$_POST['daterdv'];


  $sql = "INSERT INTO transactions (cart_id,full_name,contact,adresse,classe,total_achat,date_rdv)
  VALUES ('$cart_id','$full_name','$contact','$adresse',$classestudent,'$sub_total','$daterdv')";
 $pdo->query($sql);
