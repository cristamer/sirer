<?php include('includes/header.php'); ?>
<?php include('includes/menubar.php'); ?>
<?php include("../data/conexion.php"); ?>

    <!-- CSS personalizado --> 
    <link rel="stylesheet" href="main.css">  
      
    <!--datables CSS básico-->
    <link rel="stylesheet" type="text/css" href="datatables/datatables.min.css"/>
    <!--datables estilo bootstrap 4 CSS-->  
    <link rel="stylesheet"  type="text/css" href="datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
           
    <!--font awesome con CDN-->  
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">  



  </style>



<div class="card text-center">
  <div class="card-header text-center">
    <span class="icon-truck"></span> <br>
    <B> <h4 class="text-center"> ENTREGAS A RENDIR </h4> </B>
  </div>

</div>



<form action="envio_fondosr.php" method="GET" class="colm">

  <div class="form-group">
    <label for="fecha">FECHA</label>
    <input type="date" class="form-control" id="fecha" placeholder="">
  </div>

  <button type="submit" class="btn btn-primary">GENERAR</button>
</form>

<?php $F = $_GET['fecha']; ?>

<?php echo $F  ?>



<div class= "tablescroll" > 

<div class="container p-3">

      <div class="row" >
        <div class="col-12" class="colm">

    

    <table id="example" class="table table-sm" width="100%">
      <thead class=" text-center">
        <tr>
        <th scope="col">USUARIO</th>
        <th scope="col">ENVIOS</th>
        <th scope="col">ADEANTOS</th>
        <th scope="col">GASTOS</th>
        <th scope="col">SALDO</th>

      
        </tr>
      </thead>
  <tbody>


          <?php

               $query="



SELECT usuarios.user_activo, usuarios.id_user, usuarios.user_avatar, usuarios.user_nombre, usuarios.user_nick, enviooy.SumaDeimporte AS enviooy, rsaldo.rsaldo, salario_xuser.SumaDesalario AS salario, ingreso_xuser.SumaDeimporte AS envios, egreso_xuser.SumaDeimporte AS egresos
FROM ((((usuarios LEFT JOIN enviooy ON usuarios.id_user = enviooy.id_responsable) LEFT JOIN rsaldo ON usuarios.id_user = rsaldo.id_responsable) LEFT JOIN salario_xuser ON usuarios.id_user = salario_xuser.id_responsable) LEFT JOIN ingreso_xuser ON usuarios.id_user = ingreso_xuser.id_responsable) LEFT JOIN egreso_xuser ON usuarios.id_user = egreso_xuser.id_responsable
WHERE (((usuarios.user_activo)='si') AND ((ingreso_xuser.SumaDeimporte)>0))



              ";
           $result=mysqli_query($conexion, $query);



          ?>
          <?php while($filas=mysqli_fetch_assoc($result)) { ?>
<tr>
            
            <td> <?php echo $filas ['user_nick']?> 
            </td>

            <td><?php echo $filas ['envios']?> 
            </td>

            <td><?php echo $filas ['salario']?> 
            </td>

            <td><?php echo $filas ['egresos']?> 
            </td>
            <td><?php echo $filas ['rsaldo']?> 
            </td>

</tr>

 
         <?php } ?>




  </tbody>
</table>




    </div>
  </div>
</div>
</div> 









    <!-- jQuery, Popper.js, Bootstrap JS -->
    <script src="jquery/jquery-3.3.1.min.js"></script>
    <script src="popper/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
      
    <!-- datatables JS -->
    <script type="text/javascript" src="datatables/datatables.min.js"></script>    
     
    <!-- para usar botones en datatables JS -->  
    <script src="datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>  
    <script src="datatables/JSZip-2.5.0/jszip.min.js"></script>    
    <script src="datatables/pdfmake-0.1.36/pdfmake.min.js"></script>    
    <script src="datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script src="datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
     
    <!-- código JS propìo-->    
    <script type="text/javascript" src="main.js"></script>  
    


  </body>
</html>
