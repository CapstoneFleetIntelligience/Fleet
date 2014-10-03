<?php
/**
 * Created by PhpStorm.
 * User: Brian
 * Date: 10/2/14
 * Time: 11:24 AM
 */
?>

<div class="container">
    <?php
    $query = $this->db->get_where('capsql.chkitem',array('bname' => $this->session->userdata('bname')));
    $x = $query->num_rows();
    if($x > 0)
    {

    ?>

    <div class="row">
        <?php echo form_open('addList');
        echo form_fieldset('Select items for list by giving item a quantity greater than 0.');
        echo form_hidden('cid',$mycid);
        echo form_hidden('ischd',$myschd);
        ?>
        <table>
            <thead>
            <tr>
                <th>Item name</th>
                <th>Item Description</th>
                <th>quantity</th>
            </tr>
            </thead>
            <tbody>
        <?php
        foreach ($query->result() as $row)
        {
        ?>
            <tr>
                <td><?php echo $row->iname; ?></td>
                <td><?php echo $row->description; ?></td>
                <td><?php

                    $y = array(
                        'type' => 'number',
                        'name'  => 'x'.$row->iid,
                        'value' => '0',
                        'min' => '0',
                        'max' => '1000',
                        'step' => '1'
                    );
                    echo form_input($y) ?></td>
            </tr>
        <?php
        }


        ?>
        </tbody>
        </table>
        <?php echo form_submit('submit','Submit List', array('class' => 'button small'));
        echo form_close();
        ?>

    </div>

    <?php
    }
    else{
    ?>
        <div class="row"><h2>There are no items associated with this business. Please add items to your business then you can create checklists.</h2></div>

    <?php
    }
    ?>

</div>
