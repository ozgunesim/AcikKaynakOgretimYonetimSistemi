<?php $this->load->view('static/header');?>

<script>

	function goToByScroll(id){
    //id = id.replace("link", "");
    // Scroll
    $('html,body').animate({
        scrollTop: ($("#"+id).offset().top + $('#'+id).height())},
        'slow');
	}
</script>

<div class="container-fluid">
	
	<?php
	$this->load->view('messages');
	?>

	<div class="row">
	<div class="col-md-3 messages-left"></div>
	<div class="col-md-9"></div>
	</div>


</div>


<?php $this->load->view('static/footer');

$base = base_url() ."assets/" ?>
<link href="<?=$base?>css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="<?=$base?>js/bootstrap-toggle.min.js"></script>




<script>
$(document).ready(function(){

	$('.modal').modal('show');


	$('#close-window').click(function(){
		window.close();
	});

	$('.start-att-btn').click(function(){
		$('#acd-holder').val($(this).val());
		  window.open('', 'start_att', 'width=800,height=600');
		  document.getElementById('select-course-form').submit();
	});
});
</script>
