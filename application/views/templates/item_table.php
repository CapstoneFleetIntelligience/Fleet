<?php
$name = array(
    'name' => 'iname',
    'id' => 'itemN',
    'placeholder' => 'Enter new item here'
);
$description = array(
    'name' => 'description',
    'id' => 'description',
    'placeholder' => 'Enter items description',
    'rows' => '4',
);

?>
    <div class="row">
        <table>
            <thead>
            <tr>
                <th>Item name</th>
                <th>Item Description</th>
                <th>Remove</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if (!empty($items)):
                foreach ($items as $item) {
                    if ($item->active == 't') {
                        echo '<tr>';
                        echo '<td>' . $item->iname . '</td>';
                        echo '<td>' . $item->description . '</td>';
                        echo '<td><button name="remove" id="' . $item->iid . '" class="button small radius remove-btn">Remove</button>';
                        echo '</tr>';
                    }
                }
                ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="row">
        <fieldset>
            <legend>Add a new item</legend>
            <div class="row">
                <div class="small-12 medium-12 large-12 columns">
                    <div class="row">
                        <div class="small-4 medium-4 large-4 columns">
                            <label for="itemN" class="right hide-for-small-only">
                                New item
                            </label>
                        </div>
                        <div class="small-12 medium-8 large-8 columns">
                            <input name='iname' id='itemN' placeholder="Enter new item name"/>
                        </div>
                    </div>
                </div>
                <div class="small-12 medium-7 large-7 columns">
                    <?php echo form_textarea($description); ?>
                </div>
            </div>
            <button name="add" id="add_item" class="radius small right button">Add</button>
        </fieldset>
    </div>

<script type="application/javascript">
    $('#add_item').click(function () {
        $(this).unbind('click');
        var form_data = {
            iname: $('#itemN').val(),
            description: $('#description').val()
        };

        $.ajax({
            url: "admin_controller/addItem",
            type: 'POST',
            data: form_data,
            success: function (data) {
                $(".item_table").html(data);
            }
        });
        return false
    });

    $(".item_table").on("click", '.remove-btn', function () {
        $(this).unbind('click');
        var id = {
            id: this.id
        };

        $.ajax({
            url: "<?php echo site_url('business_controller/removeItem') ?>",
            type: 'POST',
            data: id,
            success: function (data) {
                $(".item_table").html(data);
            }
        })
    });
</script>