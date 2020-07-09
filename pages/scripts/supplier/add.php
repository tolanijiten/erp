<?php
echo "hello";
session_start();
require_once("../../includes/db.php");
require_once("../../includes/functions.php");
$supplier_id = $_SESSION['supplier_id'];


if(isset($_POST['add_supplier'])){
    $supplier_name = $_POST['supplier_name'];
    $supplier_address = $_POST['supplier_address'];
    $supplier_email = $_POST['supplier_email'];
    $supplier_contact = $_POST['supplier_contact'];
    $gst_no = $_POST['gst_no'];
    
    $query_contact = "SELECT * FROM supplier WHERE supplier_contact = $supplier_contact";
    $result_contact = mysqli_query($connection, $query_contact);
    checkQueryResult($result_contact);
    
    
    if(mysqli_num_rows($result_contact)==0){
        $query = "INSERT INTO supplier(supplier_name, supplier_address, supplier_email, supplier_contact, gst_no, created_at) VALUES('$supplier_name', '$supplier_address', '$supplier_email', $supplier_contact, '$gst_no', now())";
        
        $add_supplier_query_result = mysqli_query($connection, $query);
        
        checkQueryResult($add_supplier_query_result);
    
        header("Location: http://".BASE_SERVER."/erp/pages/add-supplier.php?q=success");
        exit;
    }
    else{
        header("Location: http://".BASE_SERVER."/erp/pages/add-supplier.php?q=error");
        exit;
    }
}

?>