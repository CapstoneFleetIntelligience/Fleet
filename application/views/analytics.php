<div class="container">
    <div class="row">
        <div class="small-centered">
            <h2 class="text-center"><?php echo $user ?></h2>
            <p class="text-justify"><b>Total deliveries made today:  </b><?php echo $count ?></p>
        </div>
        <div class="row">
            <div class="small-centered">
                <?php print_r($employees);
                    echo br(2);
                    print_r($business);
                ?>

            </div>
        </div>
    </div>
</div>