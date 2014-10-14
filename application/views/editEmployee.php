<?php
/**
 * Created by PhpStorm.
 * User: student
 * Date: 10/12/14
 * Time: 3:54 PM
 */

/**
 * @todo Make sure to change the view here to allow updating and deleting employees properly
 */
?>

<div class="row item_table">
    <table>
    <thead>
    <tr>
        <th>username</th>
        <th>email</th>
        <th>role</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
<?php

    foreach ($employees as $index => $employee)
    {
        echo form_open('updateEmployee');
        echo '<tr>';
        echo form_hidden('uname', $employee->uname);
        echo '<td>'.$employee->uname.'</td>';
        echo '<td>'.form_input('email', $employee->email).'</td>';
        echo '<td>'.$employee->role.'</td>';
        echo '<td>'.form_submit('update', 'update', "id= 'update_employee_$employee->uname' class = 'tiny button'")
        .'</td>';
        echo '</tr>';
        echo form_close();
    }
    ?>
    </tbody>
    </table>
    </div>

<script type="text/javascript">
$('#update_employee').click(function(){
    console.log();
    return false;
});
</script>