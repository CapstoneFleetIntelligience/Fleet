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

<script type="text/javascript">

    $(document).foundation();

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
    })
</script>

</body>
</html>

