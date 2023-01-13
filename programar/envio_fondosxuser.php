<?php include('includes/header.php'); ?>

<link rel="stylesheet" href="stylos/stylos.css">
<link rel="stylesheet" href="./style.css">
<?php include('includes/menubar.php'); ?>
<?php include("../data/conexion.php"); ?>

<?php 
$us = $_GET['us'];

     $queryus="
SELECT usuarios.id_user, usuarios.user_nombre
FROM usuarios
WHERE (((usuarios.id_user)=$us));
        ";
     $resultus=mysqli_query($conexion, $queryus);
     $filasus=mysqli_fetch_assoc($resultus);

?>




<div class="card text-center">
  <div class="card-header text-center">
    <B> <h4 class="text-center"> RESUMEN DE MOVIMIENTOS  </h4> </B> 
    <h5 class="text-center"> <span class="icon-user"></span> <?php echo $filasus['user_nombre'];?> </h5> 
  </div>

</div>


<div class= "tablescroll" > 

<div class="container p-3">

      <div class="row" >
        <div class="col-12" class="colm">

 <?php

     $queryR="
SELECT ledger.id_ledger, ledger.estado, ledger.id_responsable, ledger.fecha_registro, rend_conceptos.concepto, ledger.observacion, ledger.importe, ledger.salario
FROM ledger INNER JOIN rend_conceptos ON ledger.id_concepto = rend_conceptos.id_concepto
WHERE (((ledger.estado)='R') AND ((ledger.id_responsable)=$us))
ORDER BY ledger.id_ledger;

        ";
     $resultR=mysqli_query($conexion, $queryR);
 
?> 



<div > 

<table class="scrollable table-bordered" class="table table-sm" width="100%">
  <thead class="thead-dark text-center ">
    <tr>
      <th scope="col">FECHA</th>
      <th scope="col">CONCEPTO</th>
      <th scope="col">RENDICIONES</th>
      <th scope="col">SALARIO</th>
     </tr>
  </thead>
  <tbody>

    <?php while($filasR=mysqli_fetch_assoc($resultR)) { ?>

    <tr>
      <td class="text-center"><?php echo $filasR ['fecha_registro'];?></td>
      <td><?php echo $filasR ['concepto'];?> <br> <?php echo $filasR['observacion'];?></td>
      <td class="text-right"><?php echo $filasR ['importe'];?></td>
      <td class="text-right"><?php echo $filasR['salario'];?></td> 
    </tr>

<?php }?>



  </tbody>
</table>
 </div>

    </div>
  </div>
</div>
</div> 



  
      <?php
     $query2="

          SELECT ledger.estado, ledger.id_responsable, rend_conceptos.id_concepto, rend_conceptos.concepto, Sum(ledger.importe) AS SumaDeimporte, Sum(ledger.salario) AS SumaDesalario
          FROM ledger INNER JOIN rend_conceptos ON ledger.id_concepto = rend_conceptos.id_concepto
          GROUP BY ledger.estado, ledger.id_responsable, rend_conceptos.id_concepto, rend_conceptos.concepto
          HAVING (((ledger.estado)='R') AND ((ledger.id_responsable)=$us))
          ORDER BY rend_conceptos.id_concepto;
           ";
           $result2=mysqli_query($conexion, $query2);    

$queryS="
SELECT ledger.estado, ledger.id_responsable, Sum(ledger.importe) AS SumaDeimporte, Sum(ledger.salario) AS SumaDesalario
FROM ledger
GROUP BY ledger.estado, ledger.id_responsable
HAVING (((ledger.estado)='R') AND ((ledger.id_responsable)=$us));
 ";
  $resultS=mysqli_query($conexion, $queryS); 
  
      ?>

 




<div class="container">
  <div class="row">
    <div class="col-sm">


<table class="scrollable table-secondary" class="table table-sm" width="100%">
  <tbody>

    <?php while($filas2=mysqli_fetch_assoc($result2)) { ?>

    <tr>
      <td class="text-right"><?php echo $filas2 ['concepto'];?></td>
      <td class="text-right"><?php echo $filas2 ['SumaDeimporte'];?></td>
      <td class="text-right"><?php echo $filas2 ['SumaDesalario'];?></td>
     </tr>

<?php }?>

<?php $filasS=mysqli_fetch_assoc($resultS) ?>
     <th scope="row" class="text-right" >TOTAL</th>
     <th scope="row" class="text-right"><?php echo $filasS ['SumaDeimporte'];?></th>
     <th scope="row" class="text-right"><?php echo $filasS ['SumaDesalario'];?></th>

</tbody>
</table>

   

    </div>
  </div>
</div>
<br><br>

<div class="card">
  <div class="card-body">
    <div>
       <a href="./crud_envio/liquidar.php?us=<?php echo $us;?>&s=<?php echo $filasS ['SumaDeimporte'];?>" class="btn btn-primary btn-lg btn-block" > 
                          &nbsp LIQUIDAR RENDICION &nbsp
       </a>
    </div>
  </div>
</div>

<br><br><br>

<?php include('includes/footer.php'); ?>