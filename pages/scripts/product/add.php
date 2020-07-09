<?php
session_start();
require_once("../../includes/functions.php");
$employee_id = $_SESSION['employee_id'];

/***********************Start Of Code To Upload Image To SERVER!*******************

//$image_name = $_FILES['product_image']['name'];
//$image_size = $_FILES['product_image']['size'];
//$temp_name = $_FILES['product_image']['tmp_name'];
//$file_type = $_FILES['product_image']['type'];
//
//$file_extension = strtolower(end(explode(".", $image_name)));
//echo "<br> Image name : ".$image_name;
//echo "<br> Image Size : ".$image_size;
//echo "<br> File Type : ".$file_type;
//echo "<br> Image Extension : ".$file_extension;
//echo "<br>";
//$valid_extension = array("jpeg", "jpg", "png");
//
//if(in_array($file_extension, $valid_extension) == false){
//    $error_msg[] = "Image is not valid! Please choose a JPEG or PNG file!";
//}
//
//if($image_size>20971523){
//    $error_msg[] = "Image size is too huge! Please select within 2 MB size";
//}
//
//if(empty($error_msg)){
//    move_uploaded_file($temp_name, "../../../assets/products/images/".$image_name);
//    echo "File Successfully Uploaded";
//}else{
//    print_r($error_msg);
//}
*********************************************END OF CODE TO UPLOAD IMAGE TO SERVER**/
//echo "hello";

if(isset($_POST['add_product'])){
    
    //Checking whether the file was uploaded or not
    if(isset($_FILES['product_image'])){
        //yes the file was uploaded so we are initialising the required variables
        $image_name = $_FILES['product_image']['name'];
        $image_size = $_FILES['product_image']['size'];
        $temp_name = $_FILES['product_image']['tmp_name'];
        $file_type = $_FILES['product_image']['type'];
        
        $file_extension = strtolower(end(explode(".", $image_name)));
    }
    
    $product_name = $_POST['product_name'];
    $rate_of_sale = $_POST['rate_of_sale'];
    $category_id = $_POST['category_id'];
    $additional_specification = $_POST['additional_specification'];
    $suppliers = $_POST['supplier_id'];
    $eoq = $_POST['eoq'];
    
    $tablename = "product";
    $columns = "product_name , eoq, additional_specification , category_id,image_extension, created_by";
    $values = "'$product_name', $eoq, '$additional_specification' , '$category_id', '$file_extension', $employee_id";
    
    $result = insert($tablename,$columns,$values);
    //product has been added
    
    $product_id = mysqli_insert_id($connection);
    //getting the last product_id which was automatically created by DBMS
    
    $tablename = "product_sale_rate";
    $columns = "product_id,rate_of_sale,wef,created_by";
    $values = "$product_id,$rate_of_sale,now(), $employee_id";
    $result = insert($tablename,$columns,$values);
    
    $tablename = "product_supplier";
    $columns = "product_id,supplier_id";
    foreach($suppliers as $supplier_id){
        $values = "$product_id,$supplier_id";
        $result = insert($tablename,$columns,$values);
    }
    /*
        *Code To Upload The File
    */
    if(isset($_FILES['product_image'])){
        move_uploaded_file($temp_name, "../../../assets/products/images/".$product_id.".".$file_extension);
    }
    
    
    echo "Added";
    $_SESSION['status'] = CUSTOMER_ADD_SUCCESS;
    
}
?>



