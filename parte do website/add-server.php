<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
$nomeserver = $_GET["nomeserver"];
    $enderecoserver = $_GET["enderecoserver"];
   $query = "INSERT INTO servers (users_id, nome, endereco) VALUES ('{$_SESSION['id']}', '{$nomeserver}', '{$enderecoserver}')";
   $conexao = mysqli_connect('localhost', 'root', 'vertrigo', 'mydb');
    if(mysqli_query($conexao, $query)) {
  //       echo "<script type='text/javascript'>swal({
  // title: 'Good job!',
  // text: 'You clicked the button!',
  // icon: 'success',
  //    timer: 3000
  //    });</script>";
        echo "Cadastrado";
     header("Location:dashboard.php");
    } else {
  //   echo '<script type="text/javascript">swal({
  // title: "Good job!",
  // text: "You clicked the button!",
  // icon: "warning",
  //    timer: 3000
  //    });</script>';
        echo "Nao cadastrado";
     header('Location:dashboard.php');
}
    ?>


