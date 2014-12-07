<!--mini navigation tab for this page only-->
<nav class="top-bar hide-for-large-up" data-top-bar role="navigation" data-options="is_hover: false">
	<ul class="title-area">
		<li class="name">
			<h1><?php echo anchor('adminH', 'Home'); ?></h1>
	</ul>
</nav>

<script type="text/javascript">

    // Load the Visualization API and the piechart package.
    google.load('visualization', '1.0', {'packages':['corechart']});

    // Set a callback to run when the Google Visualization API is loaded.
    google.setOnLoadCallback(drawChart);



    // Callback that creates and populates a data table,
    // instantiates the pie chart, passes in the data and
    // draws it.
    function drawChart() {

       var jsonData = $.ajax({
           url: "business_controller/getItemsSold",
           dataType:"json",
           async: false
       }).responseText;
        jsonData = JSON.parse(jsonData);

        // Create the data table.
        var data = new google.visualization.DataTable(jsonData);
        // Set chart options
        var options = {
            'title':'Total Items delivered',
            'backgroundColor': '#f2f2f2',
            'width':1000,
            'height':500,
            'pieHole':.3
        };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
</script>
<div class="container row">
    <div class="row">
      <div class="small-12 columns">
         <div class="small-centered ">
             <h2 class="text-center"><?php echo $user->bname ?></h2>
             <div id="chart_div"></div>
             <p class="text-center"><b>Total deliveries made today: </b><?php echo $count ?></p>
         </div>
             <div class="small-centered">
                 <hr/>
                 <b><h4 class="text-center">Employee Information</h4></b>
                     <table>
                         <thead>
                         <tr>
                             <th width="50">
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
                             if ($employee->avgtime == 0)echo '<td> 00:00 </td>';
                             else echo '<td>' . date('H:i',$employee->avgtime) . '</td>';
                             if (empty($employee->titems)) echo '<td>0</td>';
                             else echo '<td>'.$employee->titems.'</td>';
                             if(empty($employee->tdelivery)) echo '<td>0</td>';
                             else echo '<td>' . round($employee->titems/$employee->tdelivery , 2) . '</td>';
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