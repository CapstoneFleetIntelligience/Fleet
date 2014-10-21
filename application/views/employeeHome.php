<?php
/**
 * Created by PhpStorm.
 * User: student
 * Date: 10/14/14
 * Time: 2:15 PM
 */

$pass = array(
    'name' => 'pass',
    'id' => 'pass'
)
?>

<?php if($user->pass == $business->dpass): ?>
<div id="password" class="row">
    <div class="small-centered">
        <?php
              echo form_open('changePass', 'id = "changePass"');
              echo form_password($pass);
              echo form_submit('continue', 'Continue', 'id="submit_pass" class="button tiny"');
              echo form_close();
        ?>
    </div>
</div>
<div class="employee hide">
    <?php endif; ?>
    <div class="row">
        <div class="small-offset-4 small-centered title-area">
            <p class="title"><?php echo $user->uname ?></p>
        </div>
    </div>
    <div class="row">
        <div class="small-offset-4 small-centered">
            <p> Todays Route Assignment</p>
        </div>
    </div>

    <div class="row">
        <div class="small-centered">
            <b><p>Route Summary</p></b>
        </div>
    </div>
</div>
