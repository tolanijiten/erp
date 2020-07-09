
var Tabledatatables = function(){
    var handleCustomerTable = function(){
        var customerTable = $("#customer_list");
        
        var oTable = customerTable.dataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
                url:
                "http://localhost/erp/pages/scripts/customer/manage.php",
                type: "POST",
            },
            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 25, "All"]
            ],
            "pageLength":15, //set the default length
            "order":[
                [0,"desc"]
            ],
            "columnDefs": [{
                'oderable': false,
                'targets':[-1]
            }]
        });
        customerTable.on('click', '.edit', function (e) {
            $id = $(this).attr('id');
            $("#edit_customer_id").val($id);
            //alert($id);
            
            //fetching all other values from database using ajax and loading them onto 
            //respective edit field!!
            
            $.ajax({
                url: "http://localhost/erp/pages/scripts/customer/fetch.php",
                method: "POST",
                data: {customer_id: $id},
                dataType: "json",
                success: function(data){
                    $("#customer_name").val(data.customer_name);
                    $("#customer_address").val(data.customer_address);
                    $("#customer_email").val(data.customer_email);
                    $("#customer_contact").val(data.customer_contact);
                    $("#gst_no").val(data.gst_no);
                    $("#editModal").modal('show');
                    $("#")
                },
            });
            
        });
        customerTable.on('click', '.delete', function (e) {
            $id = $(this).attr('id');
            $("#recordID").val($id);
        });
    }
    return{
        
        //main function in javascript to handle all the initialization part
        init: function(){
            handleCustomerTable();
        }
    };
}();
jQuery(document).ready(function(){
    Tabledatatables.init();
});
