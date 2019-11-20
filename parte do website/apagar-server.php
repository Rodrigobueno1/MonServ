<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
   require_once "config.php";
$sql = "DELETE FROM servers WHERE id=".$_GET['id']."";
                  $query = mysqli_query($link, $sql) ;
                  header("location: dashboard.php");

?>