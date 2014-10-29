/**
 * Created by student on 10/29/14.
 */
function editEmployee(action, form_data){
        //var form_data = $('#updateUser-'+user+' :input').serialize();
        console.log(form_data);
        var val = action;

        if (val == 'update') {
            $.ajax({
                url:  "employee_controller/updateEmployee",
                type: 'POST',
                data: form_data,
                success: function (data) {
                    $(".employee_table").html(data);
                }
            });
        }
        else if (val == 'delete'){
            $.ajax({
                url: 'employee_controller/removeEmployee',
                type: 'POST',
                data: form_data,
                success: function (data) {
                    $(".employee_table").html(data);
                }
            });
        }

        return false;
}