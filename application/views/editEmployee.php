<?php
/**
 * Created by PhpStorm.
 * User: cg236
 * Date: 10/12/14
 * Time: 3:54 PM
 */
$options = array(
    'M' => 'Manager',
    'E' => 'Employee'
);
?>

<div class="employee_table">
    <div class="row">
        <table>
            <thead>
            <tr>
                <th width="200">Username</th>
                <th width="200">Email</th>
                <th width="200">Phone</th>
                <th width="150">Role</th>
                <th width="80">Update</th>
                <th width="80">Delete</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($employees as $index => $employee) {
                echo '<tr id="updateUser-' . $employee->uname . '">';
                echo '<td>' . $employee->uname . '</td>';
                echo '<td>' . form_input('email', $employee->email) . '</td>';
                echo '<td>' . form_input('uphone', $employee->uphone) . '</td>';
                echo '<td>' . form_dropdown('role', $options, $employee->role) . '</td>';
                echo '<td><button type="button" class="button tiny radius update" id="' . $employee->uname . '">Update</button></td>';
                echo '<td><button type="button" class="button tiny radius delete" id="' . $employee->uname . '">Delete</button></td>';
                echo form_hidden('uname', $employee->uname);
                echo form_hidden('bname', $employee->bname);
                echo '</tr>';
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
