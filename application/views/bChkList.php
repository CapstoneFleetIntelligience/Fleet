<?php
/**
 * Created by PhpStorm.
 * User: Brian
 * Date: 10/2/14
 * Time: 11:24 AM
 */
?>

    <?php

    if($items):

    ?>

    <div class="row">
        <?php
        if($delivery){
            echo form_open('addList', "id='add_list'");
            echo form_hidden('cid',$delivery->cid);
            echo form_hidden('ischd',$delivery->schd);
        }
        echo form_fieldset('Select items for list by giving item a quantity greater than 0.');
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
        foreach ($items as $item)
        {
        ?>
            <tr>
                <td><?php echo $item->iname; ?></td>
                <td><?php echo $item->description; ?></td>
                <td><?php

                    $quantity = array(
                        'type' => 'number',
                        'name'  => $item->iid,
                        'id' => $item->iid,
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
        <?php
            if($delivery)
            {
                echo form_submit('','Finish', "id = 'submit_chklst' class = 'button small'");
                echo form_close();
            }
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
    $("#add_list").submit(function (e) {
        var form_data = $("#add_list").serializeArray();

        $.ajax({
            url: "<?php echo site_url('admin_controller/addList'); ?>",
            type: "POST",
            data: form_data,
            success: function (data) {
                $("#add_cust :input").prop('disabled', false);
                $("#add_cust").trigger('reset');
                $('.add_items').fadeOut(2000, 'swing');
                $(".add_items").empty();
            }
        });
        $("#submit_cust").prop('disabled', false);
        return false;
    });
</script>
