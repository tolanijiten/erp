<?php
require_once("db.php");
function checkQueryResult($resultset)
{
    global $connection;
    if(!$resultset)
    {
        die("Query Failed : ". mysqli_error($connection));
    }
}
function getLoggedInEmployeeName($loggedInID)
{
    global $connection;
    $query = "SELECT * FROM employee WHERE employee_id = $loggedInID";
    echo $query;
    $employee_details = mysqli_query($connection, $query);
    checkQueryResult($employee_details);
    if($row = mysqli_fetch_assoc($employee_details))
    {
        return($row['employee_name']);
    }
}

function insert($tableName, $columns, $values){
    global $connection;
    $query = "INSERT INTO $tableName($columns) VALUES ($values)";
    
    $resultset = mysqli_query($connection, $query);
    checkQueryResult($resultset);
    return $resultset;
}

function deleteRecord($tableName, $primaryKeyColumnName, $primaryKeyValue, $employee_id){
    global $connection;
    
    $query = "UPDATE $tableName SET deleted = 1, deleted_by = $employee_id, deleted_at = now() WHERE $primaryKeyColumnName = $primaryKeyValue";
    $resultset = mysqli_query($connection, $query);
    checkQueryResult($resultset);
}

function redirect($url){
    header("Location: $url");
    exit();
}
?>