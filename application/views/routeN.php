<?php
/**
 * Created by PhpStorm.
 * User: Brian
 * Date: 10/11/14
 * Time: 7:59 PM
 */
$schd = array(
    'name' => 'schd',
    'id' => 'schd',
    'class' => 'small-8 columns right'
);

$business = $this->session->userdata('bname');
$query = $this->db->get_where('capsql.user', array('bname' => $business));
?>

<div class="container">
    <div class="row">
        <?php
        echo form_open('routePrep', "id='route_prep'");
        echo form_fieldset('Select a Delivery date and the Deliverers to execute the routes.');
        ?>
        <div class="row">
            <div class="small-8 small-centered columns">
                    <span class="prefix">
                        Delivery Date
                    </span>
                <?php echo form_input($schd); ?>
            </div>
        </div>
        <table>
            <thead>
            <tr>
                <th>Name</th>
                <th>Role</th>
                <th>Select</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($query->result() as $row)
            {
                switch ($row->role){
                    case 'A':
                        $role = 'Admin';
                        break;
                    case 'M':
                        $role = 'Manager';
                        break;
                    case 'E':
                        $role = 'Employee';
                        break;
                    default:
                        $role = 'Error bad Data';
                }
            ?>
                <tr>
                    <td><?php echo $row->uname; ?></td>
                    <td><?php echo $role; ?></td>
                    <td><?php echo form_checkbox('users', $row->uname); ?></td>
                </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
        <?php
        echo form_submit('','Create Route', "id = 'submit_route' class = 'button small'");
        echo form_close();
        ?>
    </div>
</div>