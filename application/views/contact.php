<?php
/**
 * Created by PhpStorm.
 * User: student
 * Date: 10/20/14
 * Time: 6:16 PM
 */

$url =  '<a href="http://www.google.com/maps/dir/Current+Location/'.$business->baddress.'" target="_blank"
rel="external">'.$business->baddress.'</a>';
?>

<div class="container">
    <div class="row">
        <div class="small-centered">
            <?php
            if($this->agent->is_mobile())
            {
                $platform = $this->agent->platform();
                if($platform=='Linux') $url =  '<a href="geo://0,0?q='.$business->baddress.'" data-rel="external">'
                    .$business->baddress.'</a>';
                elseif($platform=='Mac OS X')  $url =  '<a href="geo://0,0?q='.$business->baddress.'" data-rel="external">'.$business->baddress.'</a>';
                else $url = '<a href="maps:'.$business->baddress.'">'.$business->baddress.'</a>';
            }
            ?>
            <h2 class="text-center"><?php echo $business->name ?></h2>
            <b><h4 class="text-center">Phone Number:</b> <?php echo '<a href="tel:'.$business->bphone.'">'
                    .$business->bphone
                    .'</a>' ?>
            </h4>
            <b><h4 class="text-center">Address:</b> <?php echo $url ?>
            </h4>
        </div>
    </div>

</div>
