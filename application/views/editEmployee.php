<?php
/**
 * Created by PhpStorm.
 * User: student
 * Date: 10/12/14
 * Time: 3:54 PM
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

        echo '<tr>';
        echo '<td>'.$employee->uname.'</td>';
        echo '<td>'.$employee->email.'</td>';
        echo '<td>'.$employee->role.'</td>';
        echo '<td>'.anchor('', 'remove', ' onclick= "remove()" id = "remove'
                .$employee->uname.'"
        class="button tiny"')
            .'</td>';
        echo '</tr>';
    }
    ?>
    </tbody>
    </table>
    </div>

<script type="text/javascript">
   function remove(){
       console.log();
       return false;
   }
</script>