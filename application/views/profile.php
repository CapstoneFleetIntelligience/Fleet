<?php
/**
 * Created by PhpStorm.
 * User: student
 * Date: 11/17/14
 * Time: 3:00 PM
 */
?>

<div class="container profile">
    <div class="small-centered">
        <div class="row">
            <h3 class="text-center">Edit <?php echo $user->uname ?>'s Profile</h3>
            <hr/>
        </div>
    </div>
    <?php echo form_open('', 'id="profileForm" ', array('uname' => $user->uname, 'role' => $user->role)); ?>
    <div class="row">
        <div class="small-3 columns">
            <label for="email" class="right inline">Email:</label>
        </div>
        <div class="small-9 columns">
            <input name="email" type="email" placeholder="email" value="<?php echo $user->email ?>">
        </div>
    </div>
    <div class="row">
        <div class="small-3 columns">
            <label for="phone" class="right inline">Phone:</label>
        </div>
        <div class="small-9 columns">
            <input name="uphone" type="tel" placeholder="telephone" value="<?php echo $user->uphone ?>">
        </div>
    </div>
    <div class="row">
        <div class="small-8 small-centered columns">
            <button id="showPass" type="button" class="button expanded">Change Password</button>
        </div>
    </div>
    <div class="password hide">
        <div class="row">
            <div class="small-3 columns">
                <label for="password" class="right inline">
                    Enter current password
                </label>
            </div>
            <div class="small-9 columns">
                <input type="password" name="pass" placeholder="Current Password">
            </div>
        </div>
        <div class="row">
            <div class="small-3 columns">
                <label for="password" class="right inline">
                    Enter New password
                </label>
            </div>
            <div class="small-9 columns">
                <input type="password" name="newPass" placeholder="New Password">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="right">
            <button id="updateUser" type="submit" class="button radius">Update Profile</button>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>

