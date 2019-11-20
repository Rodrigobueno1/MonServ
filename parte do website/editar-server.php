<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
   require_once "config.php";
   $nomeserve = $_GET['nomedoserver'];
   $enderecoserve = $_GET['enderecodoserver'];
   $idserve = $_GET['iddosers'];

$sql = "UPDATE servers SET nome='$nomeserve', endereco='$enderecoserve' WHERE id='$idserve'";
$query = mysqli_query($link, $sql);
header("location: dashboard.php");

?>