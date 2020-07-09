<?php
require_once("../../includes/db.php");
require_once("../../includes/functions.php");
session_start();
//echo "hello";
if(isset($_POST['edit_product'])){
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    
    $employee_id = $_SESSION['employee_id'];
    
    $query = "UPDATE product SET product_name = '$product_name', updated_by = $employee_id, updated_at = now() WHERE 
    product_id = $product_id";
    
    $result = mysqli_query($connection, $query);
    checkQueryResult($result);
    
    echo "Updated: ";
    
    //$_SESSION['status'] = PRODUCT_EDIT_SUCCESS;
    header("Location: http://".BASE_SERVER."/erp/pages/manage-product.php");
    exit();
}