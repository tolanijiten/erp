<?php
//echo "hello <br>";

require_once("constants.php");
$connection= mysqli_connect(SERVER,USERNAME,PASSWORD,DB);
if(!$connection)
{
    die("Some issue in connecting ". mysqli_error($connection));
}
?>