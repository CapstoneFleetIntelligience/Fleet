<?php
$email = array(
    'name' => 'email',
    'class' => 'small-8 columns',
    'id' => 'email'
);
$options = array(
    'A' => 'Admin',
    'M' => 'Manager',
    'E' => 'Employee'
);
?>
<div class ="container">
    <div class="row">
        <div class="panel">
            <p class="center">Add Employee(s)</p>
            <?php echo form_open('employee_controller/create'); ?>
            <?php echo form_input($email); ?>
            <?php echo form_dropdown('Role', $options, '', 'class="small-8" id="role"'); ?>
            <?php echo form_submit('', 'Add', 'id = "submit"'); ?>
            <?php echo form_close(); ?>
        </div>
    </div>
    <div id = "user_data">

    </div>
</div>

<script type="text/javascript">
    $('#submit').click(function(){
        var form_data = {
            email: $('#email').val(),
            role: $('#role').val()
        };

        $.ajax({
            url: "<?php echo site_url('employee_controller/create'); ?>",
            type: 'POST',
            data: form_data,
            success: function(msg){$("#user_data").html(msg).fadeIn()}
        });

        return false
    })

</script>