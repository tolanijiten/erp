<?php
require_once("../../includes/db.php");
require_once("../../includes/functions.php");
session_start();
//echo "hello";
if(isset($_POST['edit_customer'])){
    $customer_id = $_POST['customer_id'];
    $customer_name = $_POST['customer_name'];
    $customer_address = $_POST['customer_address'];
    $customer_email = $_POST['customer_email'];
    $customer_contact = $_POST['customer_contact'];
    $gst_no = $_POST['gst_no'];
    
    $employee_id = $_SESSION['employee_id'];
    
    $query = "UPDATE customer SET customer_name = '$customer_name', customer_address = '$customer_address', customer_email = '$customer_email', customer_contact = $customer_contact, gst_no = '$gst_no',updated_at = now(),updated_by = now() WHERE customer_id=$customer_id";
    
    $result = mysqli_query($connection, $query);
    checkQueryResult($result);
    
    echo "Updated: ";
    
    $_SESSION['status'] = CUSTOMER_EDIT_SUCCESS;
    header("Location: http://".BASE_SERVER."/erp/pages/manage-customer.php");
    exit();
    
}