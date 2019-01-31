<?php

define('BASEURL',$_SERVER['DOCUMENT_ROOT'].'/e-bibliothecaire');
define('BIBLIO_COOKIE','BIblio2018NIckDeV');
define('BIBLIO_COOKIE_EXPIRE',time()+ (86400 *30));

function sanitize($dirty){

  return htmlentities($dirty,ENT_QUOTES,"UTF-8");
}

function money($number)
{
   return $number.' FCFA';
}

function login($user_id){

  $_SESSION['bibliothecaire']=$user_id;

  global $pdo;
  $date=date("Y-m-d H:i:s");
  $pdo->query("UPDATE users SET last_login='$date' WHERE id='$user_id'");
  $_SESSION['success_flash']="Vous etez connecter";
  header('location:index.php');
}

function display_errors($errors)
{

$display ='<div class="alert alert-danger" role="alert">';
  $display .= '<ul>';
   foreach ($errors as $error) {

     $display.='<li>'.$error.'</li>';
   }
   $display .='</ul>';
$display.='</div>';

   return $display;
}

function display_success($messages){

  $displays='<div class="alert alert-success alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
              $messages.
        $displays.='</div>';

        return $displays;
}

function is_logged_in()
{
  if (isset($_SESSION['bibliothecaire']) && $_SESSION['bibliothecaire'] > 0) {
    return true;
  }
  return false;
}

function login_error_redirect($url='login.php')
{
  $_SESSION['error_flash']='Vous devez vous connecter';
  header('location: '.$url);
}

function permission_error_redirect($url='login.php')
{
  $_SESSION['error_flash']='Vous avez pas acces a cette page';
  header('location: '.$url);
}

function has_permission($permission = 'admin'){
  global $user_data;
  $permissions=explode(',', $user_data['permissions']);

  if (in_array($permission,$permissions,true)) {
    return true;
  }
  return false;
}

function pretty_date($date){
  return date("d M, Y h:i A",strtotime($date));
}

 function flash(){
   echo ' <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. <a href="#" class="alert-link">Alert Link</a>.
                            </div>';
 }
