<?php
echo "hello";
session_start();
require_once("../../includes/db.php");
require_once("../../includes/functions.php");
$employee_id = $_SESSION['employee_id'];


if(isset($_POST['add_customer'])){
    $customer_name = $_POST['customer_name'];
    $customer_address = $_POST['customer_address'];
    $customer_email = $_POST['customer_email'];
    $customer_contact = $_POST['customer_contact'];
    $gst_no = $_POST['gst_no'];
    
    $query_contact = "SELECT * FROM customer WHERE customer_contact = $customer_contact";
    $result_contact = mysqli_query($connection, $query_contact);
    checkQueryResult($result_contact);
    
    
    if(mysqli_num_rows($result_contact)==0){
        $query = "INSERT INTO customer(customer_name, customer_address, customer_email, customer_contact, gst_no, created_at) VALUES('$customer_name', '$customer_address', '$customer_email', $customer_contact, '$gst_no', now())";
        
        $add_customer_query_result = mysqli_query($connection, $query);
        
        checkQueryResult($add_customer_query_result);
    
        header("Location: http://".BASE_SERVER."/erp/pages/add-customer.php?q=success");
        exit;
    }
    else{
        header("Location: http://".BASE_SERVER."/erp/pages/add-customer.php?q=error");
        exit;
    }
}

?>