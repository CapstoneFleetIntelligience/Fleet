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
            echo form_open('employee_controller/create', 'id="new_employ"');?>
            <span>Employee's Email Address</span>
            <input type="text" placeholder="Required" required name="email">
            <span>Employee Role</span><br>
            <?php echo form_dropdown('Role', $options, '', 'class="small-8" id="role"');?>
            <br><br><button type="submit" id="submit_employ" class="tiny button">Add</button>
        </div>
        <?php echo form_close(); ?>
    </div>
<div id="employee">
    
</div>