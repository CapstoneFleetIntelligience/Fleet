<?php
/**
 * Created by PhpStorm.
 * User: Bcolemutech
 * Date: 11/14/14
 * Time: 8:19 PM
 */

print_r($deliverer);
echo br(2);
print_r($route);
if ($deliverer == false){
    ?>
<div class="container">
    <div class="row">
        <div class="small-12">
            <h3>You have no routes assigned for today.</h3>
        </div>
    </div>
</div>
<?
}
else{
$options = array();
foreach ($deliverer->routes['route'] as $row)
{
    $options[$row->rid] = "Route #". ($row->rid++) ."";
}
?>
<div class="container">
    <div class="row">
        <div class="small-12">
            <?
            echo form_open('changeR',"id='changeR'");
            echo form_fieldset("Select a route to begin");
            echo form_dropdown('rid',$options,$route->rid,"onchange=\"this.form.submit()\"");
            ?>
        </div>
    </div>
</div>
<?
}