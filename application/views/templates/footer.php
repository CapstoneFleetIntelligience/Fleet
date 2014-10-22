<?php
/**
 * Created by PhpStorm.
 * User: student
 * Date: 9/17/14
 * Time: 9:32 PM
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
	
	<footer class="row">
		<div class="small-12 columns">
			<hr />
			<div class="row">
				<div class="small-6 large-6 columns">
					<p>&copy Copyrighted</p>
				</div>
				<div class="small-6 large-6 columns">
					<ul class="inline-list right">
						<li><?php echo anchor('adminH', 'Home'); ?></li>
						<li><?php echo anchor('analytics', 'Analytics') ?></li>
						<li><?php echo anchor('adminE', 'Edit')?></li>
					</ul>
				</div>
			</div>
		</div>
	</footer>
</body>

</html>

<script type="text/javascript">

    $(document).foundation();

    $('#register_user').click(function () {
        var form_data = $('#registration_form').serialize();
        console.log(form_data);
        $.ajax({
            url:"<?php echo site_url('site_controller/register') ?>",
            type: 'POST',
            data: form_data,
            success: function (data) {
                console.log(data);
            }
        });
        return false;
    });

    $('#submit_employ').click(function(){
        var form_data = {
            email: $('#email').val(),
            role: $('#role').val()
        };

        $.ajax({
            url: "<?php echo site_url('employee_controller/create'); ?>",
            type: 'POST',
            data: form_data,
            success: function(msg){
                $("#employee").html(msg).fadeIn();
                $("#new_employ").trigger('reset');
            }
        });
        return false
    });

    $("#submit_pass").click(function () {
        var pass = {
            pass: $("#pass").val()
        };

        $.ajax({
            url: "<?php echo site_url('employee_controller/changePass') ?>",
            type: 'POST',
            data: pass,
            success: function (data) {
                $(".employee").toggleClass('hide');
                $("#password").toggleClass('hide');
            }
        });
        return false
    });

    $('#add_item').click(function(){
        var form_data = {
            iname: $('#itemN').val(),
            description: $('#description').val()
        };

        $.ajax({
            url: "<?php echo site_url('admin_controller/addItem'); ?>",
            type: 'POST',
            data: form_data,
            success: function(data){$(".item_table").html(data);}
        });

        return false
    });

</script>

</body>
</html>
