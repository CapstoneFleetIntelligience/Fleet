<head>
    <script src="/js/vendor/modernizr.js"></script>
</head>


<body>

<script src="/js/vendor/jquery.js"></script>
<script src="/js/vendor/fastclick.js"></script>

<script src="js/foundation/foundation.js"></script>
<script src="js/foundation/foundation.abide.js"></script>

<script src="/js/foundation.min.js"></script>


</body>


<?php
/**
 * Created by PhpStorm.
 * User: student
 * Date: 9/21/14
 * Time: 7:17 PM
 */
?>

<div class="container">
    <div class="row">
        <?php echo form_open('register', 'data-abide'); ?>
            <div class="row">
                <div class="small-6 small columns">
                    <div class="name-field">
                    <label><small>required</small></label>
                    <span class="prefix">
                    Business Name
                    </span>
                    <input type="text" required pattern="[a-zA-Z]+" name="name">
                    <small class="error">Name is required and must be a string.</small>
                    </div>
                    <?php //echo form_input('name'); ?>
                </div>
                <div class="small-6 small columns">
                    <label><small>required</small></label>
                    <span class="prefix">
                     Business Address
                    </span>
                    <input type="text" required pattern="[a-zA-Z0-9]+" name="baddress">
                    <small class="error">An address is required and must be a string.</small>
                    <?php //echo form_input('baddress'); ?>
                </div>
            </div>

            <div class="row">
                <div class="small-6 small columns">
                    <label><small>required</small></label>
                    <span class="prefix">
                    Phone
                    </span>
                    <input type="text" required pattern="[0-9]+" name="bphone">
                    <small class="error">A phone number is required.</small>
                    <?php //echo form_input('bphone'); ?>
                </div>
                <div class="small-3 small columns">
                    <label><small>required</small></label>
                    <span class="prefix">
                    Max Delivery Range
                    </span>
                    <input type="text" required pattern="[1-9]+" name="radius">
                    <small class="error">A delivery range is required.</small>
                    <?php //echo form_input('radius'); ?>
                </div>
                <div class="small-3 small columns">
                    <label><small>required</small></label>
                    <span class="prefix">
                    Max Items Allowed to Deliver
                    </span>
                    <input type="number" required pattern="[1-9]+" name="capacity">
                    <small class="error">The capacity amount is required.</small>
                    <?php //echo form_input('capacity'); ?>
                </div>
            </div>

            <div class="row">
                <div class="small-8 small-centered columns">
                    <label><small>required</small></label>
                    <span class="prefix">
                    Business Default Password
                    </span>
                    <input type="password" required pattern="[a-zA-Z0-9]+" name="dpass">
                    <small class="error">A password is required.</small>
                    <?php //echo form_password('dpass'); ?>
                </div>
            </div>

            <div class="row">
                <div class="small-6 small columns">
                    <label><small>required</small></label>
                    <span class="prefix">
                    Manager Name
                    </span>
                    <input type="text" required pattern="[a-zA-Z]+" name="uname">
                    <small class="error">A Manager Name is required and must be a string.</small>
                    <?php //echo form_input('uname'); ?>
                </div>
                <div class="small-6 small columns">
                    <div class="email-field">
                    <label><small>required</small></label>
                    <span class="prefix">
                     Email
                    </span>
                    <input type="email" name="email" required>
                    <small class="error">An email address is required.</small>
                    <?php //echo form_input('email'); ?>
                    </div>
                </div>
            </div>

            <div class="row ">
                <div class="small-6 small columns">
                    <label><small>required</small></label>
                    <span class="prefix">
                    Password
                    </span>
                    <input type="password" required pattern="[a-zA-Z0-9]+" name="pass">
                    <small class="error">A password is required.</small>
                    <?php //echo form_password('pass'); ?>
                </div>
                <div class="small-6 small columns">
                    <label><small>required</small></label>
                    <span class="prefix">
                    Phone
                    </span>
                    <input type="text" required pattern="[0-9]+" name="uphone">
                    <small class="error">A phone number is required.</small>
                    <?php //echo form_input('uphone'); ?>
                </div>
            <button type="submit">Finish</button>
            </form>
            </div>
        <?php //echo form_submit('', 'Finish', "class ='button small'");
        echo form_close();
        ?>
    </div>
</div>

<body>

<script>
    $(document).foundation();
</script>

</body>