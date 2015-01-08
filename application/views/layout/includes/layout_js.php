	<!-- Vendor -->
	<script src="<?=base_url('assets/vendor/jquery/jquery.js') ?>"></script>
	<script src="<?=base_url('assets/vendor/jquery.appear/jquery.appear.js') ?>"></script>
	<script src="<?=base_url('assets/vendor/jquery.easing/jquery.easing.js') ?>"></script>
	<script src="<?=base_url('assets/vendor/jquery-cookie/jquery-cookie.js') ?>"></script>
	<script src="<?=base_url('assets/vendor/bootstrap/bootstrap.js') ?>"></script>
	<script src="<?=base_url('assets/vendor/common/common.js') ?>"></script>
	<script src="<?=base_url('assets/vendor/jquery.validation/jquery.validation.js') ?>"></script>
	<script src="<?=base_url('assets/vendor/jquery.stellar/jquery.stellar.js') ?>"></script>
	<!-- <script src="<?=base_url('assets/vendor/jquery.easy-pie-chart/jquery.easy-pie-chart.js') ?>"></script> 
	<script src="<?=base_url('assets/vendor/jquery.gmap/jquery.gmap.js') ?>"></script>
	<script src="<?=base_url('assets/vendor/twitterjs/twitter.js') ?>"></script>
	<script src="<?=base_url('assets/vendor/isotope/jquery.isotope.js') ?>"></script>
	<script src="<?=base_url('assets/vendor/owlcarousel/owl.carousel.js') ?>"></script>
	<script src="<?=base_url('assets/vendor/jflickrfeed/jflickrfeed.js') ?>"></script>
	<script src="<?=base_url('assets/vendor/magnific-popup/jquery.magnific-popup.js') ?>"></script> -->
	<script src="<?=base_url('assets/vendor/vide/jquery.vide.js') ?>"></script>
	<script src="<?=base_url('assets/vendor/numeric/numeric.js') ?>"></script>
	
	<!-- Theme Base, Components and Settings -->
	<script src="<?=base_url('assets/js/theme.js') ?>"></script>
	
	<!-- Theme Custom -->
	<script src="<?=base_url('assets/js/custom.js') ?>"></script>
	
	<!-- Theme Initialization Files -->
	<script src="<?=base_url('assets/js/theme.init.js') ?>"></script>
	<script type="text/javascript">
	$( document ).ready(function() {
       if($(".numkk").length > 0 ){
	     $(".numkk").numeric();
	   }
    });
	
	function post_comment(){
	 var ven = $('#vendor-id').val();
	 var name = $('#name').val();
	 var email = $('#email').val();
	 var comment = $('#message').val();
	 
	 if(name == ''){
	   $('#name').focus();
	 }else if(email ==""){
	   $('#email').focus();
	 }
	 else if(comment == ""){
	    $('#message').focus();
	 }else{
	 
  $.ajax({
   type: "POST",
   url: '<?php echo site_url('clients/review'); ?>',
   data: {name:name,email:email,comment:comment,vendor:ven},
   success: function(data, textStatus, jqXHR)
    {
        window.location.reload();
    },
    error: function (jqXHR, textStatus, errorThrown)
    {
 
    }
  });
  }
  }
</script>