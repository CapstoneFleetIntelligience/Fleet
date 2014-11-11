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
    <div class="row">
        <div class="panel">
            <p class="center">Add Employee(s)</p>
            <?php
            echo form_open('employee_controller/create', 'id="new_employ"');
            echo form_input($email);
             echo form_dropdown('Role', $options, '', 'class="small-8" id="role"');
             echo form_submit('submit', 'Add', "id = 'submit_employ' class='tiny button'");
              ?>
        </div>
        <?php echo form_close(); ?>
    </div>
<div id="employee">
    
</div>