<?php
/**
 * Created by PhpStorm.
 * User: student
 * Date: 9/17/14
 * Time: 9:32 PM
 */
?>

  <footer class="row">
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

    $("#submit_delivery").click(function()
    {
       var form_data = $("#add_delivery").serializeArray();
        console.log(form_data);

        $.ajax({
           url: "<?php echo site_url('admin_controller/newDelivery') ?>",
            type: 'POST',
            data:form_data,
            success: function(data){
                $('#add_delivery').trigger('reset');
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
        var city = $("#city").val();
        var state = $("#state").val();
        var zip = $("#zip").val();
        var address = $("#address").val();
        var caddress = address + ', ' + city + ', ' + state + ' ' + zip;
        var form_data = {
            cname: $('#cname').val(),
            caddress: caddress,
            cphone: $('#cphone').val()
        };
        var delivery_data = {
            schd: $('#schd').val(),
            note: $('#note').val()
        };


        $.ajax({
            url: "<?php echo site_url('admin_controller/addCust'); ?>",
            type: 'POST',
            data: {
                customer: form_data,
                delivery: delivery_data,
                list: $('input:radio[name=list]:checked').val()
            },
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
</script>

</body>
</html>
