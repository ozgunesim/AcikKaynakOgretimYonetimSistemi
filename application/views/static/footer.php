</div><!-- col md 10 -->
</div><!-- container-fluid -->

<?php $base = base_url() ."assets/" ?>
    
    <!-- jQuery -->
    <script src="<?=$base?>js/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?=$base?>js/bootstrap.min.js"></script>
    <script>
    	$(document).ready(function(){
    		$('.toggle-menu').click(function(){
    			$('.menu-list').slideToggle();
    		});
    	});
    </script>

</body>

</html>
