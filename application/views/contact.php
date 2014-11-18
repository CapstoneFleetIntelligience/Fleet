<?php
/**
 * Created by PhpStorm.
 * User: student
 * Date: 10/20/14
 * Time: 6:16 PM
 */
?>

<div class="container">
    <div class="row">
        <div class="small-centered">
            <h2 class="text-center"><?php echo $business->name ?></h2>
            <b><h4 class="text-center">Phone Number:</b> <?php echo '<a href="tel:'.$business->bphone.'">'
                    .$business->bphone
                    .'</a>' ?>
            </h4>
            <b><h4 class="text-center">Address:</b> <?php echo '<a href="https://www.google.com/maps/dir/Current+Location/'.$business->baddress.'" target="_blank" rel="external">'.$business->baddress.'</a>' ?>
            </h4>
        </div>
    </div>

</div>