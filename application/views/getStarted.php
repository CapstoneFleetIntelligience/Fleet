<?php
/**
 * Created by PhpStorm.
 * User: student
 * Date: 10/14/14
 * Time: 7:53 PM
 */
?>

<div class = "row">
    <div class="small-12 columns">
        <p>Follow the next few steps to complete the setup of your Fleet Intelligence account</p>
    </div>
</div>

<div class = "row">
    <div class="small-4 columns prompt">
        <p>Step 1: Create your first employee(s)</p>
    </div>
    <div class="small-8 columns add">
        <?php $this->load->view('addEmployee'); ?>
    </div>
</div>
<div class = "row">
    <span class ="small-offset-2 continue">
        <?php echo anchor('', 'continue', 'id="continue" class="button tiny"') ?>
    </span>
    <span class="small-offset-2 hide launch">
        <?php echo anchor('adminH', 'launch', 'id="launch" class="button radius"') ?>
    </span>
</div>


<script type="text/javascript">
    $('#continue').click(function(){
        $('.prompt').html('<p>Step 2: Create your checklist items</p>');

        $.ajax({
            url:"<?php echo site_url('site_controller/itemTable'); ?>",
            type: "GET",
            success: function(data){
                $('.add').html(data);
                $('.continue').empty();
                $('.launch').toggleClass('hide');
            }
        });

        return false
    })

</script>