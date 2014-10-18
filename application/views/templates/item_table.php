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
