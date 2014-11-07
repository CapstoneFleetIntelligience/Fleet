<?php
/**
 * Created by PhpStorm.
 * User: student
 * Date: 9/17/14
 * Time: 9:32 PM
 */
?>

    <div id="footer" class="row">
        <div class = "small-12 center">
            Copyrighted
        </div>
    </div>
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


    $('#updateBusinessPass').click(function() {
        var pass = {
            bpass: $('#bpass').val(),
            name: $('#bname').val()
        };

        $.ajax({
            url: "<?php echo site_url('Settings_controller/editPass')?>",
            type: 'POST',
            data: pass,
            success: function (msg) {
                $('#editPassModal').foundation('reveal', 'close');
            }
        });
        return false;
    });


    $('#updateRange').click(function(){
        var radius = {
            radius: $('#radius').val(),
            name: $('#bname').val()
        };
        $.ajax({
            url: "<?php echo site_url('Settings_controller/editRange')?>",
            type: 'POST',
            data: radius,
            success: function (data) {
                $('#editRadiusModal').foundation('reveal', 'close');
            }
        });

        return false;
    });

</script>

</body>
</html>
