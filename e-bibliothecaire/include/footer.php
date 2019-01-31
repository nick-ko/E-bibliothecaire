<section class="footer-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
               &copy; 2018 bibliotheque 2.0 |<a href="" target="_blank"  > Designed by : nick dev</a>
            </div>

        </div>
    </div>
</section>

<script type="text/javascript">
function detailsmodal(id) {

  var data= {'id':id};
  jQuery.ajax({
      url:'/e-bibliothecaire/app/detailsmodal.php',
      method:"post",
      data:data,
      success:function (data) {
          jQuery('body').append(data);
          jQuery('#details-modal').modal('toggle');
      },
      error:function () {
          alert("something went wrong")
      }
  })
}
function buysmodal(id) {

  var data= {'id':id};
  jQuery.ajax({
      url:'/e-bibliothecaire/app/buysmodal.php',
      method:"post",
      data:data,
      success:function (data) {
          jQuery('body').append(data);
          jQuery('#buys-modal').modal('toggle');
      },
      error:function () {
          alert("something went wrong")
      }
  })
}

function add_to_cart() {

    jQuery('#modal_errors').html(" ");
    var quantity = jQuery('#quantity').val();
    var available = jQuery('#available').val();
    var error='';
    var data= jQuery('#add_product_form').serialize();

    if (quantity == '' || quantity == 0) {
      error += '<p class="text-danger text-center"> Veuillez entrer la quantité SVP!</p>';
      jQuery('#modal_errors').html(error);
      return;
    }else {
      jQuery.ajax({
        url:'/e-bibliothecaire/app/add_cart.php',
        method:'post',
        data:data,
        success:function(){
          location.reload();
        },
        error:function(){
          alert("error");
        }
      })
    }
}

</script>
