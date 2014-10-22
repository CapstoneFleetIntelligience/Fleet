<?php
/**
 * Created by PhpStorm.
 * User: student
 * Date: 10/5/14
 * Time: 9:12 PM
 */

$name = array(
    'name' => 'iname',
    'id' => 'itemN',
);
$description = array(
    'name' => 'description',
    'id' => 'description',
    'rows' => '4',
);
$query = $this->db->get_where('capsql.chkitem',array('bname' => $this->session->userdata('bname')));
?>
   <div class="row item_table">
    <table>
        <thead>
        <tr>
            <th>Item name</th>
            <th>Item Description</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if(($query->result())):
        foreach ($query->result() as $row)
        {
            echo '<tr>';
            echo '<td>'.$row->iname.'</td>';
            echo '<td>'.$row->description.'</td>';
            echo '</tr>';
        }
        ?>
        <?php endif; ?>
        <?php echo form_open('addItem');
        ?>
        <tr>
            <td><?php echo form_input($name); ?></td>
            <td><?php echo form_textarea($description); ?></td>
        </tr>
        </tbody>
    </table>

       <?php echo form_submit('submit', 'add', "class= 'tiny button' id='add_item'");
       echo form_close();
       ?>
</div>


