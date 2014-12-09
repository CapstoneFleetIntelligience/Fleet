<?php
/**
 * Created by PhpStorm.
 * User: student
 * Date: 9/17/14
 * Time: 9:32 PM
 */
?>

  <footer class="row show-for-medium-up">
    <div class="large-12 columns">
      <hr/>
      <div class="row">
        <div class="large-6 columns">
          <p>&copy Copyright</p>
        </div>
      </div>
    </div>
  </footer>
<body>

<html>

<script type="text/javascript">

    $(document).foundation();

    $('#register_user').click(function () {
        var form_data = $('#registration_form').serialize();

        $.ajax({
            url:"<?php echo site_url('register') ?>",
            type: 'POST',
            data: form_data,
            success: function (data) {
                $(".registration").html(data);
            }
        });
        return false;
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



    $('#updateBusinessPass').click(function() {
        var info = $("#editBusinessPass").serialize();

        $.ajax({
            url: "<?php echo site_url('Settings_controller/editPass')?>",
            type: 'POST',
            data: info,
            success: function (msg) {
                $('#editPassModal').foundation('reveal', 'close');
                alert(msg);
            }
        });
        return false;
    });

    $("#submit_delivery").click(function()
    {
       var form_data = $("#add_delivery").serializeArray();

        $.ajax({
           url: "<?php echo site_url('admin_controller/newDelivery') ?>",
            type: 'POST',
            data:form_data,
            success: function(data){
                $('#add_delivery').trigger('reset');
                $('.delivery_table').html(data);

            }

        });
        return false
    });

    $('.delivery_table').on("click", ".delete", function () {
        $(this).unbind('click');
        var id= $(this).attr('id');
        var td = $(this).parent();
        var schd = $(td[0]).find("input").val();

        var data = {
            cid: id,
            schd: schd
        };

        $.ajax({
            url: "admin_controller/removeDelivery",
            type: 'POST',
            data: data,
            success: function(data){
                $('.delivery_table').html(data);
            }
        })
    });

    $('#submit_cust').click(function () {
        var form_data = $("#add_cust").serialize();

        $.ajax({
            url: "<?php echo site_url('admin_controller/addCust'); ?>",
            type: 'POST',
            data: form_data,
            success: function (data) {
                if (data == 'reset') {
                    $("#add_cust").trigger('reset');
                    alert('Delivery Set');
                }
                else {
                    $(".add_items").html(data);
                    $("#add_cust :input").prop('disabled', true);
                    $("#submit_cust").prop('disabled', true);
                }
            }
        });
        return false;
    });

    $("#showPass").on('click', function(){
        var text = $("#showPass").text();
        $(".password").toggle();
        if(text == 'Change Password') $("#showPass").text('Cancel');
        else $("#showPass").text('Change Password');
    });

    $("#updateUser").on('click', function()
    {
        var form_data = $("#profileForm").serialize();

        $.ajax({
            url: "<?php echo site_url('employee_controller/updateUser') ?>",
            type: "POST",
            data: form_data,
            success: function(data){
                console.log(data);
                alert('Update successful');
            }
        });

        return false;
    });

    $('.employee_table').on("click", ".update", function(){
        $(this).unbind('click');
        var id = $(this).attr('id');
        var data = $('#updateUser-'+id+' :input').serialize();
        editEmployee('update', data);
    });

    $('.employee_table').on("click", ".delete", function(){
        $(this).unbind('click');
        var id = $(this).attr('id');
        var data = $('#updateUser-'+id+' :input').serialize();
        editEmployee('delete', data);
    });
</script>

</body>
</html>
