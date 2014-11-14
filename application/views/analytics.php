<div class="container">
    <div class="row">
        <div class="small-centered">
            <h2 class="text-center"><?php echo $user ?></h2>

            <p class="text-justify"><b>Total deliveries made today: </b><?php echo $count ?></p>
        </div>
        <div class="row">
            <div class="small-centered">
                <hr/>
                <b><h4 class="text-justify">Employee Information</h4></b>

                <div class="row">
                    <table>
                        <thead>
                        <tr>
                            <th width="100">
                                Employee
                            </th>
                            <th width="80">
                                Average delivery times(Hours, Minutes)
                            </th>
                            <th width="80">Total # of items delivered</th>
                            <th width="80">
                                Average # of items delivered
                            </th>
                            <th width="80">Total # of deliveries</th>
                            <th width="80">Total distance traveled</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($employees as $employee) {
                            echo '<tr>';
                            echo '<td>' . $employee->uname . '</td>';
                            echo '<td>' . date('H:i',mktime(null, $employee->avgtime)) . '</td>';
                            echo '<td>'.$employee->titems.'</td>';
                            if(empty($employee->tdelivery)) echo '<td>0</td>';
                            else echo '<td>' . ($employee->titems/$employee->tdelivery) . '</td>';
                            echo '<td>' . $employee->tdelivery . '</td>';
                            echo '<td>' . $employee->tdist . ' Miles</td>';
                            echo '</tr>';
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>