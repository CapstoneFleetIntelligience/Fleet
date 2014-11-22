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
   <div class="row item_table">
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
        if(!empty($items)):
        foreach ($items as $item)
        {
            if($item->active == 't')
            {
                echo '<tr>';
                echo '<td>'.$item->iname.'</td>';
                echo '<td>'.$item->description.'</td>';
                echo '<td><button name="remove" id="'.$item->iid.'" class="button small radius">Remove</button>';
                echo '</tr>';
            }
        }
        ?>
        <?php endif; ?>
        <?php echo form_open('');
        ?>
        <tr>
            <td>
                <?php echo form_input($name); ?>
            </td>
            <td><?php echo form_textarea($description); ?></td>
        </tr>
        </tbody>
    </table>
       <?php echo form_submit('submit', 'add', "class= 'tiny button' id='add_item'");
       echo form_close();
       ?>
</div>
<a class="close-reveal-modal">&#215;</a>


