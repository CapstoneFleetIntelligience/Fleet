<?php
/**
 * Created by PhpStorm.
 * User: Brian
 * Date: 10/2/14
 * Time: 11:24 AM
 */
?>

    <?php
    $business = $this->session->userdata('bname');
    $query = $this->db->get_where('capsql.chkitem', array('bname' => $business));
    $x = $query->num_rows();
    if($x > 0):

    ?>

    <div class="row">
        <?php echo form_open('addList', "id='add_list'");
        echo form_fieldset('Select items for list by giving item a quantity greater than 0.');
        echo form_hidden('cid',$delivery->cid);
        echo form_hidden('ischd',$delivery->schd);
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

                    $quantity = array(
                        'type' => 'number',
                        'name'  => $row->iid,
                        'id' => $row->iid,
                        'value' => '0',
                        'min' => '0',
                        'max' => '1000',
                        'step' => '1'
                    );
                    echo form_input($quantity) ?></td>
            </tr>
        <?php
        }

        ?>
        </tbody>
        </table>
        <?php echo form_submit('','Finish', "id = 'submit_chklst' class = 'button small'");
        echo form_close();
        ?>
         </div>
        <div class="delivered">

        </div>

    <?php
    else:
    ?>
        <div class="row"><h2>There are no items associated with this business. Please add items to your business then you can create checklists.</h2></div>
    <?php endif; ?>

<script type="text/javascript">
    $("#submit_chklst").click(function()
    {
        var form_data = $("#add_list").serializeArray();

       $.ajax({
            url:"<?php echo site_url('addList'); ?>",
            type: "POST",
            data: form_data,
            success: function (data) {
                $(".delivered").html(data).fadeIn(2000, 'swing', function(){
                    $('.delivered').fadeOut(5000,'swing', function (){
                        $('add_items').fadeOut(2500, 'swing');
                        $("#add_cust").trigger('reset');
                        $(".add_items").empty();
                    });
                    $("#submit_cust").prop('disabled', false);
                });
            }
        });
        return false
    });
</script>
