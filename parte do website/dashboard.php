<?php
   session_start();
    
   if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
       header("location: index.php");
       exit;
   }
   require_once "config.php";
   
   ?>
<!DOCTYPE html>
<html lang="pt-BR">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>MonServ</title>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
      <script src="https://kit.fontawesome.com/9bf570cc89.js" crossorigin="anonymous"></script>
      <link rel="stylesheet" href="./css/style.css">
   </head>
   <body>


    


      <nav class="navbar navbar-white bg-whites">
         <a class="navbar-brand" href="#">
         DashBoard
         </a>
         <div class="justify-content-end">
          <!-- Botão Modal Add Server -->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modalmudarsenha">
            Minha Conta
            </button>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModaladdServidor">
            Adicionar Servidor
            </button>


            
            <a class="btn btn-dark" role="button" href="logout.php">Log out</a>
         </div>
      </nav>
      <div class="container-fluid">
         <div class="row align-items-center">
            <div class="col-sm-5 col-md-3">
            </div>
            <!-- Cards -->
            <div class="col-sm-8 col-md-6 d-flex justify-content-center bd-padd">
               <div class="card border-0" style="width: 20rem; margin-right: 3rem;">
                  <div class="card-body">
                     <i class="fas fa-server fa-3x card-icon"></i>
                     <h5 class="card-title">Servers</h5>
                     <p class="card-text"><?php                                 
                        $sql = "SELECT count(users_id) FROM servers WHERE users_id='{$_SESSION['id']}'";
                        $query = mysqli_query($link, $sql) ;
                        while($sql = mysqli_fetch_array($query)){
                        $nome = $sql["count(users_id)"];
                        
                        echo $nome;
                        }
                        ?></p>
                  </div>
               </div>

               <div class="card border-0" style="width: 20rem;">
                  <div class="card-body bg-user">
                     <i class="fas fa-user fa-3x card-icon"></i>
                     <h5 class="card-title">Bem Vindo</h5>
                     <p class="card-text"><?php                                 
                        $sql = "SELECT username FROM users WHERE id='{$_SESSION['id']}'";
                        $query = mysqli_query($link, $sql) ;
                        while($sql = mysqli_fetch_array($query)){
                        $nomeusuario = $sql["username"];
                        
                        echo $nomeusuario;
                        }
                        ?>
                     </p>
                  </div>
               </div>
            </div>
            <!-- Fim Cards -->
            <div class="col-sm-5 col-md-3"></div>
         </div>
         <!-- Links dos Servidores -->
         <div class="row align-items-center">
            <div class="col-sm-5 col-md-3">
            </div>
            <div class="col-sm-8 col-md-6 d-flex justify-content-center bd-padd">
              <div class="jumbotron">
  <h1 class="display-5">Meus Servidores</h1>
  <hr class="my-4">
  <div style="text-align: center;">
  <?php                                 
                  $sqltes = "SELECT * FROM servers WHERE users_id = '{$_SESSION['id']}'";
                  $query = mysqli_query($link, $sqltes) ;
                  while($sqltes = mysqli_fetch_array($query)){
                  $nomedoserver = $sqltes["nome"];
                  $enderecodoserver = $sqltes["endereco"];
                  





                  echo "
                  <div class='btn btn-dark mrg-link btn-lg'>
                  <a style='color: #fff; text-decoration: none;' role='button' href='http://".$enderecodoserver."'target='_blank'>".$nomedoserver."</a><a href='#' name='id' data-value='".$sqltes["id"]."' id='mydiv' data-toggle='modal' data-target='#Modaleditarserver'><i style='color: #fff; padding-left: 1rem;'class='align-middle far fa-1x fa-edit'></i></a>
                  <a href='apagar-server.php?id=".$sqltes["id"]."'><i style='color: #fff;'class='align-middle fas fa-1x fa-times'></i></a>
    </div>";
                  }
                  ?>﻿

</div>
</div>
               
            </div>
            <div class="col-sm-5 col-md-3"></div>
         </div>
         <!-- Fim Links dos Servidores -->
      </div>
      <!-- Modal Add Server -->
      <div class="modal fade" id="ModaladdServidor" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="TituloModalCentralizado">Adicionar Servidor</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                  <span aria-hidden="true"><i class="fas fa-times"></i></span>
                  </button>
               </div>
               <div class="modal-body">
                  <form action="add-server.php" method="get" name="cadastre">
                     <div class="row">
                        <div class="col-md-12 px-1">
                           <div class="form-group">
                              <label>Nome do Servidor</label>
                              <input type="text" class="form-control" name="nomeserver" placeholder="Nome do Servidor" required>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12 px-1">
                           <div class="form-group">
                              <label for="inputName">Endereço do Servidor</label>
                              <input type="text" class="form-control" name="enderecoserver" placeholder="0.0.0.0" required>
                           </div>
                           <input type="submit" class="btn btn-primary btn-fill pull-right" value="Adicionar Servidor" />
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <!-- Final Modal Add Server -->

<div class="modal fade" id="Modalmudarsenha" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="TituloModalCentralizado">Minha Conta</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                  <span aria-hidden="true"><i class="fas fa-times"></i></span>
                  </button>
               </div>
               <div class="modal-body">
                  <form action="reset-password.php" method="post">
              <div class="form-group">
                <label>Usuario</label>
                <input type="text" class="form-control" value="<?php echo $nomeusuario ?>" readonly>
                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <label>Nova Senha</label>
                <input type="password" name="new_password" class="form-control" value="">
                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <label>Confirmar Nova Senha</label>
                <input type="password" name="confirm_password" class="form-control">
                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Mudar Senha">
            </div>
        </form>
               </div>
            </div>
         </div>
      </div>

      

<script type="text/javascript">
  const details = document.querySelector('#mydiv');
details.addEventListener('click', () => {
  showMydiv(mydiv.dataset.value);
});

function showMydiv(str) {
  document.getElementById('tabelateste').value = str;

}
</script>

      <div class="modal fade" id="Modaleditarserver" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="TituloModalCentralizado">Editar Servidor</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                  <span aria-hidden="true"><i class="fas fa-times"></i></span>
                  </button>
               </div>
               <div class="modal-body">
                  <form action="editar-server.php" method="get" name="cadastre">
                     <div class="row">
                        <div class="col-md-12 px-1">
                <input type="text" class="form-control" name="iddosers" value="tabelateste" id="tabelateste" style="display: none;" readonly>
                           <div class="form-group">
                              <label>Nome do Servidor</label>
                              <input type="text" class="form-control" name="nomedoserver" placeholder="Nome do Servidor" required>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12 px-1">
                           <div class="form-group">
                              <label for="inputName">Endereço do Servidor</label>
                              <input type="text" class="form-control" name="enderecodoserver" placeholder="0.0.0.0" >
                           </div>
                           <input type="submit" class="btn btn-primary btn-fill pull-right" value="Editar Servidor" />
                        </div>
                     </div>
                  </form>
               </div>
            </div>
            </div>
         </div>
      </div>
   </body>
</html>