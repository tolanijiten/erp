<?php
require_once("../../includes/db.php");
session_start();
$employee_id = $_SESSION['employee_id'];
if(isset($_POST['deleteBtn'])){
    $customer_id = $_POST['customer_id'];
    $query = "UPDATE customer SET deleted = 1, deleted_at=now() WHERE customer_id = $customer_id";
    
//    echo $customer_id;
//    echo $query;
    mysqli_query($connection, $query);
    echo "DELETED SUCCESSFULLY!!";
    $_SESSION['status']= CUSTOMER_DELETE_SUCCESS;
    header("Location: http://".BASE_SERVER."/erp/pages/manage-customer.php");
    exit;
}
?>