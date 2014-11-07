<?php
/**
 * Created by PhpStorm.
 * User: student
 * Date: 10/20/14
 * Time: 6:16 PM
 */
?>
<div class="container">
    <?php var_dump($business); ?>
    <div class="row">
        <div class="small-centered">
            <h2 class="text-center"><?php echo $business->name ?></h2>
            <p class="text-center">Phone Number: <?php echo '<a href="tel:'.$business->bphone.'">'.$business->bphone
                    .'</a>' ?>
            <p class="text-center">Address: <?php echo '<a href="https://www.google.com/maps/dir/Current+Location/'
                    .$business->baddress.'" target="_blank" rel="external">'.$business->baddress.'</a>' ?></p>
        </div>
    </div>

</div>