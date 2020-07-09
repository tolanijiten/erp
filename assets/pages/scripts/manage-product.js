var Tabledatatables = function(){
    var handleProductTable = function(){
        var productTable = $("#product_list");
        
        var oTable = productTable.dataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
                url:
                "http://localhost/erp/pages/scripts/product/manage.php",
                type: "POST",
            },
            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 25, "All"]
            ],
            "pageLength":15, //set the default length
            "order":[
                [1,"desc"]
            ],
            "columnDefs": [{
                'orderable': false,
                'targets':[0,-1,-2]
            }],
            /*IMAGE SHOWING BY USING JS*/
//            "columnDefs": [{     
//                'orderable': false,
//                'targets': [0],
//                'data': "img",
//                "render": function(data,type,row){
//                    var image_name = row[0];
//                    var res = image_name.split(".");
//                    if(res[1]!=""){
//                        return "<img class = 'img-responsive' height='75px' width='75px' src='http://localhost/erp/assets/products/images/"+row[0]+"'/>";
//                    }else{
//                        return '<img class = "img-responsive" src="http://www.placehold.it/75x75/efefef/aaaaaa&amp;text=amp;text=no+image" />';
//                    }
//                        
//                }
//            }],
            /*END*/
        });
        productTable.on('click', '.edit', function (e) {
            $id = $(this).attr('id');
            $("#edit_product_id").val($id);
            //alert($id);
            
            //fetching all other values from database using ajax and loading them onto 
            //respective edit field!!
            
            $.ajax({
                url: "http://localhost/erp/pages/scripts/product/fetch.php",
                method: "POST",
                data: {product_id: $id},
                dataType: "json",
                success: function(data){
                    $("#product_name").val(data.product_name);
                    $("#eoq").val(data.eoq);
                    $("#rate_of_sale").val(data.rate_of_sale);
                    $("#editModal").modal('show');
                },
            });
            
        });
        productTable.on('click', '.delete', function (e) {
            $id = $(this).attr('id');
            $("#recordID").val($id);
        });
    }
    return{
        
        //main function in javascript to handle all the initialization part
        init: function(){
            handleProductTable();
        }
    };
}();
jQuery(document).ready(function(){
    Tabledatatables.init();
});
