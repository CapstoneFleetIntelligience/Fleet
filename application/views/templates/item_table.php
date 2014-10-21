<<<<<<< HEAD
<?php
/**
 * Created by PhpStorm.
 * User: student
 * Date: 10/5/14
 * Time: 9:12 PM
 */
$query = $this->db->get_where('capsql.chkitem',array('bname' => $this->session->userdata('bname')));
if(($query->result())): ?>
   <div class="row">
    <table>
        <thead>
        <tr>
            <th>Item name</th>
            <th>Item Description</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($query->result() as $row)
        {
            echo '<tr>';
            echo '<td>'.$row->iname.'</td>';
            echo '<td>'.$row->description.'</td>';
            echo '</tr>';

        }
        ?>
        </tbody>
    </table>
</div>
<?php endif; ?>
=======
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
        <?php echo form_open('addItem');
        ?>
        <tr>
            <td><?php echo form_input($name); ?></td>
            <td><?php echo form_textarea($description); ?></td>
        </tr>
        </tbody>
    </table>
       <?php echo form_submit('submit', 'Continue', "class= 'button' id='submit'");
       echo form_close();
       ?>
</div>
<?php endif; ?>

<script type="text/javascript">
    $('#submit').click(function(){
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
    })

</script>
>>>>>>> f972b268a1295ea69c45347b0dd667a0d5cd7dfa
