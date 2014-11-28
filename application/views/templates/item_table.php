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
<div class="item_table">
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
        if(!empty($items)):
        foreach ($items as $item)
        {
            if($item->active == 't')
            {
                echo '<tr>';
                echo '<td>'.$item->iname.'</td>';
                echo '<td>'.$item->description.'</td>';
                echo '<td><button name="remove" id="'.$item->iid.'" class="button small radius remove-btn">Remove</button>';
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
               <div class="small-5 columns">
                   <div class="row">
                       <div class="small-4 columns">
                           <label for="itemN" class="right">
                               New item
                           </label>
                       </div>
                       <div class="small-8 columns">
                           <input name ='iname' id = 'itemN' placeholder="Enter new item name"/>
                       </div>
                   </div>
               </div>
               <div class="small-7 columns">
                   <?php echo form_textarea($description); ?>
               </div>
           </div>
           <button name ="add" id="add_item" class="radius right button">Add</button>
       </fieldset>
    </div>
    <a class="close-reveal-modal">&#215;</a>
</div>

