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

<?php
$this->load->view('messages');
?>
<div class="messages-container">
	<div class="messages-left">
		<h5 class="text-center">Konuşmalar</h5>
		<select class="selectpicker form-control" data-live-search="true"  data-header="Kişi Bul" title="Bir kişi ara...">
			<?php
			foreach ($student_list as $student) {
			?>
			<option value="<?=$student->user_id;?>" data-tokens="<?=mb_strtolower($student->user_name, "UTF-8");?>"><?=$student->user_name;?></option>
			<?php
			}
			?>
		</select>
		<div class="alert alert-danger no-margin">Bu mesajlaşma alanı anlık mesajı desteklemez. Gelen mesajları görmek için sayfayı yenilemeniz gerekir.</div>


		<div class="list-group">
			<form action="" method="post">
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
			<?php
			//exit(var_dump($msg_list));
			foreach ($msg_list as $msg) {
				$_text = ((string)$msg->sender !== (string)$this->session->userdata('user')->user_id) ? $msg->sender_username : $msg->receiver_username;
			?>
			<button class="list-group-item msg-list-item" type="submit" name="start_chat" value="<?=$msg->sender;?>">
				<strong class="/*<?=($msg->has_msg == '1') ? 'text-success' : '';?>*/"><?=$_text;?></strong>
				<!--small><?=substr($msg->message_content, 0 , 15).'...';?></small-->
			</button>
			<?php
			}
			?>
			</form>
		  
		</div>
	</div>
	<div class="messages-right">
		<div class="messages-chatbox" id="chatbox">
			<?php
			if(isset($last100)){
				foreach ($last100 as $msg) {
					if($msg->sender != $this->session->userdata('user')->user_id){
					?>
					<div class="container-fluid">
						<div class="talk-bubble tri-right left-top">
						  <div class="talktext">
						    <p><?=$msg->message_content;?></p>
						  </div>
						</div>
					</div>
					<?php
					}else{
					?>
					<div class="container-fluid text-right">
						<div class="talk-bubble tri-right btm-right">
						  <div class="talktext">
						    <p><?=$msg->message_content;?></p>
						  </div>
						</div>
					</div>
					<?php
					}
				}
			}
			?>
		</div>
		<div class="messages-header">
			<h3 class="text-center">
			<?php
			if(isset($last100)){
				echo $last100[0]->sender_username;
			}
			?>
			</h3>

		</div>
		<div class="messages-sendbox" style="padding: 5px;">
			<form action="" method="post" style="height: 100%;" id="msg-form">
				<input type="hidden" name="msg-target" value="<?=(isset($chat_target)) ? $chat_target : '';?>" id="target-holder" >
				<textarea class="form-control" id="message-textarea" name="message_content" placeholder="mesajınızı girin ve enter tuşuna basın." style="height: 100%; resize:none;" ></textarea>
			</form>
		</div>
		<div class="messages-tooltip">
			Yan menüden bir konuşma seçin...
		</div>
	</div>
</div>

<?php $this->load->view('static/footer');

$base = base_url() ."assets/" ?>
<link href="<?=$base?>css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="<?=$base?>js/bootstrap-toggle.min.js"></script>
<?php
if(!isset($last100)){
?>
<script>
$('.messages-tooltip').css('display','table-cell');
</script>
<?php
}
?>



<script>
$(document).ready(function(){

	$('.modal').modal('show');
	$('.messages-chatbox').scrollTop( document.getElementById("chatbox").scrollHeight );
	$('#message-textarea').keypress(function (e) {

	  if (e.which == 13 && !e.shiftKey) {
			if($('#target-holder').val() != "")
	    	$('#msg-form').submit();
	    return false;
	  }
	});

	$('.selectpicker').on('changed.bs.select', function (e) {
		var _val = $('.selectpicker option:selected').val();
		var _text = $('.selectpicker option:selected').text();
		$('.messages-header h3').text(_text);
		$('#chatbox').empty();
		$('#target-holder').val(_val);
		$('#message-textarea').css('display','block');
		console.log(_val);
	});


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
